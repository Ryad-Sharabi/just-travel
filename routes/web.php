<?php

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

use App\Http\Controllers\WebAuthController;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('/login', [WebAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [WebAuthController::class, 'login'])->name('login.post');
Route::get('/register', [WebAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [WebAuthController::class, 'register'])->name('register.post');
Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth:flutter_web')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [WebAuthController::class, 'verifyEmail'])
    ->middleware(['auth:flutter_web', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [WebAuthController::class, 'resendVerificationEmail'])
    ->middleware(['auth:flutter_web', 'throttle:6,1'])
    ->name('verification.send');

// Dashboard / Home (Simple placeholder for now)
use App\Http\Controllers\WebFeedbackController;
use App\Http\Controllers\BrowseController;

// Dashboard / Home
// Dashboard / Home
Route::get('/home', [BrowseController::class, 'index'])->name('home');
Route::get('/hotels', [BrowseController::class, 'hotels'])->name('hotels');
Route::get('/book-hotel', function () {
    return view('hotel_booking');
})->name('hotels.book');
Route::get('/book-flight', function () {
    return view('flight_booking');
})->name('flights.book');
Route::get('/book-car', function () {
    return view('car_booking');
})->name('cars.book');
Route::get('/cars', [BrowseController::class, 'cars'])->name('cars');
Route::post('/feedback', [WebFeedbackController::class, 'store'])->middleware('auth:flutter_web')->name('feedback.store');
Route::get('/just-mine-travel', [App\Http\Controllers\JustMineTravelAIController::class, 'index'])->name('ai.chat');
Route::get('/privacy-policy', function () {
    return view('privacy');
})->name('privacy');
Route::get('/terms-and-conditions', function () {
    return view('terms');
})->name('terms');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/mobile-app', function () {
    return view('mobile_app');
})->name('mobile.app');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
