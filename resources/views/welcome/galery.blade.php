<x-welcome-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  <!-- Page Header -->
  <section class="pt-24 pb-12 bg-gradient-to-r from-violet-50 to-purple-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h1 class="text-4xl font-bold text-center text-gray-900 mb-4">Galeri</h1>
      <p class="text-xl text-center text-gray-600">Koleksi hasil karya kami dalam menghadirkan momen pernikahan yang
        indah</p>
    </div>
  </section>

  <!-- Gallery Filter -->
  <section class="py-8" x-data="{ activeFilter: 'semua' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-wrap justify-center gap-4 mb-8">
        <button @click="activeFilter = 'semua'"
          :class="{ 'bg-violet-600 text-white': activeFilter === 'semua', 'bg-gray-100 text-gray-800': activeFilter !== 'semua' }"
          class="px-6 py-2 rounded-full transition duration-300">
          Semua
        </button>
        <button @click="activeFilter = 'makeup'"
          :class="{ 'bg-violet-600 text-white': activeFilter === 'makeup', 'bg-gray-100 text-gray-800': activeFilter !== 'makeup' }"
          class="px-6 py-2 rounded-full transition duration-300">
          Make Up
        </button>
        <button @click="activeFilter = 'dekorasi'"
          :class="{ 'bg-violet-600 text-white': activeFilter === 'dekorasi', 'bg-gray-100 text-gray-800': activeFilter !== 'dekorasi' }"
          class="px-6 py-2 rounded-full transition duration-300">
          Dekorasi
        </button>
        <button @click="activeFilter = 'busana'"
          :class="{ 'bg-violet-600 text-white': activeFilter === 'busana', 'bg-gray-100 text-gray-800': activeFilter !== 'busana' }"
          class="px-6 py-2 rounded-full transition duration-300">
          Busana
        </button>
      </div>

      <!-- Gallery Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <!-- Gallery items dengan dummy content (dalam prakteknya akan menggunakan gambar real) -->
        <div x-show="activeFilter === 'semua' || activeFilter === 'makeup'" class="relative group">
          <div class="aspect-square bg-violet-200 rounded-lg overflow-hidden">
            <div class="w-full h-full bg-gradient-to-br from-violet-300 to-purple-300"></div>
          </div>
          <div
            class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
            <div class="text-white text-center p-4">
              <h3 class="font-semibold">Make Up Pengantin Modern</h3>
              <p class="text-sm">Wedding Make Up</p>
            </div>
          </div>
        </div>

        <div x-show="activeFilter === 'semua' || activeFilter === 'dekorasi'" class="relative group">
          <div class="aspect-square bg-purple-200 rounded-lg overflow-hidden">
            <div class="w-full h-full bg-gradient-to-br from-purple-300 to-violet-300"></div>
          </div>
          <div
            class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
            <div class="text-white text-center p-4">
              <h3 class="font-semibold">Dekorasi Pelaminan Mewah</h3>
              <p class="text-sm">Wedding Decoration</p>
            </div>
          </div>
        </div>

        <div x-show="activeFilter === 'semua' || activeFilter === 'busana'" class="relative group">
          <div class="aspect-square bg-violet-100 rounded-lg overflow-hidden">
            <div class="w-full h-full bg-gradient-to-br from-violet-200 to-purple-200"></div>
          </div>
          <div
            class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
            <div class="text-white text-center p-4">
              <h3 class="font-semibold">Gaun Pengantin Modern</h3>
              <p class="text-sm">Wedding Dress</p>
            </div>
          </div>
        </div>

        <div x-show="activeFilter === 'semua' || activeFilter === 'makeup'" class="relative group">
          <div class="aspect-square bg-purple-100 rounded-lg overflow-hidden">
            <div class="w-full h-full bg-gradient-to-br from-purple-200 to-violet-200"></div>
          </div>
          <div
            class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
            <div class="text-white text-center p-4">
              <h3 class="font-semibold">Make Up Natural</h3>
              <p class="text-sm">Wedding Make Up</p>
            </div>
          </div>
        </div>

        <!-- Tambahkan lebih banyak item gallery sesuai kebutuhan -->
      </div>
    </div>
  </section>

  <!-- Testimonial Section -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Apa Kata Mereka</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-violet-200 rounded-full"></div>
            <div class="ml-4">
              <h3 class="font-semibold">Sarah & Ahmed</h3>
              <p class="text-gray-600 text-sm">Jakarta</p>
            </div>
          </div>
          <p class="text-gray-600">"Make up yang natural dan tahan lama. Sangat puas dengan hasilnya!"</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-purple-200 rounded-full"></div>
            <div class="ml-4">
              <h3 class="font-semibold">Diana & Reza</h3>
              <p class="text-gray-600 text-sm">Bandung</p>
            </div>
          </div>
          <p class="text-gray-600">"Dekorasi yang sangat cantik dan sesuai dengan yang kami inginkan."</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
          <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-violet-200 rounded-full"></div>
            <div class="ml-4">
              <h3 class="font-semibold">Linda & Budi</h3>
              <p class="text-gray-600 text-sm">Surabaya</p>
            </div>
          </div>
          <p class="text-gray-600">"Tim yang sangat profesional dan hasil yang memuaskan!"</p>
        </div>
      </div>
    </div>
  </section>
</x-welcome-layout>