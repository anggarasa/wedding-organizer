<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<header class="bg-gradient-to-r from-violet-500 to-purple-600 fixed w-full z-50">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" wire:navigate class="hidden md:block text-white text-2xl font-bold">Yayah
                Make Up</a>
            <a href="{{ route('dashboard') }}" wire:navigate class="block md:hidden">
                <img src="{{ asset('imgs/logo/logo-aplikasi-ym.svg') }}" class="w-8 h-8 object-cover"
                    alt="Yayah Make Up">
            </a>

            <!-- Search Bar -->
            <div class="flex-1 mx-8">
                <div class="relative">
                    <input type="text" placeholder="Cari produk..."
                        class="w-full py-2 px-4 rounded-lg focus:outline-none" />
                    <button class="absolute right-0 top-0 h-full px-4 bg-violet-500 text-white rounded-r-lg">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex items-center space-x-6">
                <a href="#" class="text-white hover:text-gray-200">
                    <i class="fas fa-shopping-cart text-xl"></i>
                </a>
                <a href="#" class="text-white hover:text-gray-200">
                    <i class="fas fa-bell text-xl"></i>
                </a>
                <div class="relative" x-data="{ isOpen: false }">
                    <!-- Profile Button -->
                    <button @click="isOpen = !isOpen" class="text-white hover:text-gray-200 focus:outline-none">
                        <i class="fas fa-user text-xl"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="isOpen" @click.away="isOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5">

                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-user-circle mr-2"></i>Profile
                        </a>

                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-cog mr-2"></i>Settings
                        </a>

                        <hr class="my-1">

                        <a wire:click="logout"
                            class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 cursor-pointer">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>