<?php

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ChefController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\ImageController;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Backend\TransactionController;

// Route::get('/', function () {
//     return view('frontend.layouts.main');
// });

// frontend
Route::get('/', MainController::class);
Route::post('booking', [BookingController::class, 'store'])->name('booking.store');


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

    Route::resource('chef', ChefController::class)->names('chef');

    Route::resource('event', EventController::class)->except('show')->names('event');

    Route::get('transaction/export/excel', [TransactionController::class, 'export'])->name('transaction.export');
    Route::resource('transaction', TransactionController::class)->names('transaction');
});
