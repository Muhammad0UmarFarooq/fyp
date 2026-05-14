<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Entrepreneur\PitchController;
use App\Models\Pitch;
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
    // Unified Login
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Entrepreneur Registration
    Route::get('/entrepreneur/register', function () {
        return view('entrepreneurRegister');
    })->name('entrepreneur.register');

    Route::post('/register/entrepreneur', [AuthController::class, 'registerEntrepreneur'])->name('entrepreneur.register.post');

    // Investor Registration
    Route::get('/investor/register', function () {
        return view('investorRegister');
    })->name('investor.register');

    Route::post('/register/investor', [AuthController::class, 'registerInvestor'])->name('investor.register.post');
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
            $pitch = Pitch::where('user_id', auth()->id())->first();
            return view('entrepreneur.dashboard', compact('pitch'));
        })->name('dashboard');

        Route::prefix('pitch')->name('pitch.')->group(function () {
            Route::get('/create', function () {
                if (\App\Models\Pitch::where('user_id', auth()->id())->exists()) {
                    return redirect()->route('entrepreneur.dashboard')->with('error', 'You can only have one active pitch at a time.');
                }
                return view('entrepreneur.createPitch');
            })->name('create');
            Route::post('/store', [PitchController::class, 'store'])->name('store');

            Route::get('/{pitch}/update', function (Pitch $pitch) {
                return view('entrepreneur.updatePitch', compact('pitch'));
            })->name('update');
            Route::put('/{pitch}/update', [PitchController::class, 'update'])->name('update.put');
            Route::delete('/{pitch}', [PitchController::class, 'destroy'])->name('destroy');
        });

        Route::get('/offers', function () {
            return view('entrepreneur.investorsOffer');
        })->name('offers');

        Route::get('/agreements', function () {
            return view('entrepreneur.agreements');
        })->name('agreements');

        Route::get('/profile', [App\Http\Controllers\Entrepreneur\ProfileController::class, 'index'])->name('profile');
        Route::post('/profile/image', [App\Http\Controllers\Entrepreneur\ProfileController::class, 'uploadImage'])->name('profile.image');
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
