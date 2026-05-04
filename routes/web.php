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
    return view('login');
})->name('login');