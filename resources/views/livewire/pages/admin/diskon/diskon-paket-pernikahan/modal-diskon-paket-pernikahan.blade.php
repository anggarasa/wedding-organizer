<div x-data="{ showModal: false }">
    <button @click="showModal = true"
        class="flex items-center justify-center px-4 py-2 bg-violet-600 hover:bg-violet-700 text-white rounded-lg shadow-md transition duration-150 ease-in-out transform hover:scale-105">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Kode Diskon
    </button>

    <div x-show="showModal" @modal-diskon-paket.window="showModal = true"
        @close-modal-diskon-paket.window="showModal = false" class="fixed inset-0 z-30 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div
                class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ $isEdit == true ? 'Edit' : 'Tambah' }} Diskon
                    Paket</h3>

                <form wire:submit="{{ $isEdit == true ? 'updateDiskonPaket' : 'createDiskonPaket' }}" class="space-y-4">
                    <div>
                        <x-input name="name" label="Nama Diskon" wire="name" placeholder="Contoh: Diskon Akhir Bulan"
                            required="true" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Paket Pernikahan</label>

                        <!-- Selected Paket Display -->
                        <div class="mb-4 flex flex-wrap gap-2">
                            @foreach($selectPaketDetail as $paket)
                            <div
                                class="inline-flex items-center bg-violet-100 text-violet-800 px-3 py-1 rounded-full text-sm">
                                <span>{{ $paket->name }}</span>
                                <button type="button" wire:click="toggleKebaya({{ $paket->id }})"
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
                                {{ count($selectPakets) ? count($selectPakets) . ' paket dipilih' : 'Pilih
                                Paket' }}
                            </span>
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        @if($dropdownSelect)
                        <div class="absolute w-full mt-2 bg-white rounded-lg shadow-lg max-h-64 overflow-y-auto z-50">
                            <div class="p-2">
                                <!-- Akad Section -->
                                <div class="mb-4">
                                    <h3 class="text-sm font-semibold text-violet-800 px-3 py-2">
                                        Paket Pernikahan
                                    </h3>
                                    @foreach($pakets as $paket)
                                    <div wire:click="toggleKebaya({{ $paket->id }})"
                                        class="flex items-center space-x-3 p-3 hover:bg-violet-50 rounded-lg cursor-pointer transition-colors duration-200"
                                        :class="{ 'bg-violet-50': isSelected({{ $paket->id }}) }">
                                        <div class="relative">
                                            @forelse($paket->imagePaketPernikahans->take(1) as $image)
                                            <img src="{{ asset('storage/paket-pernikahan/' . $image->path) }}"
                                                class="w-16 h-16 rounded-lg object-cover" />
                                            @empty
                                            <img src="{{ asset('imgs/logo/logo-aplikasi-ym.svg') }}"
                                                class="w-16 h-16 rounded-lg object-cover" />
                                            @endforelse
                                            @if(in_array($paket->id, $selectPakets))
                                            <div
                                                class="absolute inset-0 bg-violet-500 bg-opacity-20 rounded-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            @endif
                                        </div>
                                        <span>{{ $paket->name }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
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
                        <button type="button" @click="showModal = false"
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