<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

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

Route::get('/entrepreneur/home', function () {
    return view('entrepreneur.home');
})->name('entrepreneur.home');

Route::get('/entrepreneur/pitch/create', function () {
    return view('entrepreneur.createPitch');
})->name('entrepreneur.pitch.create');

Route::get('/pitch-arena', function () {
    return view('pitchArena');
})->name('pitch.arena');

Route::get('/about', function () {
    return view('about');
})->name('about');
