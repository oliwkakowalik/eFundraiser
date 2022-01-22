<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Fundraiser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundraiserController extends Controller
{
    public function __construct() {
        $this->middleware('verified')->only('create', 'edit');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'amount_to_be_raised' => 'numeric|min:0|max:99999999'
        ]);

        $fundraisers = Fundraiser::select("*");

        if($request->input('filter') == 'all' ){
            session(['amount_to_be_raised' => $request->input('amount_to_be_raised')]);
            session(['category' => $request->input('category')]);
            session(['stop_date' => $request->input('stop_date')]);
            session(['start_date' => $request->input('start_date')]);
            return view('fundraisers.index')->withFundraisers($fundraisers->get())->withCategories(Category::all());
        }
        if($request->has('amount_to_be_raised') ){
            session(['amount_to_be_raised' => $request->input('amount_to_be_raised')]);
            session(['category' => $request->input('category')]);
            session(['stop_date' => $request->input('stop_date')]);
            session(['start_date' => $request->input('start_date')]);
        }

        if(isset($_GET['submit']))
             $fundraisers = $this->sort($fundraisers);
        else
             $fundraisers = $this->filter($fundraisers);

        return view('fundraisers.index')->withFundraisers($fundraisers->get())->withCategories(Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fundraisers.create')->withCategories(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'stop_date' => 'required|date|after:now',
            'amount_to_be_raised' => 'required|gt:0'
        ]);

        $fundraiser = new Fundraiser();
        $fundraiser->title = $request->title;
        $fundraiser->category_id = Category::where('name', $request->category)->firstOrFail()->id;
        $fundraiser->description = $request->description;
        $fundraiser->stop_date = $request->stop_date . " 23:59:59";
        $fundraiser->amount_raised = 0;
        $fundraiser->amount_to_be_raised = $request->amount_to_be_raised;
        $fundraiser->user_id = Auth::id();

        $fundraiser->save();

        return redirect()->route('fundraisers.show', $fundraiser);
    }

    /**
     * Display the specified resource.
     *
     * @param  Fundraiser $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function show(Fundraiser $fundraiser)
    {
        return view('fundraisers.show')->withFundraiser($fundraiser);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Fundraiser $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function edit(Fundraiser $fundraiser)
    {
        if (auth::id() == $fundraiser->user->id) {
            return view("fundraisers.edit")->withFundraiser($fundraiser)->withCategories(Category::all());
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Fundraiser $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fundraiser $fundraiser)
    {

        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'stop_date' => 'required|date|after:now',
            'amount_to_be_raised' => 'required|gt:0'
        ]);

        $fundraiser->title = $request->title;
        $fundraiser->category_id = Category::where('name', $request->category)->firstOrFail()->id;
        $fundraiser->description = $request->description;
        $fundraiser->stop_date = $request->stop_date . " 23:59:59";
        $fundraiser->amount_to_be_raised = $request->amount_to_be_raised;
        $fundraiser->updated_at = \Carbon\Carbon::now()->toDateTimeString();

        $fundraiser->save();

        return redirect()->route('fundraisers.show', $fundraiser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Fundraiser $fundraiser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fundraiser $fundraiser)
    {
        if(auth::id() != $fundraiser->user->id) {
            abort(403);
        }

        $fundraiser->delete();

        return redirect()->route('fundraisers.index');
    }

    public function filter($fundraisers){
        $fundraisers = $fundraisers->where('amount_to_be_raised','>=',(float)session('amount_to_be_raised'));

        if( session('category') != null) {
            $id = Category::where('name', session('category'))->firstOrFail()->id;
            $fundraisers = $fundraisers->where('category_id', '=', $id);
        }

        if( session('stop_date') != '' )
            $fundraisers = $fundraisers->where('stop_date','<=',session('stop_date'));
        if( session('start_date') != '' )
            $fundraisers = $fundraisers->where('start_date','<=',session('start_date'));

        return $fundraisers;
    }

    public function sort($fundraisers){
        if($_GET['submit'] == 'amount')
              return $this->filter($fundraisers)->orderBy('amount_to_be_raised', 'DESC');
        if($_GET['submit'] == 'date1')
            return $this->filter($fundraisers)->orderBy('stop_date', 'ASC');
        if($_GET['submit'] == 'amount2')
            return $this->filter($fundraisers)->orderBy('amount_to_be_raised', 'ASC');
        if($_GET['submit'] == 'date2')
            return $this->filter($fundraisers)->orderBy('stop_date', 'DESC');
        return  $this->filter($fundraisers);
    }
}
