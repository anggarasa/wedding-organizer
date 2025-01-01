<div>
    <button @click="$dispatch('modal-create-sewa-baju')"
        class="flex items-center px-4 py-2 text-white bg-violet-600 rounded-lg hover:bg-violet-700 transition duration-200">
        <i class="fa-solid fa-plus text-xl mr-2"></i>
        Tambah Baju
    </button>

    <!-- Modal Form -->
    <div x-show="showModal" @modal-create-sewa-baju.window="showModal = true"
        @close-modal-create-sewa-baju.window="showModal = false" class="fixed inset-0 z-30 overflow-y-auto"
        style="display: none">
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="relative w-full max-w-2xl p-6 bg-white rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $isEdit == true ? 'Edit' : 'Tambah' }} Baju</h2>
                    <button type="button" wire:click="resetForm" class="text-gray-400 hover:text-gray-600">
                        <i class="fa-solid fa-x text-2xl"></i>
                    </button>
                </div>

                <form wire:submit="{{ $isEdit == true ? 'update' : 'create' }}" class="space-y-6">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <x-input name="name" label="Nama Baju" placeholder="Masukkan Nama Baju" wire="name"
                                required="true" />
                        </div>

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
                    </div>

                    <div>
                        <x-input-select name="status" label="Status" wireModel="status" :options="[
                                ['value' => 'Tersedia', 'label' => 'Tersedia'],
                                ['value' => 'Disewa', 'label' => 'Disewa'],
                                ['value' => 'Tidak Tersedia', 'label' => 'Tidak Tersedia'],
                            ]" placeholder="Status" />
                    </div>

                    <div>
                        <x-image-upload-big name="images" id="image" label="Upload Gambar" />
                    </div>

                    <div wire:ignore>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                        <div id="description">{!! $description !!}</div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" wire:click="resetForm"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-violet-600 rounded-lg hover:bg-violet-700">
                            {{ $isEdit == true ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" @modal-delete-sewa-baju.window="showDeleteModal = true"
        @close-modal-delete-sewa-baju.window="showDeleteModal = false" class="fixed inset-0 z-50 overflow-y-auto"
        style="display: none">
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
                    <span class="font-medium text-gray-900">{{ $name }}</span>? Tindakan ini tidak
                    dapat dibatalkan.
                </p>

                <div class="flex justify-center space-x-3">
                    <button type="button" wire:click="resetForm"
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