<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MicrosoftController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Login SSO belum bisa berjalan apabila env belum di sesuaikan
Route::get('/login/microsoft', [MicrosoftController::class, 'redirectToMicrosoft'])->name('login.microsoft');
Route::get('/login/microsoft/callback', [MicrosoftController::class, 'handleMicrosoftCallback']);
