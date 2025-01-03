<?php

use App\Http\Controllers\LogoutController;
use App\Livewire\Pages\Admin\Layanan\PaketPernikahan\CreatePaketPernikahan;
use App\Livewire\Pages\Admin\Layanan\PaketPernikahan\PaketPernikahan;
use App\Livewire\Pages\Admin\Layanan\SewaBaju\SewaBaju;
use App\Livewire\Pages\Admin\Layanan\SewaBaju\ShowSewaBaju;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeUnit\FunctionUnit;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin', 'verified'])->group(function () {
    Route::get('/dashboard-admin', function () {
        return view('dashboard-admin', ['title' => 'Dashboard']);
    })->name('dashboard');

    Route::prefix('layanan')->name('layanan.')->group(function () {
        Route::prefix('sewa-baju')->name('sewa-baju.')->group(function () {
            Route::get('/management', SewaBaju::class)->name('management-sewa-baju');
            Route::get('/show/{slug}', ShowSewaBaju::class)->name('show-sewa-baju');
        });

        Route::prefix('paket-pernikahan')->name('paket-pernikahan.')->group(function () {
            Route::get('/management', PaketPernikahan::class)->name('management');
            Route::get('/create', CreatePaketPernikahan::class)->name('create');
        });
    });

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});