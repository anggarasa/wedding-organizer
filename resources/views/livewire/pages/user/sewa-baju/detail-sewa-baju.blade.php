<div x-data="{
    currentImage: 0,
    images: {{ $baju->imageSewaBajus->pluck('image') }},
    selectSize: 'M',
    quantity: 1,
    showBookingModal: false
}">
    <!-- main content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6">
                <!-- Image Gallery -->
                <div class="space-y-4">
                    <!-- Image Display -->
                    <div class="relative aspect-[4/3] overflow-hidden rounded-lg">
                        <template x-for="(image, index) in images" :key="index">
                            <img :src="`{{ asset('storage/sewa-baju') }}/${image}`"
                                class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300"
                                :class="{'opacity-100': currentImage === index, 'opacity-0': currentImage !== index}" />
                        </template>

                        <!-- Navigation Arrows -->
                        <button @click="currentImage = (currentImage - 1 + images.length) % images.length"
                            class="absolute left-2 top-1/2 -translate-y-1/2 p-2 rounded-full bg-white/80 hover:bg-white shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="currentImage = (currentImage + 1) % images.length"
                            class="absolute right-2 top-1/2 -translate-y-1/2 p-2 rounded-full bg-white/80 hover:bg-white shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    </div>

                    <!-- Thumbnails -->
                    <div class="grid grid-cols-4 gap-2">
                        <template x-for="(image, index) in images" :key="index">
                            <button @click="currentImage = index"
                                class="relative aspect-square rounded-lg overflow-hidden"
                                :class="{'ring-2 ring-violet-500': currentImage === index}">
                                <img :src="`{{ asset('storage/sewa-baju') }}/${image}`"
                                    class="w-full h-full object-cover" />
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="space-y-6">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">
                            {{ $baju->name }}
                        </h1>
                    </div>

                    <div class="space-y-2">
                        <p class="text-3xl font-bold text-gray-900">Rp {{ $baju->price }}</p>
                        <p class="text-sm text-gray-500">*Harga sewa per hari</p>
                    </div>

                    <div class="border-t pt-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">
                                    Kategori
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $baju->category }}
                                </p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Status</h3>
                                <p class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @switch($baju->status)
                                            @case('Tersedia')
                                                bg-green-100 text-green-800
                                                @break
                                            @case('Disewa')
                                                bg-yellow-100 text-yellow-800
                                                @break
                                            @case('Tidak Tersedia')
                                                bg-red-100 text-red-800
                                                @break
                                        
                                            @default
                                                
                                        @endswitch
                                        ">
                                        {{ $baju->status }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Size Selection -->
                    <div class="border-t pt-4">
                        <h3 class="text-sm font-medium text-gray-900">Ukuran</h3>
                        <div class="grid grid-cols-5 gap-2 mt-2">
                            <template x-for="size in ['XS', 'S', 'M', 'L', 'XL']">
                                <button @click="selectSize = size"
                                    class="flex items-center justify-center px-4 py-2 border rounded-lg text-sm font-medium"
                                    :class="selectSize === size ? 'border-violet-500 text-violet-600 bg-violet-50' : 'border-gray-200 text-gray-900 hover:bg-gray-50'"
                                    x-text="size"></button>
                            </template>
                        </div>
                    </div>

                    <!-- Size Guide -->
                    <div class="border rounded-lg p-4 bg-gray-50">
                        <h3 class="text-sm font-medium text-gray-900 mb-2">
                            Panduan Ukuran
                        </h3>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p>XS: Lingkar Dada 80-84cm, Lingkar Pinggang 60-64cm</p>
                            <p>S: Lingkar Dada 84-88cm, Lingkar Pinggang 64-68cm</p>
                            <p>M: Lingkar Dada 88-92cm, Lingkar Pinggang 68-72cm</p>
                            <p>L: Lingkar Dada 92-96cm, Lingkar Pinggang 72-76cm</p>
                            <p>XL: Lingkar Dada 96-100cm, Lingkar Pinggang 76-80cm</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="border-t pt-4">
                        <h3 class="text-sm font-medium text-gray-900">Deskripsi</h3>
                        <div class="mt-2 prose prose-sm text-gray-500">
                            <p>
                                {{ $baju->description }}
                            </p>
                        </div>
                    </div>

                    <!-- Booking Button -->
                    <div class="border-t pt-4">
                        <button @click="showBookingModal = true"
                            class="w-full flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-violet-600 rounded-lg hover:bg-violet-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Booking Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Items -->
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">
                Rekomendasi Baju Lainnya
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($rekomendBaju as $rekomend)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="aspect-[4/3]">
                        @foreach ($rekomend->imageSewaBajus->take(1) as $image)
                        <img src="{{ asset('storage/sewa-baju/'. $image->image) }}"
                            class="w-full h-full object-cover" />
                        @endforeach
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900">
                            {{ Str::limit($rekomend->name, 20, '...') }}
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $rekomend->category }}
                        </p>
                        <p class="font-semibold text-gray-900 mt-2">Rp {{ number_format($rekomend->price,0,',','.') }}
                        </p>
                        <button onclick="window.location.href='{{ route('detail.baju', $rekomend->slug) }}'"
                            class="w-full mt-3 px-4 py-2 text-violet-600 border border-violet-600 rounded-lg hover:bg-violet-50">Lihat
                            Detail</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Booking Modal -->
        <div x-show="showBookingModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none">
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
            <div class="relative flex items-center justify-center min-h-screen p-4">
                <div class="relative w-full max-w-2xl p-6 bg-white rounded-xl shadow-lg">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">
                            Booking Baju
                        </h2>
                        <button @click="showBookingModal = false" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form class="space-y-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Mulai Sewa</label>
                                <input type="date"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500" />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Selesai Sewa</label>
                                <input type="date"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500" />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Waktu Pengambilan</label>
                                <input type="time"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500" />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Waktu Pengembalian</label>
                                <input type="time"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500" />
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Catatan Tambahan</label>
                            <textarea rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
                                placeholder="Tambahkan catatan khusus jika ada..."></textarea>
                        </div>

                        <!-- Summary -->
                        <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Harga Sewa per Hari</span>
                                <span class="font-medium">Rp 5.500.000</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Durasi Sewa</span>
                                <span class="font-medium">2 Hari</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Deposit</span>
                                <span class="font-medium">Rp 2.000.000</span>
                            </div>
                            <div class="pt-2 border-t">
                                <div class="flex justify-between">
                                    <span class="font-medium">Total Pembayaran</span>
                                    <span class="font-semibold text-violet-600">Rp 13.000.000</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" @click="showBookingModal = false"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-violet-600 rounded-lg hover:bg-violet-700">
                                Konfirmasi Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>