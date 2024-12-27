<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="/imgs/logo/logo-aplikasi-ym.svg" type="image/x-icon">

  <title>Yayah Make Up - {{ $title }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  {{-- Font Awesome Icons --}}
  <script src="https://kit.fontawesome.com/9d4da73c07.js" crossorigin="anonymous"></script>

  {{-- Quill Editor --}}
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  @livewireStyles
</head>

<body class="bg-gray-100" x-data="{ sidebarOpen: false }">
  <livewire:layout.admin.sidebar />
  <!-- Main Content -->
  <div class="lg:pl-64">
    <!-- Top Navigation -->
    <div class="sticky top-0 z-10 flex items-center justify-between h-16 px-4 bg-white border-b lg:px-8">
      <button @click="sidebarOpen = true" class="lg:hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
      <div class="flex items-center">
        <span class="text-sm">{{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('admin.logout') }}">
          @csrf
          <button type="submit" class="ml-4 text-sm text-gray-600 hover:text-gray-800">
            Logout
          </button>
        </form>
      </div>
    </div>

    {{ $slot }}
  </div>

  @livewireScripts
</body>

</html>