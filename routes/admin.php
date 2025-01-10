<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogoutController;
use App\Livewire\Pages\Admin\Diskon\DiskonCode\DiskonCode;
use App\Livewire\Pages\Admin\Diskon\DiskonPaketPernikahan\DiskonPaketPernikahan;
use SebastianBergmann\CodeUnit\FunctionUnit;
use App\Livewire\Pages\Admin\Layanan\SewaBaju\SewaBaju;
use App\Livewire\Pages\Admin\Layanan\SewaBaju\ShowSewaBaju;
use App\Livewire\Pages\Admin\Layanan\PaketPernikahan\PaketPernikahan;
use App\Livewire\Pages\Admin\Layanan\PaketPernikahan\ShowPaketPernikahan;
use App\Livewire\Pages\Admin\Layanan\PaketPernikahan\CrudPaketPernikahan;

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
            Route::get('/create', CrudPaketPernikahan::class)->name('create');
            Route::get('/edit/{slug}', CrudPaketPernikahan::class)->name('edit');
            Route::get('/show/{slug}', ShowPaketPernikahan::class)->name('show');
        });
    });

    Route::prefix('diskon')->name('diskon.')->group(function () {
        Route::prefix('diskon-code')->name('diskon-code.')->group(function () {
            Route::get('/management', DiskonCode::class)->name('management');
        });

        Route::prefix('diskon-paket')->name('diskon-paket.')->group(function() {
            Route::get('/management', DiskonPaketPernikahan::class);
        });
    });

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});