<div x-data="{
        sidebarOpen: false,
        currentImage: 0,
        images: [
            'https://via.placeholder.com/800x600',
            'https://via.placeholder.com/800x600',
            'https://via.placeholder.com/800x600',
            'https://via.placeholder.com/800x600'
        ],
        selectSize: 'M',
        quantity: 1,
        showDeleteModal: false,
        showSuccessModal: false,
        showModal: false
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
                <button wire:click="editSewaBaju"
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
                <a href="#"
                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Maintenance
                </a>
            </nav>
        </div>

        <!-- Tambahkan status management untuk admin -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">
                Status Management
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Status -->
                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="text-sm font-medium text-gray-500 mb-2">Status</div>
                    <div class="text-base text-gray-900">{{ $sewaBaju->status }}</div>
                </div>

                <!-- Kategori -->
                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="text-sm font-medium text-gray-500 mb-2">Kategori</div>
                    <div class="text-base text-gray-900">{{ $sewaBaju->category }}</div>
                </div>

                <!-- Ukuran -->
                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="text-sm font-medium text-gray-500 mb-2">Ukuran</div>
                    <div class="text-base text-gray-900">{{ $sewaBaju->ukuran }}</div>
                </div>
            </div>

            <!-- Additional Details -->
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Price -->
                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="text-sm font-medium text-gray-500 mb-2">
                        Harga Sewa per Hari
                    </div>
                    <div class="text-base text-gray-900">Rp {{ number_format($sewaBaju->price, 0, ',', '.') }}</div>
                </div>

                <!-- Description -->
                <div class="p-4 bg-gray-50 rounded-lg" x-data="{ expanded: false }">
                    <div class="text-sm font-medium text-gray-500 mb-2">Deskripsi</div>
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
                            class="mt-2 text-violet-500 hover:text-violet-600 text-sm font-medium focus:outline-none">
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
                        <h2 class="text-xl font-semibold text-gray-800">Edit Baju
                        </h2>
                        <button type="button" wire:click="resetForm" class="text-gray-400 hover:text-gray-600">
                            <i class="fa-solid fa-x text-2xl"></i>
                        </button>
                    </div>

                    <form wire:submit="update" class="space-y-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <x-input-select name="category" label="Kategori" wireModel="category" :options="[
                                    ['value' => 'Jas', 'label' => 'Jas'],
                                    ['value' => 'Kebaya Akad', 'label' => 'Kebaya Akad'],
                                    ['value' => 'Kebaya Resepsi', 'label' => 'Kebaya Resepsi'],
                                    ['value' => 'Gaun Pengantin Modern', 'label' => 'Gaun Pengantin Modern'],
                                ]" placeholder="Pilih Kategori" />
                            </div>

                            <div>
                                <x-input-select name="ukuran" label="Ukuran" wireModel="ukuran" :options="[
                                    ['value' => 'S', 'label' => 'S'],
                                    ['value' => 'M', 'label' => 'M'],
                                    ['value' => 'L', 'label' => 'L'],
                                    ['value' => 'XL', 'label' => 'XL'],
                                    ['value' => 'XXL', 'label' => 'XXL'],
                                ]" placeholder="Pilih Ukuran" />
                            </div>

                            <div>
                                <x-input type="number" name="price" label="Harga Sewa" placeholder="Masukkan Harga Sewa"
                                    wire="price" required="true" />
                            </div>

                            <div>
                                <x-input-select name="status" label="Status" wireModel="status" :options="[
                                ['value' => 'Tersedia', 'label' => 'Tersedia'],
                                ['value' => 'Disewa', 'label' => 'Disewa'],
                                ['value' => 'Maintenance', 'label' => 'Maintenance'],
                            ]" placeholder="Status" />
                            </div>
                        </div>

                        <div>
                            <x-image-upload-big name="images" id="image" label="Upload Gambar" />
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
            Livewire.on('resetQuillEditor', function () {
                 quill.setContents([]);
            });
            
            Livewire.on('setDescription', function (description) {
                quill.root.innerHTML = description || '';
            });
        });
    </script>
</div>