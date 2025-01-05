<div>
    <!-- Modal add Akad -->
    <div x-data="{ open: false }" x-show="open" @modal-add-akad-paket.window="open = true"
        @close-modal-add-akad-paket.window="open = false" class="fixed inset-0 z-30 overflow-y-auto" x-cloak>
        <div class="flex items-center justify-center min-h-screen px-4 py-6">

            <!-- Modal content -->
            <div class="relative bg-white rounded-xl shadow-2xl max-w-4xl w-full mx-auto p-6">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-violet-800 mb-4">Tambah Baju Kebaya Akad</h2>

                    <!-- Akad Section -->
                    <div>
                        <div x-data="{ selectedDress: @entangle('selectedDress') }"
                            class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach ($dresses['akad'] as $dress)
                            <div class="relative">
                                <label class="cursor-pointer block">
                                    <input type="radio" wire:model="selectedDress" value="{{ $dress->id }}"
                                        class="absolute opacity-0" x-on:click="selectedDress = '{{ $dress->id }}'" />
                                    <div class="p-3 rounded-lg transition-all duration-200"
                                        :class="{ 'ring-2 ring-violet-600 bg-violet-50': selectedDress == '{{ $dress->id }}' }">
                                        @foreach ($dress->imageSewaBajus as $image)
                                        <img src="{{ asset('storage/sewa-baju/'. $image->image) }}"
                                            alt="{{ $dress->name }}" class="w-full h-48 object-cover rounded-lg mb-2" />
                                        @endforeach
                                        <p class="text-center text-sm font-medium text-gray-700">
                                            {{ $dress->name }}
                                        </p>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end space-x-4">
                    <button @click="open = false"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition duration-200">
                        Batal
                    </button>
                    <button wire:click="submit"
                        class="px-4 py-2 bg-violet-600 text-white rounded-lg hover:bg-violet-700 transition duration-200">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal add Resepsi -->
    <div x-data="{ open: false }" x-show="open" @modal-add-resepsi-paket.window="open = true"
        @close-modal-add-resepsi-paket.window="open = false" class="fixed inset-0 z-30 overflow-y-auto" x-cloak>
        <div class="flex items-center justify-center min-h-screen px-4 py-6">

            <!-- Modal content -->
            <div class="relative bg-white rounded-xl shadow-2xl max-w-4xl w-full mx-auto p-6">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-violet-800 mb-4">Tambah Baju Kebaya Resepsi</h2>

                    <!-- Akad Section -->
                    <div>
                        <div x-data="{ selectedDress: @entangle('selectedDress') }"
                            class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach ($dresses['resepsi'] as $dress)
                            <div class="relative">
                                <label class="cursor-pointer block">
                                    <input type="radio" wire:model="selectedDress" value="{{ $dress->id }}"
                                        class="absolute opacity-0" x-on:click="selectedDress = '{{ $dress->id }}'" />
                                    <div class="p-3 rounded-lg transition-all duration-200"
                                        :class="{ 'ring-2 ring-violet-600 bg-violet-50': selectedDress == '{{ $dress->id }}' }">
                                        @foreach ($dress->imageSewaBajus as $image)
                                        <img src="{{ asset('storage/sewa-baju/'. $image->image) }}"
                                            alt="{{ $dress->name }}" class="w-full h-48 object-cover rounded-lg mb-2" />
                                        @endforeach
                                        <p class="text-center text-sm font-medium text-gray-700">
                                            {{ $dress->name }}
                                        </p>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end space-x-4">
                    <button @click="open = false"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition duration-200">
                        Batal
                    </button>
                    <button wire:click="submit"
                        class="px-4 py-2 bg-violet-600 text-white rounded-lg hover:bg-violet-700 transition duration-200">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>