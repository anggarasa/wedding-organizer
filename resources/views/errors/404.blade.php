<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>404 - Yayah Make Up</title>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.x.x/dist/tailwind.min.css" rel="stylesheet" />
  <!-- Scripts -->
  <style>
    @keyframes float {
      0% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(-20px);
      }

      100% {
        transform: translateY(0px);
      }
    }

    .float {
      animation: float 3s ease-in-out infinite;
    }

    .bg-gradient {
      background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
    }
  </style>
</head>

<body class="bg-gradient-to-br from-violet-50 to-violet-100 min-h-screen flex items-center justify-center p-4">
  <div class="max-w-lg w-full">
    <div
      class="text-center bg-white p-8 md:p-12 shadow-2xl rounded-2xl border-t-4 border-violet-500 relative overflow-hidden">
      <!-- Decorative Elements -->
      <div class="absolute top-0 left-0 w-20 h-20 bg-violet-100 rounded-br-full opacity-50"></div>
      <div class="absolute bottom-0 right-0 w-20 h-20 bg-violet-100 rounded-tl-full opacity-50"></div>

      <!-- Wedding Icons -->
      <div class="mb-8 relative">
        <div class="float">
          <img src="{{ asset('imgs/logo/logo-aplikasi-ym.svg') }}" class="h-20 w-20 object-cover mx-auto" alt="">
        </div>
      </div>

      <!-- Error Title -->
      <h1 class="text-4xl md:text-5xl font-bold text-violet-600 mb-4">404</h1>
      <h2 class="text-2xl md:text-3xl font-semibold text-violet-500 mb-6">
        Halaman Tidak Ditemukan
      </h2>

      <!-- Error Message -->
      <p class="text-lg text-gray-600 mb-8 leading-relaxed">
        Maaf, halaman yang Anda cari tidak ditemukan.<br />
        Jika Anda merasa ini adalah kesalahan, silakan hubungi administrator.
      </p>

      <!-- Back Button -->
      <div class="flex justify-center space-x-4">
        @if (auth()->check() && auth()->user()->hasRole('admin'))
        <a class="px-8 py-3 bg-gradient text-white font-semibold rounded-xl shadow-lg hover:opacity-90 transform hover:-translate-y-1 transition-all duration-200 flex items-center"
          href="{{ route('admin.dashboard') }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
              clip-rule="evenodd" />
          </svg>
          Kembali
        </a>
        @elseif (auth()->check() && auth()->user()->hasRole('user'))
        <a class="px-8 py-3 bg-gradient text-white font-semibold rounded-xl shadow-lg hover:opacity-90 transform hover:-translate-y-1 transition-all duration-200 flex items-center"
          href="{{ route('dashboard') }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
              clip-rule="evenodd" />
          </svg>
          Kembali
        </a>
        @else
        <a class="px-8 py-3 bg-gradient text-white font-semibold rounded-xl shadow-lg hover:opacity-90 transform hover:-translate-y-1 transition-all duration-200 flex items-center"
          href="{{ url()->previous() }}" wire:navigate>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
              clip-rule="evenodd" />
          </svg>
          Kembali
        </a>
        @endif
      </div>

      <!-- Decorative Dots -->
      <div class="absolute top-10 right-10">
        <div class="grid grid-cols-2 gap-2">
          <div class="w-2 h-2 rounded-full bg-violet-200"></div>
          <div class="w-2 h-2 rounded-full bg-violet-300"></div>
          <div class="w-2 h-2 rounded-full bg-violet-300"></div>
          <div class="w-2 h-2 rounded-full bg-violet-200"></div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>