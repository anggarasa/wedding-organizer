<?php
use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new #[Layout('layouts.guest', ['title' => 'Login'])] class extends Component
{
    public LoginForm $form;

    /**
    * Handle an incoming authentication request.
    */
    public function login(): void
    {
        $this->validate();

        // Simpan user yang berhasil login
        $user = $this->form->authenticate();

        Session::regenerate();

        if ($user->hasRole('admin')) {
            $this->redirect(route('admin.dashboard'));
        } else {
            $this->redirect(route('dashboard'));
        }
    }
}; ?>

<div>
    <!-- Logo dan Judul -->
    <div class="text-center mb-8">
        <a href="/" wire:navigate class="font-medium">
            <div class="mb-4">
                <img src="{{ asset('imgs/logo/logo-aplikasi-ym.svg') }}" class="mx-auto h-16 w-16" alt="">
            </div>
            <h2 class="fancy-font text-5xl font-bold text-gray-800 mb-2">
                Yayah Make Up
            </h2>
        </a>
        <p class="text-gray-600">Wujudkan Pernikahan Impian Anda</p>
    </div>

    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl p-8 border border-violet-100">
        <form wire:submit="login" class="space-y-6">
            <!-- Email Input -->
            <div class="mb-6">
                <x-input type="email" name="email" label="Email" placeholder="Masukan email anda" wire="form.email"
                    required="true" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <!-- Password Input -->
            <div class="mb-6">
                <x-input type="password" name="password" wire="form.password" placeholder="Masukan password anda"
                    label="Password" required="true" />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" wire:model="form.remember"
                        class="rounded-md border-gray-300 text-violet-500 focus:ring-violet-400 h-4 w-4" />
                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                </label>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm text-violet-600 hover:text-violet-700 font-medium hover:underline">Lupa
                    password?</a>
                @endif
            </div>

            <!-- Login Button -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-violet-500 to-purple-500 text-white py-3 px-4 rounded-xl hover:from-violet-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:ring-opacity-50 transition duration-200 flex items-center justify-center transform hover:scale-[1.02]"
                wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed">
                <!-- Teks Normal -->
                <span wire:loading.remove>Masuk</span>

                <!-- Loading State -->
                <div wire:loading class="flex items-center gap-2">
                    <i class="fa-solid fa-spinner animate-spin text-xl"></i>
                    <span>Memproses...</span>
                </div>
            </button>
        </form>

        <!-- Register Link -->
        <p class="mt-8 text-center text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" wire:navigate
                class="text-violet-600 hover:text-violet-700 font-medium hover:underline">Daftar sekarang</a>
        </p>
    </div>

    <!-- Footer -->
    <div class="mt-8 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} Yayah Make Up. All rights reserved.</p>
    </div>
</div>