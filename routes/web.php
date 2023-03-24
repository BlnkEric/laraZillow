<?php

use App\Http\Controllers\Auth\userAccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [IndexController::class, 'index']);
Route::get('/show', [IndexController::class, 'show']);

Route::resource('listings', ListingController::class)->only(['index', 'show']);

Route::resource('listings.offers', ListingOfferController::class)->middleware('auth');

Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', userAccountController::class);

Route::prefix('realtor')->name('realtor.')->middleware('auth')->group(function () {
    Route::resource('listings.image', RealtorListingImageController::class)->only(['create', 'store', 'destroy']);

    Route::put('listings/{listing}/restore', [RealtorListingController::class, 'restore'])
    ->name('listings.restore')
    ->withTrashed();

    Route::resource('listings', RealtorListingController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->withTrashed();
});