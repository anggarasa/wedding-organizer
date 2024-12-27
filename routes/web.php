<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome.home', ['title' => 'Wedding Organizer']);
Route::view('/Layanan', 'welcome.layanan', ['title' => 'Layanan & Paket']);
Route::view('/Galery', 'welcome.galery', ['title' => 'Galery']);
Route::view('/Kontak', 'welcome.kontak', ['title' => 'Kontak']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'role:user'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
