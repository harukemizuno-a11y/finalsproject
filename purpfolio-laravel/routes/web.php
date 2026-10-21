
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Homepage
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');

/*
|--------------------------------------------------------------------------
| Guest Authentication Pages
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');
});

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [PortfolioController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Portfolio Management
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/portfolios/create', [PortfolioController::class, 'create'])
        ->name('portfolios.create');

    Route::post('/portfolios', [PortfolioController::class, 'store'])
        ->name('portfolios.store');

    Route::get('/portfolios/{portfolio}/edit', [PortfolioController::class, 'edit'])
        ->name('portfolios.edit');

    Route::put('/portfolios/{portfolio}', [PortfolioController::class, 'update'])
        ->name('portfolios.update');

    Route::delete('/portfolios/{portfolio}', [PortfolioController::class, 'destroy'])
        ->name('portfolios.destroy');

Route::post('/portfolios/{portfolio}/publish', [PortfolioController::class, 'publish'])
    ->name('portfolios.publish');


    Route::get('/portfolios/{portfolio}/preview', [PortfolioController::class, 'preview'])
        ->name('portfolios.preview');
});

/*
|--------------------------------------------------------------------------
| Public Portfolio Page
|--------------------------------------------------------------------------
*/

Route::get('/p/{slug}', [PortfolioController::class, 'publicShow'])
    ->name('portfolios.public');


