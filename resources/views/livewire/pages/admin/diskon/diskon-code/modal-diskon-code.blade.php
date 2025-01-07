<div x-data="{ showModal: false }">
    <button @click="showModal = true"
        class="flex items-center justify-center px-4 py-2 bg-violet-600 hover:bg-violet-700 text-white rounded-lg shadow-md transition duration-150 ease-in-out transform hover:scale-105">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Kode Diskon
    </button>

    <div x-show="showModal" @modal-diskon-code.window="showModal = true"
        @close-modal-diskon-code.window="showModal = false" class="fixed inset-0 z-30 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div
                class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ $isEdit == true ? 'Edit Kode Diskon' : 'Tambah
                    Kode Diskon' }}</h3>

                <form wire:submit="{{ $isEdit == true ? 'updateDiskonKode' : 'createDiskonCode' }}" class="space-y-4">
                    <div>
                        <x-input name="code" label="Kode Diskon" wire="code" placeholder="Contoh: WEDDING2024"
                            required="true" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea wire:model="description"
                            class="w-full px-4 py-3 border-2 rounded-xl focus:ring-2 focus:ring-violet-300 focus:border-violet-400 outline-none transition bg-white/50"
                            rows="2" placeholder="Masukkan deskripsi kode diskon"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Persentase Diskon</label>
                        <div class="relative">
                            <input type="number" wire:model="discount"
                                class="w-full pl-3 pr-12 py-2 border-2 rounded-xl focus:ring-2 focus:ring-violet-300 focus:border-violet-400 outline-none transition bg-white/50"
                                placeholder="0" min="0" max="100" />
                            <span class="absolute right-3 top-2 text-gray-500">%</span>
                        </div>
                    </div>

                    <div>
                        <x-input type="number" name="penggunaan" label="Maksimal Penggunaan" wire="penggunaan"
                            placeholder="Masukkan jumlah maksimal penggunaan" required="true" min="1" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input type="date" name="start_date" label="Tanggal Mulai" wire="start_date"
                                required="true" />
                        </div>
                        <div>
                            <x-input type="date" name="end_date" label="Tanggal Berakhir" wire="end_date"
                                required="true" />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" wire:click="resetInput"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-violet-600 rounded-lg hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500">
                            <span>{{ $isEdit == true ? 'Update' : 'Simpan' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>