<?php

use App\Http\Controllers\LogoutController;
use App\Livewire\Pages\Admin\Layanan\SewaBaju\SewaBaju;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeUnit\FunctionUnit;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin', 'verified'])->group(function () {
    Route::get('/dashboard-admin', function () {
        return view('dashboard-admin', ['title' => 'Dashboard']);
    })->name('dashboard');

    Route::prefix('layanan')->name('layanan.')->group(function () {
        Route::get('/management-sewa-baju', SewaBaju::class)->name('sewa-baju');
    });

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});