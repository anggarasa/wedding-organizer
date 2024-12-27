<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/imgs/logo/logo-aplikasi-ym.svg" type="image/x-icon">

    {{-- Font Awesome Icons --}}
    <script src="https://kit.fontawesome.com/9d4da73c07.js" crossorigin="anonymous"></script>

    <title>Yayah Make Up - {{ $title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans">
    <x-navbar.navbar-welcome logo="{{ asset('imgs/logo/logo-ym-ungu.svg') }}" :menuItems="[
        ['label' => 'Home', 'url' => '/', 'route' => '/'],
        ['label' => 'Layanan', 'url' => '/Layanan', 'route' => 'Layanan'],
        ['label' => 'Galery', 'url' => '/Galery', 'route' => 'Galery'],
        ['label' => 'Kontak', 'url' => '/Kontak', 'route' => 'Kontak']
    ]" />

    {{ $slot }}

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Yayah Make Up</h3>
                    <p class="text-gray-400">Mewujudkan pernikahan impian Anda dengan layanan profesional dan
                        terpercaya.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Kontak</h3>
                    <p class="text-gray-400">Email: info@yayahmakeup.com</p>
                    <p class="text-gray-400">Telepon: (021) 1234-5678</p>
                    <p class="text-gray-400">WhatsApp: +62 812-3456-7890</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Jam Operasional</h3>
                    <p class="text-gray-400">Senin - Sabtu: 09:00 - 17:00</p>
                    <p class="text-gray-400">Minggu: Dengan Perjanjian</p>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">&copy; 2024 Yayah Make Up. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>