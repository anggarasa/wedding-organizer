<x-welcome-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  <!-- Page Header -->
  <section class="pt-24 pb-12 bg-gradient-to-r from-violet-50 to-purple-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h1 class="text-4xl font-bold text-center text-gray-900 mb-4">Hubungi Kami</h1>
      <p class="text-xl text-center text-gray-600">Konsultasikan kebutuhan pernikahan Anda dengan tim kami</p>
    </div>
  </section>

  <!-- Contact Information & Form -->
  <section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- Contact Information -->
        <div>
          <h2 class="text-2xl font-bold text-gray-900 mb-8">Informasi Kontak</h2>

          <div class="space-y-6">
            <div class="flex items-start">
              <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
              </div>
              <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-900">Alamat Studio</h3>
                <p class="mt-1 text-gray-600">
                  Jl. Contoh No. 123<br>
                  Kota Jakarta, 12345<br>
                  Indonesia
                </p>
              </div>
            </div>

            <div class="flex items-start">
              <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                  </path>
                </svg>
              </div>
              <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-900">Telepon</h3>
                <p class="mt-1 text-gray-600">
                  (021) 1234-5678<br>
                  +62 812-3456-7890 (WhatsApp)
                </p>
              </div>
            </div>

            <div class="flex items-start">
              <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                  </path>
                </svg>
              </div>
              <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-900">Email</h3>
                <p class="mt-1 text-gray-600">info@yayahmakeup.com</p>
              </div>
            </div>

            <div class="flex items-start">
              <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-900">Jam Operasional</h3>
                <p class="mt-1 text-gray-600">
                  Senin - Sabtu: 09:00 - 17:00<br>
                  Minggu: Dengan Perjanjian
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Contact Form -->
        <div class="bg-white rounded-lg shadow-lg p-8">
          <h2 class="text-2xl font-bold text-gray-900 mb-8">Kirim Pesan</h2>
          <form x-data="{ submitted: false }" @submit.prevent="submitted = true">
            <div class="space-y-6">
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="name" name="name"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500">
              </div>

              <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500">
              </div>

              <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                <input type="tel" id="phone" name="phone"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500">
              </div>

              <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Tanggal Pernikahan</label>
                <input type="date" id="date" name="date"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500">
              </div>

              <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                <textarea id="message" name="message" rows="4"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500"></textarea>
              </div>

              <div>
                <button type="submit"
                  class="w-full bg-violet-600 text-white px-6 py-3 rounded-md hover:bg-violet-700 transition duration-300">
                  Kirim Pesan
                </button>
              </div>
            </div>

            <!-- Success Message -->
            <div x-show="submitted" class="mt-6 p-4 bg-green-100 rounded-md">
              <p class="text-green-700 text-center">Terima kasih! Pesan Anda telah terkirim. Kami akan segera
                menghubungi Anda.</p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Map Section -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-2xl font-bold text-gray-900 mb-8">Lokasi Kami</h2>
      <div class="h-96 bg-gray-200 rounded-lg">
        <!-- Di sini Anda bisa menambahkan peta menggunakan Google Maps atau layanan peta lainnya -->
        <div class="w-full h-full flex items-center justify-center">
          <p class="text-gray-600">Peta Lokasi</p>
        </div>
      </div>
    </div>
  </section>
</x-welcome-layout>