<x-welcome-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Hero Section -->
    <section class="relative pt-16">
        <div class="bg-gradient-to-r from-violet-100 to-purple-100 h-[600px] flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-4">
                        Wujudkan Pernikahan Impianmu
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-600 mb-8">
                        Kami siap membantu mewujudkan hari spesial Anda menjadi momen yang tak terlupakan
                    </p>
                    <a href="#"
                        class="bg-violet-600 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-violet-700 transition duration-300">
                        Konsultasi Gratis
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Layanan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="w-16 h-16 bg-violet-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2">Make Up</h3>
                    <p class="text-gray-600 text-center">Layanan make up profesional untuk pengantin dan keluarga</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="w-16 h-16 bg-violet-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2">Dekorasi</h3>
                    <p class="text-gray-600 text-center">Dekorasi pernikahan yang elegan dan sesuai keinginan Anda</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="w-16 h-16 bg-violet-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2">Sewa Busana</h3>
                    <p class="text-gray-600 text-center">Koleksi busana pernikahan modern dan tradisional</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-violet-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Siap Mewujudkan Pernikahan Impian Anda?</h2>
                <p class="text-xl text-gray-600 mb-8">Hubungi kami sekarang untuk konsultasi gratis</p>
                <a href="#"
                    class="bg-violet-600 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-violet-700 transition duration-300">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>
</x-welcome-layout>