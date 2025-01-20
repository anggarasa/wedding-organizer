<div>
    <!-- Carousel -->
    <div class="container max-w-7xl mx-auto px-4 py-6" x-data="carousel()">
        <div class="bg-white rounded-xl overflow-hidden shadow-lg">
            <div class="relative h-[200px] sm:h-[300px] md:h-[400px] lg:h-[500px]">
                <!-- Carousel container -->
                <div class="relative h-full">
                    <!-- Slides -->
                    <template x-for="(slide, index) in slides" :key="index">
                        <div x-show="currentSlide === index" x-transition:enter="transition transform duration-500"
                            x-transition:enter-start="opacity-0 translate-x-full"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition transform duration-500"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-full" class="absolute inset-0">
                            <!-- Background Image dengan Overlay -->
                            <div class="relative w-full h-full">
                                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                                    :style="`background-image: url('${slide.image}')`"></div>
                                <!-- Overlay gradient untuk memastikan teks tetap terbaca -->
                                <div :class="slide.overlay" class="absolute inset-0 opacity-60"></div>

                                <!-- Content -->
                                <div class="relative h-full flex items-center justify-center px-4">
                                    <div class="text-center text-white">
                                        <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-2 sm:mb-4 text-shadow"
                                            x-text="slide.title"></h1>
                                        <p class="text-sm sm:text-base md:text-lg lg:text-xl mb-4 sm:mb-6 text-shadow"
                                            x-text="slide.description"></p>
                                        <button :class="slide.buttonClass"
                                            class="text-sm sm:text-base px-4 sm:px-8 py-2 sm:py-3 rounded-full font-semibold hover:opacity-90 transition shadow-lg">
                                            Belanja Sekarang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Navigation Buttons -->
                    <button @click="previousSlide"
                        class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black/20 hover:bg-black/40 rounded-full p-2 backdrop-blur-sm transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button @click="nextSlide"
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black/20 hover:bg-black/40 rounded-full p-2 backdrop-blur-sm transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Indicators -->
                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                        <template x-for="(slide, index) in slides" :key="index">
                            <button @click="currentSlide = index"
                                :class="{'w-8 bg-white': currentSlide === index, 'w-2 bg-white/50': currentSlide !== index}"
                                class="h-2 rounded-full transition-all duration-300"></button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kategori -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Kategori Layanan</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <a href="#" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow text-center">
                <i class="fas fa-ring text-violet-600 text-2xl mb-2"></i>
                <p class="text-gray-600">Paket Lengkap</p>
            </a>
            <a href="#" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow text-center">
                <i class="fas fa-camera text-violet-600 text-2xl mb-2"></i>
                <p class="text-gray-600">Dokumentasi</p>
            </a>
            <a href="#" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow text-center">
                <i class="fas fa-palette text-violet-600 text-2xl mb-2"></i>
                <p class="text-gray-600">Dekorasi</p>
            </a>
            <a href="#" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow text-center">
                <i class="fas fa-music text-violet-600 text-2xl mb-2"></i>
                <p class="text-gray-600">Entertainment</p>
            </a>
            <a href="#" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow text-center">
                <i class="fas fa-utensils text-violet-600 text-2xl mb-2"></i>
                <p class="text-gray-600">Catering</p>
            </a>
            <a href="#" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow text-center">
                <i class="fas fa-tshirt text-violet-600 text-2xl mb-2"></i>
                <p class="text-gray-600">Busana</p>
            </a>
        </div>
    </div>

    <!-- Recommended Products -->
    <div class="container max-w-7xl mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">Rekomendasi Untukmu</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <!-- Product Card -->
            @foreach ($rekomendasi as $item)
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden">
                <div class="relative">
                    @php
                    $imagePath = $item['type'] === 'paket'
                    ? 'storage/paket-pernikahan/' . ($item['images'][0]->path ?? 'default.jpg')
                    : 'storage/sewa-baju/' . ($item['images'][0]->image ?? 'default.jpg');
                    @endphp

                    <img src="{{ asset($imagePath) }}" alt="{{ $item['name'] }}"
                        class="h-48 w-full object-cover rounded-t-xl">

                    @if ($item['discount'] && $item['finalPrice'] !== null)
                    <div class="absolute top-2 left-2 bg-violet-600 text-white px-2 py-1 rounded-lg text-sm">
                        -{{ number_format($item['discount'], 0, ',', '.') }}%
                    </div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-semibold mb-2 truncate">{{ $item['name'] }}</h3>
                    <div class="text-violet-600 font-bold mb-2">
                        @if ($item['discount'] && $item['finalPrice'] !== null)
                        Rp {{ number_format($item['finalPrice'],0,',','.') }}
                        @else
                        Rp {{ number_format($item['price'],0,',','.') }}
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-1 text-yellow-400">
                            <i class="fas fa-star"></i>
                            <span class="text-gray-600 text-sm">4.8</span>
                        </div>
                        <span class="text-gray-600 text-sm">Terjual 5rb</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Show More Button -->
        @if (count($rekomendasi) < $allRekomendasi->count())
            <div class="my-9 text-center">
                <button wire:click="showMore" class="px-4 py-2 bg-violet-600 text-white rounded-md hover:bg-violet-700">
                    Tampilkan Lebih Banyak
                </button>
            </div>
            @endif
    </div>

    <script>
        // Carousel bg image
        function carousel() {
          return {
            currentSlide: 0,
            slides: [
              {
                title: "Flash Sale! Diskon Hingga 90%",
                description: "Jangan lewatkan penawaran spesial hari ini",
                image:
                  "https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80",
                overlay: "bg-gradient-to-r from-purple-900 to-pink-900",
                buttonClass: "bg-purple-600 text-white hover:bg-purple-700",
              },
              {
                title: "New Arrival: Gadget Terbaru",
                description:
                  "Temukan koleksi gadget premium dengan harga spesial",
                image:
                  "https://images.unsplash.com/photo-1496171367470-9ed9a91ea931?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80",
                overlay: "bg-gradient-to-r from-blue-900 to-teal-900",
                buttonClass: "bg-blue-600 text-white hover:bg-blue-700",
              },
              {
                title: "Fashion Week Sale",
                description: "Tampil trendy dengan koleksi fashion terbaru",
                image:
                  "https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80",
                overlay: "bg-gradient-to-r from-orange-900 to-red-900",
                buttonClass: "bg-orange-600 text-white hover:bg-orange-700",
              },
              {
                title: "Promo Elektronik",
                description: "Dapatkan cashback hingga 1 juta rupiah",
                image:
                  "https://images.unsplash.com/photo-1550009158-9ebf69173e03?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80",
                overlay: "bg-gradient-to-r from-gray-900 to-black",
                buttonClass: "bg-gray-800 text-white hover:bg-gray-900",
              },
            ],
            previousSlide() {
              this.currentSlide =
                this.currentSlide === 0
                  ? this.slides.length - 1
                  : this.currentSlide - 1;
            },
            nextSlide() {
              this.currentSlide =
                this.currentSlide === this.slides.length - 1
                  ? 0
                  : this.currentSlide + 1;
            },
            init() {
              setInterval(() => this.nextSlide(), 5000);
            },
          };
        }
    </script>
</div>