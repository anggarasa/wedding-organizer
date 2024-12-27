<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout()
    {
        // Hapus semua session
        session()->flush();

        // Logout dari guard yang sesuai
        Auth::guard('web')->logout();

        // Invalidate session
        session()->invalidate();
        session()->regenerateToken();

        // Redirect ke halaman login
        return redirect()->route('login');
    }
}
