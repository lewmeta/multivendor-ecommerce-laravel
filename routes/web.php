<?php

use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\VendorDashboardController;
use App\Http\Controllers\Frontend\VendorProfileController;
use App\Http\Controllers\Frontend\KycController;
use App\Http\Controllers\Frontend\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home.index');
});

// Route::get('/dashboard', function () {
//     return view('frontend.dashboard.dashboard-app');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard.index');
    // return view('admin.layouts.app');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/** Vendor Routes */

Route::group(['prefix' => 'vendor', 'as' => 'vendor.', 'middleware' => ['auth', 'verified']], function () {
     Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');

      /** Profile Routes */
    Route::get('/profile', [VendorProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [VendorProfileController::class, 'update'])->name('profile.update');

    /**
     * Store profile (Resource controller)
     */
    Route::resource('/store-profile', StoreController::class);
});

require __DIR__.'/auth.php';
