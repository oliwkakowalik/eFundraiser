<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Fundraiser;
use Illuminate\Support\Facades\Auth;


class FundraiserDonationController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->only('create', 'edit');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Fundraiser $fundraiser)
    {
        return view('donations.index')->withFundraiser($fundraiser);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Fundraiser $fundraiser)
    {
        return view('donations.create')->withFundraiser($fundraiser);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Fundraiser $fundraiser)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
            'description' => 'required',
            'is_anonymous' => 'required',
        ]);

        $donation = new Donation();
        $donation->amount = $request->amount;
        $donation->description = $request->description;
        $donation->is_anonymous = $request->is_anonymous;
        $donation->user_id = Auth::id();
        $donation->fundraiser_id = $request->fundraiser->id;
        $donation->created_at = \Carbon\Carbon::now()->toDateTimeString();
        $donation->updated_at = null;

        $donation->save();

        return redirect()->route('fundraisers.donations.show', [$fundraiser, $donation]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fundraiser $fundraiser, Donation $donation)
    {
        if($donation->fundraiser!=$fundraiser){
            return abort(404);
        }

        return view('donations.show')->withDonation($donation)->withFundraiser($fundraiser);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fundraiser $fundraiser, Donation $donation)
    {
        if($donation->fundraiser!=$fundraiser){
            abort(404);
        }

        if(auth::id() != $donation->user->id) {
            abort(403);
        }

        return view('donations.edit')->withDonation($donation)->withFundraiser($fundraiser);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fundraiser $fundraiser, Donation $donation)
    {
        $this->validate($request, [
            'description' => 'required',
            'is_anonymous' => 'required',
        ]);

        $donation->description = $request->description;
        $donation->is_anonymous = $request->is_anonymous;
        $donation->updated_at = \Carbon\Carbon::now()->toDateTimeString();

        $donation->save();

        return redirect()->route('fundraisers.donations.show', [$fundraiser, $donation]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fundraiser $fundraiser, Donation $donation) {
        if($donation->fundraiser!=$fundraiser){
            return abort(404);
        }

        if(auth::id() != $donation->user->id) {
            abort(403);
        }

        $donation->delete();
        return redirect()->route('fundraisers.donations.index', $fundraiser);
    }
}
