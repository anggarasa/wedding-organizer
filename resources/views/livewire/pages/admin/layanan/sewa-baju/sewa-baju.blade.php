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
                        <p class="text-lg font-semibold text-gray-800">156</p>
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
                        <p class="text-lg font-semibold text-gray-800">89</p>
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
                        <p class="text-lg font-semibold text-gray-800">67</p>
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
                        <p class="text-lg font-semibold text-gray-800">8</p>
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
                                <img src="{{ asset('imgs/logo/logo-aplikasi-ym.svg') }}"
                                    class="w-12 h-12 rounded-lg object-cover" />
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
                                <div class="text-sm text-gray-900">M</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Rp {{ number_format($baju->price, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" x-data="{ dropdownStatus: false }">
                                <div class="px-6 py-3">
                                    <span @click="dropdownStatus = !dropdownStatus" class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full  hover:underline cursor-pointer
                                        @switch($baju->status)
                                            @case('Tersedia')
                                                bg-green-100 text-green-800
                                            @break
                                            @case('Disewa')
                                                bg-yellow-100 text-yellow-800
                                            @break
                                            @case('Maintenance')
                                                bg-red-100 text-red-800
                                            @break
                                            @default
                                                bg-violet-100 text-violet-800
                                        @endswitch">
                                        {{ $baju->status }}
                                    </span>
                                </div>

                                <div x-show="dropdownStatus" @click.outside="dropdownStatus = false"
                                    class="z-10 absolute bg-gray-200 divide-y divide-gray-100 rounded-lg shadow w-44"
                                    style="display: none;">
                                    <ul class="py-2 text-sm text-gray-900">
                                        <li>
                                            <a href="#"
                                                @click="dropdownStatus = false; $wire.updateStatusDiskonProduct({{ $baju->id }}, true)"
                                                class="block px-4 py-2 hover:bg-gray-300">Tersedia</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                @click="dropdownStatus = false; $wire.updateStatusDiskonProduct({{ $baju->id }}, false)"
                                                class="block px-4 py-2 hover:bg-gray-300">Disewa</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                @click="dropdownStatus = false; $wire.updateStatusDiskonProduct({{ $baju->id }}, false)"
                                                class="block px-4 py-2 hover:bg-gray-300">Maintenance</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <button @click="showModal = true; modalType = 'edit'"
                                        class="inline-flex items-center px-3 py-1 text-sm text-violet-600 bg-violet-100 rounded-lg hover:bg-violet-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        Edit
                                    </button>
                                    <button
                                        @click="showDeleteModal = true; selectedItem = 'Gaun Pengantin Modern Luxury'"
                                        class="inline-flex items-center px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
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
            <div class="flex items-center justify-between px-6 py-4 bg-white border-t">
                <div class="flex items-center text-sm text-gray-500">
                    <span>Showing</span>
                    <select class="mx-2 border-gray-300 rounded-md focus:ring-violet-500 focus:border-violet-500">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                    </select>
                    <span>of 100 entries</span>
                </div>
                <div class="flex space-x-2">
                    <button
                        class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100 disabled:opacity-50">
                        Previous
                    </button>
                    <button class="px-3 py-1 text-sm text-white bg-violet-600 rounded-lg hover:bg-violet-700">
                        1
                    </button>
                    <button class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100">
                        2
                    </button>
                    <button class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100">
                        3
                    </button>
                    <button class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100">
                        Next
                    </button>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-show="showDeleteModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none">
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
                        <span class="font-medium text-gray-900"></span>? Tindakan ini tidak
                        dapat dibatalkan.
                    </p>

                    <div class="flex justify-center space-x-3">
                        <button @click="showDeleteModal = false"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                            Batal
                        </button>
                        <button @click="showDeleteModal = false"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>