<?php

use App\Livewire\Pages\User\Dashboard;
use App\Livewire\Pages\User\PaketPernikahan\DetailPaketPernikahan;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:user'])->group(function() {
  Route::get('/home', Dashboard::class)->name('dashboard');

  Route::prefix('detail')->name('detail.')->group(function() {
    Route::get('/paket-pernikahan/{slug}', DetailPaketPernikahan::class)->name('paket');
  });
});