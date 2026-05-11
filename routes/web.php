<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/register/entrepreneur', [AuthController::class, 'registerEntrepreneur'])->name('entrepreneur.register.post');
Route::post('/register/investor', [AuthController::class, 'registerInvestor'])->name('investor.register.post');

// Fallback GET routes for registration to handle refreshes
Route::get('/register/entrepreneur', function () {
    return redirect()->route('entrepreneur.register');
});
Route::get('/register/investor', function () {
    return redirect()->route('investor.register');
});

Route::get('/investor/register', function () {
    return view('investorRegister');
})->name('investor.register');

Route::get('/entrepreneur/register', function () {
    return view('entrepreneurRegister');
})->name('entrepreneur.register');

Route::get('/login', function () {
    return view('investorLogin');
})->name('investorLogin');

Route::get('/entrepreneur/login', function () {
    return view('entrepreneurLogin');
})->name('entrepreneur.login');

Route::get('/entrepreneur/dashboard', function () {
    return view('entrepreneur.dashboard');
})->name('entrepreneur.dashboard');

Route::get('/entrepreneur/pitch/create', function () {
    return view('entrepreneur.createPitch');
})->name('entrepreneur.pitch.create');

Route::get('/entrepreneur/pitch/update', function () {
    return view('entrepreneur.updatePitch');
})->name('entrepreneur.pitch.update');

Route::get('/entrepreneur/offers', function () {
    return view('entrepreneur.investorsOffer');
})->name('entrepreneur.offers');

Route::get('/entrepreneur/agreements', function () {
    return view('entrepreneur.agreements');
})->name('entrepreneur.agreements');

Route::get('/entrepreneur/profile', function () {
    return view('entrepreneur.profile');
})->name('entrepreneur.profile');

Route::get('/investor/home', function () {
    return view('investor.home');
})->name('investor.home');

Route::get('/investor/offers', function () {
    return view('investor.myOffers');
})->name('investor.myOffers');

Route::get('/investor/pitch/view', function () {
    return view('investor.viewPitch');
})->name('investor.pitch.view');

Route::get('/investor/agreements', function () {
    return view('investor.agreements');
})->name('investor.agreements');

Route::get('/investor/profile', function () {
    return view('investor.profile');
})->name('investor.profile');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/pitch/arena', function () {
    return view('pitchArena');
})->name('pitch.arena');
