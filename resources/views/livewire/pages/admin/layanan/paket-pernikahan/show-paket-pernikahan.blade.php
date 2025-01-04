<div x-data="{
    sidebarOpen: false,
    bookingDropdown: false,
    settingsDropdown: false,
    package: {
        id: 1,
        name: 'Paket Gold Wedding',
        price: 8000000,
        description: 'Paket pernikahan premium dengan layanan lengkap untuk pengantin dan keluarga. Paket ini mencakup berbagai layanan premium untuk membuat hari pernikahan Anda menjadi sempurna.',
        longDescription: 'Paket Gold Wedding adalah pilihan sempurna untuk pasangan yang menginginkan pengalaman pernikahan yang mewah dan tak terlupakan. Dengan layanan makeup profesional menggunakan produk premium, penataan rambut oleh stylist berpengalaman, dan berbagai layanan tambahan yang akan membuat Anda dan keluarga tampil memukau di hari istimewa Anda.',
        includes: [
            'Make up pengantin (HD Premium)',
            'Touch up 3x selama acara',
            'Hair do premium dengan hair piece',
            'Make up dan hair do untuk 2 anggota keluarga',
            'Make up dan hair do untuk 2 bridesmaid',
            'Free konsultasi sebelum hari H',
            'Free trial make up',
            'Pemasangan bulu mata premium',
            'Perawatan kulit dasar sebelum makeup'
        ],
        additionalServices: [
            'Tambahan make up keluarga - Rp 350.000/orang',
            'Tambahan touch up - Rp 250.000/sesi',
            'Hair piece premium - Rp 200.000',
            'Extension bulu mata - Rp 150.000'
        ],
        terms: [
            'Booking minimal 2 bulan sebelum hari H',
            'Down payment 50% untuk konfirmasi tanggal',
            'Pelunasan H-7 sebelum acara',
            'Pembatalan maksimal H-30 (DP tidak dapat dikembalikan)',
            'Free revisi 1x saat trial makeup',
            'Layanan touch up berlaku 6 jam'
        ],
        images: [
            'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\' viewBox=\'0 0 400 300\' fill=\'none\'%3E%3Crect width=\'400\' height=\'300\' fill=\'%238B5CF6\' opacity=\'0.1\'/%3E%3Cpath d=\'M180 140h40v40h-40z\' fill=\'%238B5CF6\' opacity=\'0.2\'/%3E%3C/svg%3E',
            'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\' viewBox=\'0 0 400 300\' fill=\'none\'%3E%3Crect width=\'400\' height=\'300\' fill=\'%238B5CF6\' opacity=\'0.1\'/%3E%3Cpath d=\'M180 140h40v40h-40z\' fill=\'%238B5CF6\' opacity=\'0.2\'/%3E%3C/svg%3E',
            'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\' viewBox=\'0 0 400 300\' fill=\'none\'%3E%3Crect width=\'400\' height=\'300\' fill=\'%238B5CF6\' opacity=\'0.1\'/%3E%3Cpath d=\'M180 140h40v40h-40z\' fill=\'%238B5CF6\' opacity=\'0.2\'/%3E%3C/svg%3E',
        ],
        reviews: [
            {
                name: 'Sarah Putri',
                date: '15 Jan 2024',
                rating: 5,
                comment: 'Sangat puas dengan hasil makeupnya. Natural tapi tetap glamor. Recommended!'
            },
            {
                name: 'Rina Amanda',
                date: '20 Jan 2024',
                rating: 5,
                comment: 'Pelayanan sangat profesional, hasil sesuai dengan ekspektasi.'
            }
        ],
        dresses: {
            akad: [
                {
                    id: 1,
                    name: 'Kebaya Modern Putih',
                    description: 'Kebaya modern dengan detail bordir dan payet',
                    image: 'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\' viewBox=\'0 0 400 300\' fill=\'none\'%3E%3Crect width=\'400\' height=\'300\' fill=\'%238B5CF6\' opacity=\'0.1\'/%3E%3Cpath d=\'M180 140h40v40h-40z\' fill=\'%238B5CF6\' opacity=\'0.2\'/%3E%3C/svg%3E'
                },
                {
                    id: 2,
                    name: 'Kebaya Tradisional Cream',
                    description: 'Kebaya tradisional dengan sentuhan modern',
                    image: 'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\' viewBox=\'0 0 400 300\' fill=\'none\'%3E%3Crect width=\'400\' height=\'300\' fill=\'%238B5CF6\' opacity=\'0.1\'/%3E%3Cpath d=\'M180 140h40v40h-40z\' fill=\'%238B5CF6\' opacity=\'0.2\'/%3E%3C/svg%3E'
                }
            ],
            resepsi: [
                {
                    id: 1,
                    name: 'Gaun Pengantin Putih',
                    description: 'Gaun modern dengan ekor panjang',
                    image: 'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\' viewBox=\'0 0 400 300\' fill=\'none\'%3E%3Crect width=\'400\' height=\'300\' fill=\'%238B5CF6\' opacity=\'0.1\'/%3E%3Cpath d=\'M180 140h40v40h-40z\' fill=\'%238B5CF6\' opacity=\'0.2\'/%3E%3C/svg%3E'
                },
                {
                    id: 2,
                    name: 'Gaun Ball Gown Rose Gold',
                    description: 'Gaun mewah dengan detail kristal',
                    image: 'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\' viewBox=\'0 0 400 300\' fill=\'none\'%3E%3Crect width=\'400\' height=\'300\' fill=\'%238B5CF6\' opacity=\'0.1\'/%3E%3Cpath d=\'M180 140h40v40h-40z\' fill=\'%238B5CF6\' opacity=\'0.2\'/%3E%3C/svg%3E'
                }
            ]
        },
        featured: true,
        activeTab: 'description'
    }
}">
    <main class="p-4 lg:p-8">
        <!-- Back Button -->
        <a href="{{ route('admin.layanan.paket-pernikahan.management') }}"
            class="inline-flex items-center text-violet-600 hover:text-violet-700 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali ke Management Paket
        </a>

        <!-- Package Header -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
            <div class="p-6 sm:p-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="mb-4 lg:mb-0">
                        <div class="flex items-center">
                            <h1 class="text-3xl font-bold text-gray-900">{{ $paket->name }}</h1>
                            <span x-show="package.featured"
                                class="ml-4 px-3 py-1 bg-violet-100 text-violet-800 text-sm font-semibold rounded-full">
                                Diskon
                            </span>
                        </div>
                        <p class="mt-2 text-violet-600 text-2xl font-bold">
                            Rp <span>{{ number_format($paket->price, 0, ',','.') }}</span>
                        </p>
                    </div>
                    <div class="flex space-x-3">
                        <button
                            class="px-6 py-3 bg-white border-2 border-violet-600 text-violet-600 rounded-lg hover:bg-violet-50 transition-colors">
                            Edit Paket
                        </button>
                        <button
                            class="px-6 py-3 bg-violet-600 text-white rounded-lg hover:bg-violet-700 transition-colors">
                            Hapus Paket
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Gallery -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            @foreach ($paket->imagePaketPernikahans as $image)
            <div class="relative rounded-lg overflow-hidden h-64">
                <img src="{{ asset('storage/paket-pernikahan/'. $image->path) }}" alt="{{ $paket->name }}"
                    class="w-full h-full object-cover" />
            </div>
            @endforeach
        </div>

        <!-- Content Tabs -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="border-b">
                <nav class="flex space-x-8 px-6" aria-label="Tabs">
                    <button @click="package.activeTab = 'description'"
                        :class="{'text-violet-600 border-violet-600': package.activeTab === 'description', 'text-gray-500 hover:text-gray-700 border-transparent': package.activeTab !== 'description'}"
                        class="py-4 px-1 border-b-2 font-medium text-sm">
                        Deskripsi
                    </button>
                    <button @click="package.activeTab = 'includes'"
                        :class="{'text-violet-600 border-violet-600': package.activeTab === 'includes', 'text-gray-500 hover:text-gray-700 border-transparent': package.activeTab !== 'includes'}"
                        class="py-4 px-1 border-b-2 font-medium text-sm">
                        Yang Termasuk
                    </button>
                    <button @click="package.activeTab = 'additional'"
                        :class="{'text-violet-600 border-violet-600': package.activeTab === 'additional', 'text-gray-500 hover:text-gray-700 border-transparent': package.activeTab !== 'additional'}"
                        class="py-4 px-1 border-b-2 font-medium text-sm">
                        Layanan Tambahan
                    </button>
                    <button @click="package.activeTab = 'terms'"
                        :class="{'text-violet-600 border-violet-600': package.activeTab === 'terms', 'text-gray-500 hover:text-gray-700 border-transparent': package.activeTab !== 'terms'}"
                        class="py-4 px-1 border-b-2 font-medium text-sm">
                        Syarat & Ketentuan
                    </button>
                    <button @click="package.activeTab = 'reviews'"
                        :class="{'text-violet-600 border-violet-600': package.activeTab === 'reviews', 'text-gray-500 hover:text-gray-700 border-transparent': package.activeTab !== 'reviews'}"
                        class="py-4 px-1 border-b-2 font-medium text-sm">
                        Review
                    </button>
                    <button @click="package.activeTab = 'dresses'"
                        :class="{'text-violet-600 border-violet-600': package.activeTab === 'dresses', 'text-gray-500 hover:text-gray-700 border-transparent': package.activeTab !== 'dresses'}"
                        class="py-4 px-1 border-b-2 font-medium text-sm">
                        Baju Pengantin
                    </button>
                </nav>
            </div>

            <div class="p-6">
                <!-- Description Tab -->
                <div x-show="package.activeTab === 'description'">
                    <p class="text-gray-600">{!! $paket->description !!}</p>
                </div>

                <!-- Includes Tab -->
                <div x-show="package.activeTab === 'includes'">
                    @php
                    $dom = new DOMDocument();
                    $dom->loadHTML($paket->include, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                    $items = $dom->getElementsByTagName('li');
                    @endphp

                    <ul class="space-y-2">
                        @foreach($items as $item)
                        <li class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>{!! $item->nodeValue !!}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Additional Services Tab -->
                <div x-show="package.activeTab === 'additional'">
                    <ul class="space-y-3">
                        <template x-for="service in package.additionalServices" :key="service">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-violet-500 mr-3 mt-0.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span class="text-gray-600" x-text="service"></span>
                            </li>
                        </template>
                    </ul>
                </div>

                <!-- Terms Tab -->
                <div x-show="package.activeTab === 'terms'">
                    @php
                    $dom = new DOMDocument();
                    $dom->loadHTML($paket->syarat, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                    $items = $dom->getElementsByTagName('li');
                    @endphp

                    <ul class="space-y-2">
                        @foreach($items as $item)
                        <li class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>{!! $item->nodeValue !!}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Reviews Tab -->
                <div x-show="package.activeTab === 'reviews'">
                    <div class="space-y-6">
                        <template x-for="review in package.reviews" :key="review.name">
                            <div class="border-b border-gray-200 pb-6 last:border-b-0 last:pb-0">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <h4 class="font-medium text-gray-900" x-text="review.name"></h4>
                                        <p class="text-sm text-gray-500" x-text="review.date"></p>
                                    </div>
                                    <div class="flex">
                                        <template x-for="i in 5">
                                            <svg class="w-5 h-5"
                                                :class="i <= review.rating ? 'text-yellow-400' : 'text-gray-300'"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                        </template>
                                    </div>
                                </div>
                                <p class="text-gray-600" x-text="review.comment"></p>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Dresses Tab -->
                <div x-show="package.activeTab === 'dresses'" class="space-y-8">
                    <!-- Baju Akad -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Baju Akad
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($bajusAkad as $akad)
                            <div
                                class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow">
                                <div class="relative aspect-[4/3]">
                                    @foreach ($akad->imageSewaBajus as $image)
                                    <img src="{{ asset('storage/sewa-baju/'. $image->image) }}" alt="{{ $akad->name }}"
                                        class="w-full h-full object-cover" />
                                    @endforeach
                                    <div class="absolute top-2 right-2">
                                        <button class="p-2 bg-white rounded-full shadow-md hover:bg-gray-50">
                                            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h4 class="font-medium text-gray-900 mb-1">{{ $akad->name }}</h4>
                                    <p class="text-sm text-gray-600">{{ $akad->description }}</p>
                                </div>
                            </div>
                            @endforeach
                            <!-- Add New Akad Dress Button -->
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center hover:border-violet-500 cursor-pointer transition-colors p-4 aspect-[4/3]">
                                <div class="text-center">
                                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <span class="text-sm text-gray-600">Tambah Baju Akad</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Baju Resepsi -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Baju Resepsi
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($bajusResepsi as $resepsi)
                            <div
                                class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow">
                                <div class="relative aspect-[4/3]">
                                    @foreach ($resepsi->imageSewaBajus as $image)
                                    <img src="{{ asset('storage/sewa-baju/'. $image->image) }}"
                                        alt="{{ $resepsi->name }}" class="w-full h-full object-cover" />
                                    <div class="absolute top-2 right-2">
                                        @endforeach
                                        <button class="p-2 bg-white rounded-full shadow-md hover:bg-gray-50">
                                            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h4 class="font-medium text-gray-900 mb-1">{{ $resepsi->name }}</h4>
                                    <p class="text-sm text-gray-600">{{ $resepsi->description }}</p>
                                </div>
                            </div>
                            @endforeach
                            <!-- Add New Resepsi Dress Button -->
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center hover:border-violet-500 cursor-pointer transition-colors p-4 aspect-[4/3]">
                                <div class="text-center">
                                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <span class="text-sm text-gray-600">Tambah Baju Resepsi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>