<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Fundraiser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundraiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('fundraisers.index')->withFundraisers(Fundraiser::all());
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
        return view("fundraisers.edit")->withFundraiser($fundraiser)->withCategories(Category::all());
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
        $fundraiser->delete();

        return redirect()->route('fundraisers');
    }
}
