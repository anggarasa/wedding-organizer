<nav x-data="{ isOpen: false }" class="bg-white shadow-lg fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <span class="text-2xl font-bold text-violet-600">
                    <img src="{{ $logo }}" alt="Logo" class="h-10 w-auto">
                </span>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button @click="isOpen = !isOpen" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Desktop menu -->
            <div class="hidden md:flex md:items-center md:space-x-4">
                <div class="flex items-center">
                    @foreach($menuItems as $item)
                    <a href="{{ $item['url'] }}"
                        class="px-3 py-2 {{ request()->is($item['route']) ? 'text-violet-600' : 'text-gray-700 hover:text-violet-600' }}">{{
                        $item['label']
                        }}</a>
                    @endforeach
                </div>

                <!-- Login dan Register Buttons -->
                <div class="flex items-center space-x-2">
                    @guest
                    <a href="{{ route('login') }}"
                        class="px-3 py-2 bg-violet-500 text-white rounded-md hover:bg-violet-600 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-3 py-2 border border-violet-500 text-violet-500 rounded-md hover:bg-violet-50 transition">
                        Register
                    </a>
                    @endguest

                    @auth
                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-2">
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                                class="w-8 h-8 rounded-full">
                            <span>{{ Auth::user()->name }}</span>
                        </button>

                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-violet-50">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-violet-50">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="isOpen" class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                @foreach($menuItems as $item)
                <a href="{{ $item['url'] }}"
                    class="block px-3 py-2 {{ request()->is($item['route']) ? 'text-violet-600' : 'text-gray-700 hover:text-violet-600' }}">{{
                    $item['label']
                    }}</a>
                @endforeach

                <!-- Mobile Login dan Register -->
                @guest
                <div class="space-y-2 pt-2 border-t">
                    <a href="{{ route('login') }}"
                        class="block w-full text-center px-3 py-2 bg-violet-500 text-white rounded-md">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="block w-full text-center px-3 py-2 border border-violet-500 text-violet-500 rounded-md">
                        Register
                    </a>
                </div>
                @endguest

                @auth
                <div class="pt-2 border-t">
                    <a href="{{ route('profile') }}" class="block px-3 py-2">
                        {{ Auth::user()->name }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2">
                            Logout
                        </button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </div>
</nav>