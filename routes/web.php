<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;
use Laravel\Jetstream\Http\Controllers\CurrentTeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\ApiTokenController;
use Laravel\Jetstream\Http\Controllers\Livewire\TeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use Laravel\Jetstream\Jetstream;

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

    Route::group(['middleware' => ['award.access'], 'as' => 'award.', 'prefix' => 'award'], function () {
        Route::get('/', [AwardController::class, 'show'])->name('show');
        Route::get('/clear', [AwardController::class, 'clear'])->name('clear');
        Route::get('/membership', [AwardController::class, 'show'])->name('membership');
        Route::get('/nights-away', [AwardController::class, 'show'])->name('nights-away');
        Route::get('/icv-list', [AwardController::class, 'show'])->name('icv-list');
        Route::get('/dofe', [AwardController::class, 'show'])->name('dofe');
        Route::get('/challenges', [AwardController::class, 'show'])->name('challenges');
        Route::get('/presentation', [AwardController::class, 'show'])->name('presentation');
        Route::get('/sign-off', [AwardController::class, 'show'])->name('sign-off');
    });

    Route::group([
        'middleware' => ['my_participants.access'], 'as' => 'my-participants.', 'prefix' => 'my-participants'
    ], function () {
        Route::get('/', function () {
            return view('my-participants');
        })->name("show");

    });

    Route::group(['middleware' => ['role:admin'], 'as' => 'admin-centre.', 'prefix' => 'admin-centre'], function () {
        Route::get('/', function () {
            return view('admin-centre');
        })->name('show');
        Route::get('/accounts', function () {
            return view('admin-centre.accounts.show');
        })->name('accounts');
        Route::get('/districts', function () {
            return view('admin-centre.districts.show');
        })->name('districts');
        Route::get('/clusters', function () {
            return view('admin-centre.clusters.show');
        })->name('clusters');

        Route::get('/changelog', [\App\Http\Controllers\ChangelogController::class, 'show'])->name('changelog');
        Route::get('/permissions', function () {
            return view('admin-centre.permissions.show');
        })->name('permissions');
        Route::get('/roles', function () {
            return view('admin-centre.roles.show');
        })->name('roles');
    });
});

Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
    Route::group(['middleware' => ['auth', 'verified']], function () {
        // User & Profile...
        Route::get('/account/manage', [UserProfileController::class, 'show'])
             ->name('account.manage.show');

        // API...
        if (Jetstream::hasApiFeatures()) {
            Route::get('/user/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');
        }

        // Teams...
        if (Jetstream::hasTeamFeatures()) {
            Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
            Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
            Route::put('/current-team', [CurrentTeamController::class, 'update'])->name('current-team.update');
        }
    });
});

Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {

    Route::get('/sign-in', [AuthenticatedSessionController::class, 'create'])
         ->middleware(['guest'])
         ->name('sign-in');

    $limiter = config('fortify.limiters.login');

    Route::post('/sign-in', [AuthenticatedSessionController::class, 'store'])
         ->middleware(array_filter([
             'guest',
             $limiter ? 'throttle:'.$limiter : null,
         ]));

    Route::get('/sign-out', [AuthenticatedSessionController::class, 'destroy'])
         ->name('sign-out');

    Route::post('/sign-out', [AuthenticatedSessionController::class, 'destroy'])
         ->name('sign-out');

    // Password Reset...
    if (Features::enabled(Features::resetPasswords())) {
        Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
             ->middleware(['guest'])
             ->name('password.request');

        Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
             ->middleware(['guest'])
             ->name('password.reset');
    }

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
         ->middleware(['guest'])
         ->name('password.email');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
         ->middleware(['guest'])
         ->name('password.update');


    // Registration...
    if (Features::enabled(Features::registration())) {
        Route::get('/register', [RegisteredUserController::class, 'create'])
             ->middleware(['guest'])
             ->name('register');
    }

    Route::post('/register', [RegisteredUserController::class, 'store'])
         ->middleware(['guest']);


    // Email Verification...
    if (Features::enabled(Features::emailVerification())) {
        Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
             ->middleware(['auth'])
             ->name('verification.notice');
    }

    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
         ->middleware(['auth', 'signed', 'throttle:6,1'])
         ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
         ->middleware(['auth', 'throttle:6,1'])
         ->name('verification.send');

    // Profile Information...
    if (Features::enabled(Features::updateProfileInformation())) {
        Route::put('/account/profile-information', [ProfileInformationController::class, 'update'])
             ->middleware(['auth'])
             ->name('user-profile-information.update');
    }

    // Passwords...
    if (Features::enabled(Features::updatePasswords())) {
        Route::put('/account/password', [PasswordController::class, 'update'])
             ->middleware(['auth'])
             ->name('user-password.update');
    }

    // Password Confirmation...
    Route::get('/account/confirm-password', [ConfirmablePasswordController::class, 'show'])
         ->middleware(['auth'])
         ->name('password.confirm');

    Route::get('/account/confirmed-password-status', [ConfirmedPasswordStatusController::class, 'show'])
         ->middleware(['auth'])
         ->name('password.confirmation');


    Route::post('/account/confirm-password', [ConfirmablePasswordController::class, 'store'])
         ->middleware(['auth']);

    // Two Factor Authentication...
    if (Features::enabled(Features::twoFactorAuthentication())) {
        Route::get('/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'create'])
             ->middleware(['guest'])
             ->name('two-factor.login');
    }

    Route::post('/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'store'])
         ->middleware(['guest']);

    $twoFactorMiddleware = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword')
        ? ['auth', 'password.confirm']
        : ['auth'];

    Route::post('/account/two-factor-authentication', [TwoFactorAuthenticationController::class, 'store'])
         ->middleware($twoFactorMiddleware);

    Route::delete('/account/two-factor-authentication', [TwoFactorAuthenticationController::class, 'destroy'])
         ->middleware($twoFactorMiddleware);

    Route::get('/account/two-factor-qr-code', [TwoFactorQrCodeController::class, 'show'])
         ->middleware($twoFactorMiddleware);

    Route::get('/account/two-factor-recovery-codes', [RecoveryCodeController::class, 'index'])
         ->middleware($twoFactorMiddleware);

    Route::post('/account/two-factor-recovery-codes', [RecoveryCodeController::class, 'store'])
         ->middleware($twoFactorMiddleware);

});
