<div>
    <button @click="$dispatch('modal-create-sewa-baju')"
        class="flex items-center px-4 py-2 text-white bg-violet-600 rounded-lg hover:bg-violet-700 transition duration-200">
        <i class="fa-solid fa-plus text-xl mr-2"></i>
        Tambah Baju
    </button>

    <!-- Modal Form -->
    <div x-show="showModal" @modal-create-sewa-baju.window="showModal = true"
        @close-modal-create-sewa-baju.window="showModal = false" class="fixed inset-0 z-50 overflow-y-auto"
        style="display: none">
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="relative w-full max-w-2xl p-6 bg-white rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Tambah Baju</h2>
                    <button type="button" wire:click="resetForm" class="text-gray-400 hover:text-gray-600">
                        <i class="fa-solid fa-x text-2xl"></i>
                    </button>
                </div>

                <form wire:submit="create" class="space-y-6">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <x-input name="name" label="Nama Baju" placeholder="Masukkan Nama Baju" wire="name"
                                required="true" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
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
                                ['value' => 'Maintenance', 'label' => 'Maintenance'],
                            ]" placeholder="Status" />
                    </div>

                    <div>
                        <x-image-upload-big name="image" id="image" label="Upload Foto Profil" />
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
                            Simpan
                        </button>
                    </div>
                </form>
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
      
      quill.on('text-change', function(delta, oldDelta, source) {
          @this.set('description', quill.root.innerHTML);
      });
      
    </script>
</div>