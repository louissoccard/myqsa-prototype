<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AwardController;

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

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

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/award', [AwardController::class, 'show'])->name('award');

    Route::name('admin.')->group(function() {
    Route::get('/admin', function() { return view('admin'); })->name('show');
    Route::get('/admin/accounts', function() { return view('admin.accounts'); })->name('accounts');
    });
});

Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {
    $enableViews = config('fortify.views', true);

    // Authentication...
    if ($enableViews) {
        Route::get('/sign-in', [AuthenticatedSessionController::class, 'create'])
             ->middleware(['guest'])
             ->name('sign-in');
    }

    $limiter = config('fortify.limiters.login');

    Route::post('/sign-in', [AuthenticatedSessionController::class, 'store'])
         ->middleware(array_filter([
             'guest',
             $limiter ? 'throttle:'.$limiter : null,
         ]));

    Route::post('/sign-out', [AuthenticatedSessionController::class, 'destroy'])
         ->name('sign-out');
});
