<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogoutController;
use SebastianBergmann\CodeUnit\FunctionUnit;
use App\Livewire\Pages\Admin\Layanan\SewaBaju\SewaBaju;
use App\Livewire\Pages\Admin\Layanan\SewaBaju\ShowSewaBaju;
use App\Livewire\Pages\Admin\Layanan\PaketPernikahan\PaketPernikahan;
use App\Livewire\Pages\Admin\Layanan\PaketPernikahan\ShowPaketPernikahan;
use App\Livewire\Pages\Admin\Layanan\PaketPernikahan\CreatePaketPernikahan;

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
            Route::get('/edit/{slug}', CreatePaketPernikahan::class)->name('edit');
            Route::get('/show/{slug}', ShowPaketPernikahan::class)->name('show');
        });
    });

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});