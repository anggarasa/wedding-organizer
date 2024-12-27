<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest', ['title' => 'Register'])] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email:dns,rfc,strict', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'min:10', 'max:13', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        event(new Registered($user = User::create([
            'name' => $validated['name'], 
            'email' => $validated['email'], 
            'phone' => $validated['phone'], 
            'password' => Hash::make($validated['password']),
            'slug' => Str::uuid() 
        ])));
        $user->assignRole('user');

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    {{-- Logo --}}
    <div class="text-center mb-8">
        <a href="/" wire:navigate class="font-medium">
            <div class="mb-4">
                <img src="{{ asset('imgs/logo/logo-aplikasi-ym.svg') }}" class="mx-auto h-16 w-16" alt="">
            </div>
            <h2 class="fancy-font text-5xl font-bold text-gray-800 mb-2">
                Yayah Make Up
            </h2>
        </a>
        <p class="text-gray-600">Daftar untuk memulai perjalanan indah Anda</p>
    </div>

    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl p-8 border border-violet-100">
        <form wire:submit="register" class="space-y-6">
            <!-- Nama Lengkap Input -->
            <div class="mb-4">
                <x-input name="name" label="Nama Lengkap" wire="name" placeholder="Masukan nama lengkap Anda"
                    required="true" />
            </div>

            <!-- Email Input -->
            <div class="mb-4">
                <x-input type="email" name="email" label="Email" wire="email" placeholder="Masukkan email Anda"
                    required="true" />
            </div>

            <!-- Nomor Telepon Input -->
            <div class="mb-4">
                <x-input type="tel" name="phone" label="Nomer Telepon" wire="phone"
                    placeholder="Masukkan no telepon Anda" required="true" />
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                {{--
                <x-input type="password" name="password" label="Password" wire="password"
                    placeholder="Masukkan Password" required="true" /> --}}
                <x-password-input name="password" label="Password" wireModel="password"
                    placeholder="Masukan Password" />
            </div>

            <!-- Konfirmasi Password Input -->
            <div class="mb-6">
                <x-password-input name="confirm_password" label="konfirmasi Password" wireModel="password_confirmation"
                    placeholder="Konfirmasi Password Anda" />
            </div>

            <!-- Register Button -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-violet-500 to-purple-500 text-white py-3 px-4 rounded-xl hover:from-violet-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:ring-opacity-50 transition duration-200 flex items-center justify-center transform hover:scale-[1.02]"
                wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed">
                <!-- Teks Normal -->
                <span wire:loading.remove>Daftar</span>

                <!-- Loading State -->
                <div wire:loading class="flex items-center gap-2">
                    <i class="fa-solid fa-spinner animate-spin text-xl"></i>
                    <span>Memproses...</span>
                </div>
            </button>
        </form>

        <!-- Login Link -->
        <p class="mt-8 text-center text-sm text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" wire:navigate
                class="text-violet-600 hover:text-violet-700 font-medium hover:underline">Login sekarang</a>
        </p>
    </div>

    <!-- Footer -->
    <div class="mt-8 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} Yayah Make Up. All rights reserved.</p>
    </div>
</div>