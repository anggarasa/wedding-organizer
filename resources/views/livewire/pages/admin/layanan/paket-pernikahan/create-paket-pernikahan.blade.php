<div x-data="{ showSuccessModal: false }">
    <main class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Tambah Paket Wedding
                    </h1>
                    <p class="mt-2 text-gray-600">
                        Tambahkan Data Paket Pernikahan Sebanyak Yang Anda Inginkan
                    </p>
                </div>
                <a href="{{ route('admin.layanan.paket-pernikahan.management') }}"
                    class="mt-4 md:mt-0 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-violet-600 hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500 transition-all shadow-lg hover:shadow-xl">
                    <i class="fa-solid fa-arrow-left text-xl mr-2"></i>
                    Kemabali ke Manajemen Paket
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 md:p-8">
            <form wire:submit="createPaketPernikahan">
                <div class="space-y-8">
                    <!-- Basic Information -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-900">Informasi Dasar</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Paket -->
                            <div>
                                <x-input name="name" label="Nama Paket" wire="name" placeholder="Masukan Nama Paket"
                                    required="true" />
                            </div>

                            <!-- Harga -->
                            <div>
                                <x-input type="number" name="price" label="Harga Paket" wire="price"
                                    placeholder="Masukan Harga Paket" required="true" />
                            </div>
                        </div>

                        <!-- Upload Gambar -->
                        <div>
                            <x-image-upload-big name="images" id="image" label="Upload Gambar" />
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea wire:model="description" rows="3"
                                class="w-full px-4 py-2 border-2 rounded-lg focus:ring-violet-500 focus:border-violet-500"
                                required></textarea>
                        </div>
                    </div>

                    <!-- Includes Section -->
                    <div class="space-y-6">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-semibold text-gray-900">Layanan yang Termasuk</h2>
                        </div>

                        <div class="space-y-4">
                            <!-- Includes -->
                            <div wire:ignore>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Includes (one per
                                    line)</label>
                                <div id="include">{!! $include !!}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Settings -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-900">Pengaturan Tambahan</h2>

                        <!-- Pilih Baju Akad dan Resepsi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Baju Akad</label>

                            <!-- Selected Kebaya Display -->
                            <div class="mb-4 flex flex-wrap gap-2">
                                @foreach($selectedKebayaDetails as $kebaya)
                                <div
                                    class="inline-flex items-center bg-violet-100 text-violet-800 px-3 py-1 rounded-full text-sm">
                                    <span>{{ $kebaya->name }}</span>
                                    <button wire:click="toggleKebaya({{ $kebaya->id }})"
                                        class="ml-2 focus:outline-none">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                @endforeach
                            </div>

                            <!-- Dropdown Button -->
                            <button type="button" wire:click="$toggle('dropdownSelect')"
                                class="w-full px-4 py-3 text-left bg-white rounded-lg border-2 shadow-md hover:bg-violet-50 focus:outline-none focus:ring-2 focus:ring-violet-500 transition-all duration-300 flex justify-between items-center">
                                <span>
                                    {{ count($selectedKebaya) ? count($selectedKebaya) . ' kebaya dipilih' : 'Pilih
                                    Kebaya Anda' }}
                                </span>
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            @if($dropdownSelect)
                            <div
                                class="absolute w-full mt-2 bg-white rounded-lg shadow-lg max-h-96 overflow-y-auto z-50">
                                <div class="p-2">
                                    <!-- Akad Section -->
                                    <div class="mb-4">
                                        <h3 class="text-sm font-semibold text-violet-800 px-3 py-2">
                                            Kebaya Akad
                                        </h3>
                                        @foreach($kebayaAkad as $kebaya)
                                        <div wire:click="toggleKebaya({{ $kebaya->id }})"
                                            class="flex items-center space-x-3 p-3 hover:bg-violet-50 rounded-lg cursor-pointer transition-colors duration-200"
                                            :class="{ 'bg-violet-50': isSelected({{ $kebaya->id }}) }">
                                            <div class="relative">
                                                @forelse($kebaya->imageSewaBajus->take(1) as $image)
                                                <img src="{{ asset('storage/sewa-baju/' . $image->image) }}"
                                                    class="w-16 h-16 rounded-lg object-cover" />
                                                @empty
                                                <img src="{{ asset('imgs/logo/logo-aplikasi-ym.svg') }}"
                                                    class="w-16 h-16 rounded-lg object-cover" />
                                                @endforelse
                                                @if(in_array($kebaya->id, $selectedKebaya))
                                                <div
                                                    class="absolute inset-0 bg-violet-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-violet-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                                @endif
                                            </div>
                                            <span>{{ $kebaya->name }}</span>
                                        </div>
                                        @endforeach

                                    </div>

                                    <!-- Resepsi Section -->
                                    <div>
                                        <h3 class="text-sm font-semibold text-violet-800 px-3 py-2">
                                            Kebaya Resepsi
                                        </h3>
                                        @foreach($kebayaResepsi as $kebaya)
                                        <div wire:click="toggleKebaya({{ $kebaya->id }})"
                                            class="flex items-center space-x-3 p-3 hover:bg-violet-50 rounded-lg cursor-pointer transition-colors duration-200"
                                            :class="{ 'bg-violet-50': isSelected({{ $kebaya->id }}) }">
                                            <div class="relative">
                                                @forelse($kebaya->imageSewaBajus->take(1) as $image)
                                                <img src="{{ asset('storage/sewa-baju/' . $image->image) }}"
                                                    class="w-16 h-16 rounded-lg object-cover" />
                                                @empty
                                                <img src="{{ asset('imgs/logo/logo-aplikasi-ym.svg') }}"
                                                    class="w-16 h-16 rounded-lg object-cover" />
                                                @endforelse
                                                @if(in_array($kebaya->id, $selectedKebaya))
                                                <div
                                                    class="absolute inset-0 bg-violet-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-violet-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                                @endif
                                            </div>
                                            <span>{{ $kebaya->name }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Layanan Tambahan -->
                        <div wire:ignore>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Layanan Tambahan</label>
                            <div id="layananTambahan">{!! $layananTambahan !!}</div>
                        </div>

                        <!-- Syarat -->
                        <div wire:ignore>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Syarat</label>
                            <div id="syarat">{!! $syarat !!}</div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-10 pt-6 border-t border-gray-200">
                    <div class="flex justify-end space-x-3">
                        <button type="button"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-6 py-2 bg-violet-600 text-white rounded-lg hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500">
                            Simpan Paket
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Success -->
        <div x-show="showSuccessModal" @modal-success-create-paket-pernikahan.window="showSuccessModal = true"
            class="fixed inset-0 z-50 overflow-y-auto" style="display: none">
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
            <div class="relative flex items-center justify-center min-h-screen p-4">
                <div class="relative w-full max-w-md p-6 bg-white rounded-xl shadow-lg">
                    <div class="flex items-center justify-center mb-6">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                    </div>

                    <h3 class="text-lg font-medium text-center text-gray-900 mb-4">
                        Berhasil
                    </h3>
                    <p class="text-sm text-center text-gray-500 mb-6">
                        Data <span class="font-medium text-gray-900">{{ $name }}</span> telah berhasil
                        ditambahkan.
                    </p>

                    <div class="flex justify-center">
                        <a href="{{ route('admin.layanan.paket-pernikahan.management') }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
                            Tutup
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Quill Editor For Include
        var quillInclude = new Quill("#include", {
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

        quillInclude.on("text-change", function (delta, oldDelta, source) {
            @this.set("include", quillInclude.root.innerHTML);
        });

        // Quill Editor For layananTambahan
        var quillLayananTambahan = new Quill("#layananTambahan", {
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

        quillLayananTambahan.on("text-change", function (delta, oldDelta, source) {
            @this.set("layananTambahan", quillLayananTambahan.root.innerHTML);
        });

        // Quill Editor For syarat
        var quillSyarat = new Quill("#syarat", {
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

        quillSyarat.on("text-change", function (delta, oldDelta, source) {
            @this.set("syarat", quillSyarat.root.innerHTML);
        });
    </script>
</div>