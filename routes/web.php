<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// All Listings
Route::get('/', [ListingController::class, 'index'])->name('listing.index');



Route::middleware('auth')->group(function(){

// Create Listing
Route::get('/listings/create', [ListingController::class, 'create'])->name('listing.create');

// Store Listings
Route::post('/listings', [ListingController::class, 'store'])->name('listing.store');

// Edit Listings
Route::get('/listings/{listing}/edit',[ListingController::class, 'edit'])->name('listing.edit');

// Update Listings
Route::put('/listings/{listing}',[ListingController::class, 'update'])->name('listing.update');

// Delete Listing
Route::delete('/listings/{listing}',[ListingController::class, 'destroy'])->name('listing.destroy');

// Logout User
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

// Manage Listings

Route::get('/listings/manage', [ListingController::class, 'manage'])->name('listing.manage');
});









// Single Listing
Route::get('/listings/{listing}',[ListingController::class, 'show'])->name('listing.show');

// Create User
Route::get('users/register',[UserController::class, 'create'])->name('users.create')->middleware('guest');

// Store User
Route::post('users/',[UserController::class, 'store'])->name('user.store');

// Login User
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Auth User
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->name('users.auth');
