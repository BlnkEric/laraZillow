<?php

use App\Models\User;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\Auth\userAccountController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\RealrotListingAcceptOfferController;

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

// redirect route with specific status code
// Route::redirect('/here', '/there', 301);

// equivalent to this code
// Route::permanentRedirect('/here', '/there');

// test whereIn Route -- routes with these parameteres are accepted and will render something - others throw 404 not found
// Route::get('/category/{category}', function ($category) {
//     return "hello";
// })->whereIn('category', ['movie', 'song', 'painting']);


// test helper methods for constrainting route parameters
// Route::get('/user/{id}/{name}', function ($id, $name) {
        // Only executed if {id} is numeric...
//     return "hello";
// })->whereNumber('id')->whereAlphaNumeric('name');

// getting user instance explicitly - 
Route::get('/user/{user}/wow', function(User $allss) {
    return $allss;
});


// -------------------------------------------------------------]
Route::get('/', [IndexController::class, 'index']);
Route::get('/show', [IndexController::class, 'show']);

Route::resource('listings', ListingController::class)->only(['index', 'show']);

Route::resource('listings.offers', ListingOfferController::class)->middleware('auth');

Route::resource('notifications', NotificationController::class)->middleware('auth')->only(['index']);
Route::put('notification/{notification}/seen', NotificationSeenController::class)
        ->middleware('auth')    
        ->name('notification.seen');

Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store')->middleware(['throttle:login']);
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', userAccountController::class);

Route::prefix('realtor')->name('realtor.')->middleware('auth')->group(function () {


	// will found the listing for the user by convention - it means it looks for a relation named [user->listings()]
	// if there is no match 404 will return
    // Route::get('/users/{user}/listings/{listing}', function (User $user, Listing $listing) {
    //         return $listing;
    //     })->scopeBindings();

	// this withoutScopedBindings will skip the implicit binding and return just the listing with default parameter in the URI
	// Route::get('/users/{user}/listings/{listing}', function (User $user, Listing $listing) {
    //         return $listing;
    //     })->withoutScopedBindings();


	// // Customizing Missing Model Behavior !! --  The missing method
	// // 404 !! 
	// Route::get('/users/{user}/listings/{listing}', function (User $user, Listing $listing) {
    //         return $listing;
    //     })
	// 		->scopeBindings()
	// 		->missing(function (Request $request) {
	// 			// Redirect class : use Illuminate\Support\Facades\Redirect;
	// 			return Redirect::route('locations.index');
	// 		});
                
    Route::resource('listings.image', RealtorListingImageController::class)->only(['create', 'store', 'destroy']);

    Route::put('listings/{listing}/restore', [RealtorListingController::class, 'restore'])
    ->name('listings.restore')
    ->withTrashed();

    Route::put('offer/{offer}/accept', RealrotListingAcceptOfferController::class)->name('offer.accept');

    Route::resource('listings', RealtorListingController::class)
    // ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->withTrashed();
});
