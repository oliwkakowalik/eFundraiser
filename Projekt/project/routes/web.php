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
    return view('Toss_a_coin')
        ->withFundraisers(Fundraiser::orderBy('created_at')->get()->take(3))
        ->withDonations(Donation::all());
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard')
        ->withFundraisers(Fundraiser::all())
        ->withDonations(Donation::all());
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('fundraisers', \App\Http\Controllers\FundraiserController::class);
Route::resource('fundraisers.donations', \App\Http\Controllers\FundraiserDonationController::class);
Route::resource('users', \App\Http\Controllers\Auth\RegisteredUserController::class);
