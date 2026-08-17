<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Entrepreneur\AgreementController;
use App\Http\Controllers\Entrepreneur\OfferController;
use App\Http\Controllers\Entrepreneur\PitchController;
use App\Http\Controllers\Entrepreneur\ProfileController;
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
    $pitches = Pitch::with('user')->where('status', 'active')->latest()->get();

    return view('pitchArena', compact('pitches'));
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
                if (Pitch::where('user_id', auth()->id())->exists()) {
                    return redirect()->route('entrepreneur.dashboard')->with('error', 'You can only have one active pitch at a time.');
                }

                return view('entrepreneur.createPitch');
            })->name('create');
            Route::post('/store', [PitchController::class, 'store'])->name('store');

            Route::get('/{pitch}/update', function (Pitch $pitch) {
                return view('entrepreneur.updatePitch', compact('pitch'));
            })->middleware('owns:pitch')->name('update');
            Route::put('/{pitch}/update', [PitchController::class, 'update'])->middleware('owns:pitch')->name('update.put');
            Route::delete('/{pitch}', [PitchController::class, 'destroy'])->middleware('owns:pitch')->name('destroy');
        });

        Route::get('/offers', [OfferController::class, 'index'])->name('offers');
        Route::post('/offers/{offer}/status', [OfferController::class, 'updateStatus'])->name('offers.status');

        Route::get('/agreements', [AgreementController::class, 'index'])->name('agreements');
        Route::post('/agreements/{agreement}/sign', [AgreementController::class, 'sign'])->middleware('owns:agreement,entrepreneur_id', 'agreement.status:sent_to_entrepreneur')->name('agreements.sign');
        Route::post('/agreements/{agreement}/reject', [AgreementController::class, 'reject'])->middleware('owns:agreement,entrepreneur_id')->name('agreements.reject');
        Route::get('/agreements/{agreement}/download', [App\Http\Controllers\Investor\AgreementController::class, 'download'])->middleware('file.download')->name('agreements.download');
        Route::get('/agreements/{agreement}/download-signed', [App\Http\Controllers\Investor\AgreementController::class, 'downloadEntrepreneurFile'])->middleware('file.download')->name('agreements.download.entrepreneur');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile/image', [ProfileController::class, 'uploadImage'])->name('profile.image');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });

    /*
    |--------------------------------------------------------------------------
    | Investor Dashboard
    |--------------------------------------------------------------------------
    */
    Route::prefix('investor')->name('investor.')->middleware('role:investor')->group(function () {
        Route::get('/home', [App\Http\Controllers\Investor\PitchController::class, 'index'])->name('home');

        Route::get('/offers', [App\Http\Controllers\Investor\OfferController::class, 'index'])->name('myOffers');
        Route::post('/pitch/{pitch}/offer', [App\Http\Controllers\Investor\OfferController::class, 'store'])->middleware('pitch.status:active')->name('offers.store');
        Route::put('/offers/{offer}', [App\Http\Controllers\Investor\OfferController::class, 'update'])->middleware('owns:offer,investor_id')->name('offers.update');
        Route::delete('/offers/{offer}', [App\Http\Controllers\Investor\OfferController::class, 'destroy'])->middleware('owns:offer,investor_id')->name('offers.destroy');

        Route::get('/pitch/{pitch?}/view', [App\Http\Controllers\Investor\PitchController::class, 'show'])->name('pitch.view');

        Route::get('/agreements', [App\Http\Controllers\Investor\AgreementController::class, 'index'])->name('agreements');
        Route::post('/agreements/{agreement}/upload', [App\Http\Controllers\Investor\AgreementController::class, 'upload'])->middleware('owns:agreement,investor_id', 'agreement.status:pending_signature,rejected')->name('agreements.upload');
        Route::post('/agreements/{agreement}/remove', [App\Http\Controllers\Investor\AgreementController::class, 'removeFile'])->middleware('owns:agreement,investor_id')->name('agreements.remove');
        Route::post('/agreements/{agreement}/send', [App\Http\Controllers\Investor\AgreementController::class, 'send'])->middleware('owns:agreement,investor_id', 'agreement.status:investor_uploaded')->name('agreements.send');
        Route::get('/agreements/{agreement}/download', [App\Http\Controllers\Investor\AgreementController::class, 'download'])->middleware('file.download')->name('agreements.download');
        Route::get('/agreements/{agreement}/download-signed', [App\Http\Controllers\Investor\AgreementController::class, 'downloadEntrepreneurFile'])->middleware('file.download')->name('agreements.download.entrepreneur');

        Route::get('/profile', [App\Http\Controllers\Investor\ProfileController::class, 'index'])->name('profile');
        Route::post('/profile/image', [App\Http\Controllers\Investor\ProfileController::class, 'uploadImage'])->name('profile.image');
        Route::post('/profile/update', [App\Http\Controllers\Investor\ProfileController::class, 'update'])->name('profile.update');
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
