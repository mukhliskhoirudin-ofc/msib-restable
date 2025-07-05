<?php

use App\Http\Controllers\Backend\ImageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['verify' => true]);

// Route::prefix('panel')->group(function () {
//     Route::get('dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

//backend
Route::prefix('panel')->middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return view('backend.dashboard');
    })->name('panel.dashboard');

    Route::resource('image', ImageController::class)->names('panel.image');
});
