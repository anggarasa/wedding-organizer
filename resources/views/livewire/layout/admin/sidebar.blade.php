<div>
    <!-- Sidebar Mobile -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-40 lg:hidden"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
        <div class="fixed inset-y-0 left-0 flex flex-col w-64 bg-white border-r">
            <div class="flex items-center justify-between h-16 px-4 border-b">
                <a href="{{ route('admin.dashboard') }}" wire:navigate>
                    <img src="{{ asset('imgs/logo/logo-ym-ungu.svg') }}" alt="Yayah Make Up" class="w-full h-8">
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <nav class="flex-1 overflow-y-auto">
                <ul class="p-4">

                    <x-sidebar-menu-item href="{{ route('admin.dashboard') }}" label="Dashboard" icon="fas fa-home"
                        :active="request()->routeIs('admin.dashboard')" />

                    <x-sidebar-dropdown title="Layanan" icon="fas fa-gift" :links="[
                        ['label' => 'Sewa Baju', 'url' => '/admin/layanan/sewa-baju/management'],
                        ['label' => 'Sewa Dekorasi', 'url' => '/management-sewa-dekorasi'],
                        ['label' => 'Paket Pernikahan', 'url' => '/management-paket-pernikahan'],
                    ]" />

                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 text-gray-800 rounded hover:bg-pink-100">
                            Booking
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 text-gray-800 rounded hover:bg-pink-100">
                            Gallery
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 text-gray-800 rounded hover:bg-pink-100">
                            Testimonial
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Sidebar Desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col">
        <div class="flex flex-col flex-1 min-h-0 bg-white border-r">
            <div class="flex items-center h-16 px-4 border-b">
                <a href="{{ route('admin.dashboard') }}" wire:navigate>
                    <img src="{{ asset('imgs/logo/logo-ym-ungu.svg') }}" alt="Yayah Make Up" class="w-full h-8">
                </a>
            </div>
            <nav class="flex-1 overflow-y-auto">
                <ul class="p-4">
                    <x-sidebar-menu-item href="{{ route('admin.dashboard') }}" label="Dashboard" icon="fas fa-home"
                        :active="request()->routeIs('admin.dashboard')" />

                    <x-sidebar-dropdown title="Layanan" icon="fas fa-gift" :links="[
                        ['label' => 'Sewa Baju', 'url' => '/admin/layanan/sewa-baju/management'],
                        ['label' => 'Sewa Dekorasi', 'url' => '#'],
                        ['label' => 'Paket Pernikahan', 'url' => '#'],
                    ]" />

                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 text-gray-800 rounded hover:bg-pink-100">
                            Booking
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 text-gray-800 rounded hover:bg-pink-100">
                            Gallery
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 text-gray-800 rounded hover:bg-pink-100">
                            Testimonial
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>