<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/pitch/arena', function () {
    return view('pitchArena');
})->name('pitch.arena');

/*
|--------------------------------------------------------------------------
| Guest Routes (Login & Registration)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Entrepreneur Auth
    Route::get('/entrepreneur/login', function () {
        return view('entrepreneurLogin');
    })->name('entrepreneur.login');

    Route::get('/entrepreneur/register', function () {
        return view('entrepreneurRegister');
    })->name('entrepreneur.register');

    Route::post('/register/entrepreneur', [AuthController::class, 'registerEntrepreneur'])->name('entrepreneur.register.post');

    // Investor Auth
    Route::get('/login', function () {
        return view('investorLogin');
    })->name('investorLogin');

    Route::get('/investor/register', function () {
        return view('investorRegister');
    })->name('investor.register');

    Route::post('/register/investor', [AuthController::class, 'registerInvestor'])->name('investor.register.post');

    // Generic Login Post (handles both)
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Entrepreneur Dashboard
    |--------------------------------------------------------------------------
    */
    Route::prefix('entrepreneur')->name('entrepreneur.')->middleware('role:entrepreneur')->group(function () {
        Route::get('/dashboard', function () {
            return view('entrepreneur.dashboard');
        })->name('dashboard');

        Route::prefix('pitch')->name('pitch.')->group(function () {
            Route::get('/create', function () {
                return view('entrepreneur.createPitch');
            })->name('create');

            Route::get('/update', function () {
                return view('entrepreneur.updatePitch');
            })->name('update');
        });

        Route::get('/offers', function () {
            return view('entrepreneur.investorsOffer');
        })->name('offers');

        Route::get('/agreements', function () {
            return view('entrepreneur.agreements');
        })->name('agreements');

        Route::get('/profile', function () {
            return view('entrepreneur.profile');
        })->name('profile');
    });

    /*
    |--------------------------------------------------------------------------
    | Investor Dashboard
    |--------------------------------------------------------------------------
    */
    Route::prefix('investor')->name('investor.')->middleware('role:investor')->group(function () {
        Route::get('/home', function () {
            return view('investor.home');
        })->name('home');

        Route::get('/offers', function () {
            return view('investor.myOffers');
        })->name('myOffers');

        Route::get('/pitch/view', function () {
            return view('investor.viewPitch');
        })->name('pitch.view');

        Route::get('/agreements', function () {
            return view('investor.agreements');
        })->name('agreements');

        Route::get('/profile', function () {
            return view('investor.profile');
        })->name('profile');
    });
});

/*
|--------------------------------------------------------------------------
| Fallbacks
|--------------------------------------------------------------------------
*/
Route::get('/register/entrepreneur', function () {
    return redirect()->route('entrepreneur.register');
});
Route::get('/register/investor', function () {
    return redirect()->route('investor.register');
});
