<div x-data="{
        sidebarOpen: false,
        images: @entangle('imageViews'),
        temporaryImages: @entangle('temporaryImages'),
        previewFiles: [],
        currentImage: 0,
        selectSize: 'M',
        quantity: 1,
        showDeleteModal: false,
        showSuccessModal: false,
        showModal: false,
        showSubmit: false,

        handleFileSelect(event) {
            const files = Array.from(event.target.files);
            const currentImageCount = this.images.length;
            const allowedNewImages = 4 - currentImageCount;

            if (files.length > allowedNewImages) {
                alert(`Anda hanya dapat menambahkan ${allowedNewImages} gambar lagi.`);
                event.target.value = '';
                return;
            }

            this.previewFiles = files.map(file => URL.createObjectURL(file));
            @this.imagesSelected(files);
        },

        init() {
            window.addEventListener('resetFileInput', () => {
                document.getElementById('file-upload').value = '';
                this.previewFiles = [];
            });
        }
    }">

    <!-- Main Content -->
    <main class="p-4 lg:p-8">
        <!-- Back Button -->
        <a href="{{ route('admin.layanan.sewa-baju.management-sewa-baju') }}"
            class="inline-flex items-center text-violet-600 hover:text-violet-700 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali ke Management Sewa Baju
        </a>

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">
                    Detail {{ $sewaBaju->name }}
                </h1>
            </div>
            <div class="flex space-x-3">
                <button type="button" wire:click="updateSewaBaju"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-violet-600 bg-violet-50 rounded-lg hover:bg-violet-100">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit Produk
                </button>
                <button @click="showDeleteModal = true"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                    Hapus Produk
                </button>
            </div>
        </div>

        <!-- Tambahkan tab untuk informasi admin -->
        <div class="mb-6 border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <a href="#"
                    class="border-violet-500 text-violet-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Detail Produk
                </a>
                <a href="#"
                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Riwayat Pemesanan
                </a>
            </nav>
        </div>

        <!-- Tambahkan status management untuk admin -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
            <!-- Image Management -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Galeri Foto</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Image Preview -->
                    <div class="space-y-4">
                        <div class="aspect-w-4 aspect-h-3 rounded-lg bg-gray-100 overflow-hidden">
                            <img id="preview-image" class="object-cover w-full h-full"
                                :src="images[currentImage] ?? 'https://via.placeholder.com/800x600'" alt="Preview" />
                        </div>
                        <div class="grid grid-cols-4 gap-2">
                            <template x-for="(image, index) in images" :key="index">
                                <button type="button" @click="currentImage = index"
                                    class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden ring-2 transition-all"
                                    :class="currentImage === index ? 'ring-violet-500' : 'ring-transparent'">
                                    <img :src="image" class="object-cover w-full h-full" />
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="space-y-4">
                        <div
                            class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-violet-500 transition-colors">
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div class="mt-4 flex flex-col sm:flex-row items-center justify-center gap-2">
                                    <label for="file-upload"
                                        class="px-4 py-2 text-sm font-medium text-violet-600 bg-violet-50 rounded-lg hover:bg-violet-100 cursor-pointer">
                                        Pilih File
                                        <input id="file-upload" wire:model="temporaryImages" type="file"
                                            accept="image/*" class="hidden" multiple
                                            @change="handleFileSelect($event)" />
                                    </label>
                                    <span class="text-sm text-gray-500">atau drag and drop</span>
                                </div>
                                <p class="mt-2 text-xs text-gray-500">
                                    PNG, JPG, GIF hingga 10MB
                                </p>
                            </div>
                        </div>

                        <!-- Preview of Selected Images -->
                        <template x-if="previewFiles.length > 0">
                            <div class="space-y-2">
                                <h4 class="text-sm font-medium text-gray-700">Preview Gambar Baru</h4>
                                <div class="space-y-2">
                                    <template x-for="(file, index) in previewFiles" :key="index">
                                        <div class="flex items-center justify-between p-2 bg-gray-50 rounded-lg">
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-lg overflow-hidden">
                                                    <img :src="file" class="h-full w-full object-cover" />
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <!-- Uploaded Images List -->
                        <div class="space-y-2">
                            <h4 class="text-sm font-medium text-gray-700">Foto Terunggah</h4>
                            <div class="space-y-2">
                                @foreach ($sewaBaju->imageSewaBajus as $image)
                                <div class="flex items-center justify-between p-2 bg-gray-50 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-lg overflow-hidden">
                                            <img src="{{ asset('storage/sewa-baju/' . $image->image) }}"
                                                class="h-full w-full object-cover" />
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $image->image }}</p>
                                            <p class="text-xs text-gray-500">{{ $formattedSize }}</p>
                                        </div>
                                    </div>
                                    <button class="text-red-500 hover:text-red-700"
                                        wire:click="deleteImage({{ $image->id }})">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Upload and Cancel Buttons -->
                        <template x-if="previewFiles.length > 0">
                            <div class="flex justify-end space-x-3 mt-4">
                                <button wire:click="cancelUpload"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                                    Batal
                                </button>
                                <button wire:click="uploadNewImages"
                                    class="px-4 py-2 text-sm font-medium text-white bg-violet-600 rounded-lg hover:bg-violet-700">
                                    Upload
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>


            <h3 class="text-lg font-medium text-gray-900 mb-4">Status Management</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Status -->
                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="text-sm font-medium text-gray-500">Status</div>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" type="button"
                            class="relative w-full bg-white border border-gray-300 rounded-md pl-3 pr-10 py-2 text-left cursor-pointer focus:outline-none focus:ring-1 focus:ring-violet-500 focus:border-violet-500">
                            <span class="block truncate">{{ $sewaBaju->status }}</span>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>

                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute mt-1 w-full z-10 bg-white shadow-lg rounded-md py-1">
                            <a wire:click="updateStatus('Tersedia')" @click="open = false"
                                class="block px-4 py-2 text-sm cursor-pointer text-gray-700 hover:bg-violet-50 hover:text-violet-700">Tersedia</a>
                            <a wire:click="updateStatus('Disewa')" @click="open = false"
                                class="block px-4 py-2 text-sm cursor-pointer text-gray-700 hover:bg-violet-50 hover:text-violet-700">Disewa</a>
                            <a wire:click="updateStatus('Tidak Tersedia')" @click="open = false"
                                class="block px-4 py-2 text-sm cursor-pointer text-gray-700 hover:bg-violet-50 hover:text-violet-700">Tidak
                                Tersedia</a>
                        </div>
                    </div>
                </div>

                <!-- Kategori -->
                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="text-sm font-medium text-gray-500">Kategori</div>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" type="button"
                            class="relative w-full bg-white border border-gray-300 rounded-md pl-3 pr-10 py-2 text-left cursor-pointer focus:outline-none focus:ring-1 focus:ring-violet-500 focus:border-violet-500">
                            <span class="block truncate">{{ $sewaBaju->category }}</span>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>

                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute mt-1 w-full z-10 bg-white shadow-lg rounded-md py-1">
                            <a href="#" wire:click="updateCategory('Kebaya Akad')" @click="open = false"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-violet-50 hover:text-violet-700">Kebaya
                                Akad</a>
                            <a wire:click="updateCategory('Kebaya Resepsi')" @click="open = false"
                                class="block px-4 py-2 text-sm cursor-pointer text-gray-700 hover:bg-violet-50 hover:text-violet-700">Kebaya
                                Resepsi</a>
                            <a wire:click="updateCategory('Gaun Pengantin Modern')" @click="open = false"
                                class="block px-4 py-2 text-sm cursor-pointer text-gray-700 hover:bg-violet-50 hover:text-violet-700">Gaun
                                Pengantin Modern</a>
                            <a wire:click="updateCategory('Jas')" @click="open = false"
                                class="block px-4 py-2 text-sm cursor-pointer text-gray-700 hover:bg-violet-50 hover:text-violet-700">Jas</a>
                        </div>
                    </div>
                </div>

                <!-- Ukuran -->
                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="text-sm font-medium text-gray-500">Ukuran</div>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" type="button"
                            class="relative w-full bg-white border border-gray-300 rounded-md pl-3 pr-10 py-2 text-left cursor-pointer focus:outline-none focus:ring-1 focus:ring-violet-500 focus:border-violet-500">
                            <span class="block truncate">{{ $sewaBaju->ukuran }}</span>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>

                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute mt-1 w-full z-10 bg-white shadow-lg rounded-md py-1">
                            <a href="#" wire:click="updateUkuran('S')" @click="open = false"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-violet-50 hover:text-violet-700">S</a>
                            <a wire:click="updateUkuran('M')" @click="open = false"
                                class="block px-4 py-2 text-sm cursor-pointer text-gray-700 hover:bg-violet-50 hover:text-violet-700">M</a>
                            <a wire:click="updateUkuran('L')" @click="open = false"
                                class="block px-4 py-2 text-sm cursor-pointer text-gray-700 hover:bg-violet-50 hover:text-violet-700">L</a>
                            <a wire:click="updateUkuran('XL')" @click="open = false"
                                class="block px-4 py-2 text-sm cursor-pointer text-gray-700 hover:bg-violet-50 hover:text-violet-700">XL</a>
                            <a wire:click="updateUkuran('XXL')" @click="open = false"
                                class="block px-4 py-2 text-sm cursor-pointer text-gray-700 hover:bg-violet-50 hover:text-violet-700">XXL</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Details -->
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Price -->
                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="text-sm font-medium text-gray-500">Harga Sewa per Hari</div>
                    <div
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-2xl font-semibold border-gray-300 text-violet-500 rounded-md">
                        Rp {{ number_format($sewaBaju->price, 0, ',', '.') }}
                    </div>
                </div>

                <!-- Description -->
                <div x-data="{ expanded: false }" class="p-4 bg-gray-50 rounded-lg">
                    <div class="text-sm font-medium text-gray-500">Deskripsi</div>

                    <div class="quill-content">
                        @if(strlen($sewaBaju->description) > $descriptionLimit)
                        <div x-show="!expanded">
                            {!! Str::limit($sewaBaju->description, $descriptionLimit, '') !!}
                            <span class="text-gray-400">...</span>
                        </div>
                        <div x-show="expanded" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0">
                            {!! $sewaBaju->description !!}
                        </div>
                        <button @click="expanded = !expanded"
                            class="mt-2 text-[#7A1CAC] hover:text-[#6A189C] text-sm font-medium focus:outline-none">
                            <span x-text="expanded ? 'Lihat lebih sedikit' : 'Lihat lebih banyak'"></span>
                        </button>
                        @else
                        {!! $sewaBaju->description !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Tambahkan riwayat pemesanan untuk admin -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">
                Riwayat Pemesanan Terakhir
            </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pemesan
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Sewa
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Durasi
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                            src="https://ui-avatars.com/api/?name=Sarah+Smith" alt="" />
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            Sarah Smith
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            sarah@example.com
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">20 Jan 2024</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">2 Hari</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Selesai
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp 11.000.000
                            </td>
                        </tr>
                        <!-- Tambahkan baris lain sesuai kebutuhan -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Form -->
        <div x-show="showModal" @modal-edit-sewa-baju.window="showModal = true"
            @close-modal-edit-sewa-baju.window="showModal = false" class="fixed inset-0 z-30 overflow-y-auto"
            style="display: none">
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
            <div class="relative flex items-center justify-center min-h-screen p-4">
                <div class="relative w-full max-w-2xl p-6 bg-white rounded-xl shadow-lg">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Edit Deskripsi & Harga Baju
                        </h2>
                        <button type="button" wire:click="resetForm" class="text-gray-400 hover:text-gray-600">
                            <i class="fa-solid fa-x text-2xl"></i>
                        </button>
                    </div>

                    <form wire:submit="updateDescriptionAndPrice" class="space-y-6">
                        <div>
                            <x-input type="number" name="price" label="Harga Sewa" placeholder="Masukkan Harga Sewa"
                                wire="price" required="true" />
                        </div>

                        <div wire:ignore>
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                            <div id="description">{!! $description !!}</div>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" wire:click="resetForm"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-violet-600 rounded-lg hover:bg-violet-700">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi delete -->
        <div x-show="showDeleteModal" @close-modal-delete-sewa-baju.window="showDeleteModal = false"
            class="fixed inset-0 z-50 overflow-y-auto" style="display: none">
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
            <div class="relative flex items-center justify-center min-h-screen p-4">
                <div class="relative w-full max-w-md p-6 bg-white rounded-xl shadow-lg">
                    <div class="flex items-center justify-center mb-6">
                        <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                        </div>
                    </div>

                    <h3 class="text-lg font-medium text-center text-gray-900 mb-4">
                        Konfirmasi Hapus
                    </h3>
                    <p class="text-sm text-center text-gray-500 mb-6">
                        Apakah Anda yakin ingin menghapus
                        <span class="font-medium text-gray-900">{{ $sewaBaju->name }}</span> ? Tindakan ini tidak
                        dapat dibatalkan.
                    </p>

                    <div class="flex justify-center space-x-3">
                        <button type="button" @click="showDeleteModal = false"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="button" wire:click="delete"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Success -->
        <div x-show="showSuccessModal" @modal-succsess-delete-sewa-baju.window="showSuccessModal = true"
            class="fixed inset-0 z-50 overflow-y-auto" style="display: none">
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
            <div class="relative flex items-center justify-center min-h-screen p-4">
                <div class="relative w-full max-w-md p-6 bg-white rounded-xl shadow-lg">
                    <div class="flex items-center justify-center mb-6">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>

                    <h3 class="text-lg font-medium text-center text-gray-900 mb-4">
                        Berhasil
                    </h3>
                    <p class="text-sm text-center text-gray-500 mb-6">
                        Data <span class="font-medium text-gray-900">{{ $sewaBaju->name }}</span> telah berhasil
                        dihapus.
                    </p>

                    <div class="flex justify-center">
                        <a href="{{ route('admin.layanan.sewa-baju.management-sewa-baju') }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
                            Tutup
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        var quill = new Quill("#description", {
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, 4, 5, 6, false] }],
                    ["bold", "italic", "underline"],
                    [{ list: "ordered" }, { list: "bullet" }],
                    [{ indent: "-1" }, { indent: "+1" }],
                    [{ size: ["small", false, "large", "huge"] }],
                    [{ font: [] }],
                    [{ color: [] }, { background: [] }],
                    [{ align: [] }],
                ],
            },
            placeholder: "Type something...",
            theme: "snow",
        });

        // Sinkronisasi data Livewire
        quill.on('text-change', function (delta, oldDelta, source) {
            @this.set('description', quill.root.innerHTML);
        });

        document.addEventListener('livewire:init', function () {
            // Reset isi Quill Editor ketika event 'resetQuillEditor' dipanggil
            Livewire.on('resetQuillEditorShow', function () {
                 quill.setContents([]);
            });
            
            Livewire.on('setDescriptionShow', function (description) {
                quill.root.innerHTML = description || '';
            });
        });
    </script>
</div>