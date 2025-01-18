<?php

use App\Livewire\Pages\User\Dashboard;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:user'])->group(function() {
  Route::get('/home', Dashboard::class)->name('dashboard');
});