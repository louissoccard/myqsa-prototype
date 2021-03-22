<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');

    Route::name('award.')->group(function () {
        Route::get('/award', [AwardController::class, 'show'])->name('show');
        Route::get('/award/membership', [AwardController::class, 'show'])->name('membership');
        Route::get('/award/nights-away', [AwardController::class, 'show'])->name('nights-away');
        Route::get('/award/icv-list', [AwardController::class, 'show'])->name('icv-list');
        Route::get('/award/dofe', [AwardController::class, 'show'])->name('dofe');
        Route::get('/award/challenges', [AwardController::class, 'show'])->name('challenges');
        Route::get('/award/presentation', [AwardController::class, 'show'])->name('presentation');
        Route::get('/award/sign-off', [AwardController::class, 'show'])->name('sign-off');
    });

    Route::name('admin-centre.')->group(function () {
        Route::get('/admin-centre', function () {
            return view('admin-centre');
        })->name('show');
        Route::get('/admin-centre/accounts', function () {
            return view('admin-centre.accounts');
        })->name('accounts');
        Route::get('/admin-centre/districts', function () {
            return view('admin-centre.districts.show');
        })->name('districts');
        Route::get('/admin-centre/clusters', function () {
            return view('admin-centre.clusters.show');
        })->name('clusters');
    });
});

Route::get('/sign-in', [AuthenticatedSessionController::class, 'create'])
     ->middleware(['guest'])
     ->name('login');

$limiter = config('fortify.limiters.login');

Route::post('/sign-in', [AuthenticatedSessionController::class, 'store'])
     ->middleware(array_filter([
         'guest',
         $limiter ? 'throttle:'.$limiter : null,
     ]));

Route::post('/sign-out', [AuthenticatedSessionController::class, 'destroy'])
     ->name('logout');

// Password Reset...
if (Features::enabled(Features::resetPasswords())) {
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
         ->middleware(['guest'])
         ->name('password.request');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
         ->middleware(['guest'])
         ->name('password.reset');
}

// Registration...
if (Features::enabled(Features::registration())) {
    Route::get('/register', [RegisteredUserController::class, 'create'])
         ->middleware(['guest'])
         ->name('register');
}

// Email Verification...
if (Features::enabled(Features::emailVerification())) {
    Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
         ->middleware(['auth'])
         ->name('verification.notice');
}

// Password Confirmation...
Route::get('/user/confirm-password', [ConfirmablePasswordController::class, 'show'])
     ->middleware(['auth'])
     ->name('password.confirm');

Route::get('/user/confirmed-password-status', [ConfirmedPasswordStatusController::class, 'show'])
     ->middleware(['auth'])
     ->name('password.confirmation');

// Two Factor Authentication...
if (Features::enabled(Features::twoFactorAuthentication())) {
    Route::get('/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'create'])
         ->middleware(['guest'])
         ->name('two-factor.login');
}
