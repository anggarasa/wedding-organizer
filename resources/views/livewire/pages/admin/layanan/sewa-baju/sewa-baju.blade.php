<div x-data="{ 
        showModal: false,
        showDeleteModal: false,
        kategoriOptions: ['Gaun Pengantin Modern', 'Gaun Pengantin Tradisional', 'Kebaya Akad', 'Kebaya Resepsi', 'Jas Pengantin Premium', 'Beskap Jawa', 'Gaun Bridesmaid', 'Jas Groomsmen'],
        ukuranOptions: ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'Custom'],
    }">
    <!-- Same sidebar code as before -->

    <!-- Main Content -->
    <main class="p-4 lg:p-8 font-poppins">
        <!-- Header Section -->
        <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">
                    Management Sewa Baju
                </h1>
                <p class="mt-1 text-sm text-gray-600">
                    Kelola koleksi baju pernikahan dengan mudah
                </p>
            </div>
            <livewire:pages.admin.layanan.sewa-baju.modal-sewa-baju />
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2 lg:grid-cols-4">
            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-violet-100 rounded-lg">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Total Baju</h3>
                        <p class="text-lg font-semibold text-gray-800">{{ $sewaBaju->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Tersedia</h3>
                        <p class="text-lg font-semibold text-gray-800">{{ $sewaBaju->where('status',
                            'Tersedia')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">
                            Sedang Disewa
                        </h3>
                        <p class="text-lg font-semibold text-gray-800">{{ $sewaBaju->where('status', 'Disewa')->count()
                            }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">
                            Perlu Maintenance
                        </h3>
                        <p class="text-lg font-semibold text-gray-800">{{ $sewaBaju->where('status',
                            'Maintenance')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="p-6 mb-8 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Kategori</label>
                    <select
                        class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
                        <option value="">Semua Kategori</option>
                        <template x-for="kategori in kategoriOptions">
                            <option :value="kategori" x-text="kategori"></option>
                        </template>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                    <select
                        class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
                        <option value="">Semua Status</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Disewa">Disewa</option>
                        <option value="Maintenance">Maintenance</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Ukuran</label>
                    <select
                        class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
                        <option value="">Semua Ukuran</option>
                        <template x-for="ukuran in ukuranOptions">
                            <option :value="ukuran" x-text="ukuran"></option>
                        </template>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Rentang Harga</label>
                    <div class="flex gap-2">
                        <input type="number" placeholder="Min"
                            class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500" />
                        <input type="number" placeholder="Max"
                            class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Gambar
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ukuran
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Harga
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($sewaBaju as $baju)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @forelse($baju->imageSewaBajus->take(1) as $image)
                                <img src="{{ asset('storage/sewa-baju/' . $image->image) }}"
                                    class="w-12 h-12 rounded-lg object-cover" />
                                @empty
                                <img src="{{ asset('imgs/logo/logo-aplikasi-ym.svg') }}"
                                    class="w-12 h-12 rounded-lg object-cover" />
                                @endforelse
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $baju->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $baju->category }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $baju->ukuran }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Rp {{ number_format($baju->price, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" x-data="{ dropdownStatus: false }">
                                <div class="px-6 py-3">
                                    <div class="relative inline-flex items-center group">
                                        <span @click="dropdownStatus = !dropdownStatus" class="px-3 py-1 inline-flex items-center gap-2 text-xs leading-5 font-semibold rounded-full hover:underline cursor-pointer
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
                                                      bg-violet-100 text-violet-800
                                              @endswitch">
                                            {{ $baju->status }}
                                            <i class="fa-solid fa-angle-down text-xs transition-transform duration-200"
                                                :class="{'rotate-180': dropdownStatus}"></i>
                                        </span>
                                    </div>
                                </div>

                                <div x-show="dropdownStatus" @click.outside="dropdownStatus = false"
                                    class="z-10 absolute bg-gray-200 divide-y divide-gray-100 rounded-lg shadow w-44"
                                    style="display: none;">
                                    <ul class="py-2 text-sm text-gray-900">
                                        <li>
                                            <a @click="dropdownStatus = false; $wire.updateStatusSewaBaju({{ $baju->id }}, 'Tersedia')"
                                                class="block px-4 py-2 cursor-pointer hover:bg-gray-300">Tersedia</a>
                                        </li>
                                        <li>
                                            <a @click="dropdownStatus = false; $wire.updateStatusSewaBaju({{ $baju->id }}, 'Disewa')"
                                                class="block px-4 py-2 cursor-pointer hover:bg-gray-300">Disewa</a>
                                        </li>
                                        <li>
                                            <a @click="dropdownStatus = false; $wire.updateStatusSewaBaju({{ $baju->id }}, 'Tidak Tersedia')"
                                                class="block px-4 py-2 cursor-pointer hover:bg-gray-300">Tidak
                                                Tersedia</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.layanan.sewa-baju.show-sewa-baju', $baju->slug) }}"
                                        class="inline-flex items-center px-3 py-1 text-sm text-cyan-600 bg-cyan-100 rounded-lg hover:bg-cyan-200">
                                        <i class="fa-regular fa-eye text-base mr-1"></i>
                                        Lihat
                                    </a>
                                    <button type="button" wire:click="editSewaBaju({{ $baju->id }})"
                                        class="inline-flex items-center px-3 py-1 text-sm text-violet-600 bg-violet-100 rounded-lg hover:bg-violet-200">
                                        <i class="fa-regular fa-pen-to-square text-base mr-1"></i>
                                        Edit
                                    </button>
                                    <button type="button" wire:click="hapusSewaBaju({{ $baju->id }})"
                                        class="inline-flex items-center px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200">
                                        <i class="fa-regular fa-trash-can text-base mr-1"></i>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            {{ $sewaBaju->links('vendor.pagination.tailwind') }}
        </div>
    </main>
</div>