<?php

use App\Models\Donation;
use App\Models\Fundraiser;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|s
*/

Route::get('/', function () {
    $best_3_users = array_slice(User::scopeRanking(Donation::all()), 0, 3);
    $latest_3_donations = Donation::all()->sortBy('created_at')->take(3);
    return view('Toss_a_coin', ['latest_3_donations' => $latest_3_donations, 'best_3_users' => $best_3_users])
        ->withFundraisers(Fundraiser::orderByDesc('created_at')->get()->take(3))
        ->withDonations(Donation::all());
})->name('home');

Route::get('/dashboard', function () {
    $user_donations = Donation::all()->where('user_id', '=', auth()->user()->id)->where('is_anonymous', '=', '0');
    $user_fundraisers = Fundraiser::all()->where('user_id', '=', auth()->user()->id);
    return view('dashboard', ["user_donations" => $user_donations, "user_fundraisers" => $user_fundraisers])
        ->withFundraisers(Fundraiser::all())
        ->withDonations(Donation::all());
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('fundraisers', \App\Http\Controllers\FundraiserController::class);
Route::resource('fundraisers.donations', \App\Http\Controllers\FundraiserDonationController::class);
Route::resource('users', \App\Http\Controllers\Auth\RegisteredUserController::class);
