<?php

use App\Http\Controllers\Backend\ImageController;
use App\Http\Controllers\Backend\MenuController;
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
Route::prefix('panel')->middleware(['auth', 'verified'])->name('panel.')->group(function () {
    Route::get('dashboard', function () {
        return view('backend.dashboard');
    })->name('dashboard');

    // ini default uuid karena getRouteKeyName() = uuid
    Route::resource('image', ImageController::class)->names('image');
    // ini kalau mau pake route show pakai slug
    Route::get('image/{image:slug}', [ImageController::class, 'show'])->name('image.show');

    Route::resource('menu', MenuController::class)->names('menu');
    Route::get('menu/{menu:slug}', [MenuController::class, 'show'])->name('menu.show');
});
