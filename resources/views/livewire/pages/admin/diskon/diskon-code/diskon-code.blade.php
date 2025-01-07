<div x-data="{
    showDeleteModal: false,
    selectedDiscount: null,
    searchQuery: '',
    statusFilter: 'all',
    discounts: [
      {
        id: 1,
        code: 'WEDDING2024',
        discount: 10,
        maxUses: 100,
        usedCount: 45,
        startDate: '2024-01-01',
        endDate: '2024-03-31',
        status: 'active',
        description: 'Diskon khusus wedding tahun 2024'
      },
      {
        id: 2, 
        code: 'NEWYEAR24',
        discount: 15,
        maxUses: 50,
        usedCount: 12,
        startDate: '2024-01-01',
        endDate: '2024-01-31',
        status: 'active',
        description: 'Promo spesial tahun baru 2024'
      },
      {
        id: 3,
        code: 'PREWED50',
        discount: 50,
        maxUses: 20,
        usedCount: 20,
        startDate: '2023-12-01',
        endDate: '2023-12-31',
        status: 'expired',
        description: 'Diskon pre-wedding akhir tahun'
      }
    ],
    newDiscount: {
      code: '',
      discount: '',
      maxUses: '',
      startDate: '',
      endDate: '',
      description: ''
    },
    get filteredDiscounts() {
      return this.discounts.filter(discount => {
        const matchesSearch = discount.code.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            discount.description.toLowerCase().includes(this.searchQuery.toLowerCase());
        const matchesStatus = this.statusFilter === 'all' || discount.status === this.statusFilter;
        return matchesSearch && matchesStatus;
      });
    }
  }">
    <main class="p-4 lg:p-8">
        <!-- Header & Stats -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">
                Kelola Kode Diskon
            </h1>
            <p class="text-gray-600">
                Buat dan kelola kode diskon untuk pelanggan Anda
            </p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-r from-violet-500 to-violet-600 rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-sm">Total Kode Aktif</p>
                        <h3 class="text-white text-2xl font-bold">{{ $diskonCodes->where('status', 'aktif')->count() }}
                        </h3>
                    </div>
                    <div class="bg-white bg-opacity-30 rounded-full p-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-pink-500 to-pink-600 rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-sm">Total Penggunaan</p>
                        <h3 class="text-white text-2xl font-bold">77</h3>
                    </div>
                    <div class="bg-white bg-opacity-30 rounded-full p-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-sm">Kode Kadaluarsa</p>
                        <h3 class="text-white text-2xl font-bold">1</h3>
                    </div>
                    <div class="bg-white bg-opacity-30 rounded-full p-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="relative">
                    <input type="text" x-model="searchQuery" placeholder="Cari kode diskon..."
                        class="w-full sm:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-transparent" />
                    <svg class="w-5 h-5 text-gray-500 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <select x-model="statusFilter"
                    class="w-full sm:w-40 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-transparent">
                    <option value="all">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="expired">Kadaluarsa</option>
                </select>
            </div>

            <livewire:pages.admin.diskon.diskon-code.modal-diskon-code />
        </div>

        <!-- Discount Codes Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($diskonCodes as $diskon)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $diskon->code }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $diskon->description }}</p>
                        </div>
                        <span
                            class="inline-flex justify-center items-center min-w-[80px] px-2.5 py-1 text-xs font-semibold rounded-full
                            {{ $diskon->status == 'aktif' ? 'bg-green-100 text-green-800' : ($diskon->status == 'kadaluarsa' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ $diskon->status == 'aktif' ? 'Aktif' : ($diskon->status == 'kadaluarsa' ? 'Kadaluarsa' :
                            'Tidak Aktif') }}
                        </span>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-2 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                            <span>{{ number_format($diskon->discount,0,',','.') }}% Diskon</span>
                        </div>

                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-2 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>{{ $diskon->penggunaan }} Penggunaan</span>
                        </div>

                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-2 text-violet-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($diskon->start_date)->format('d M Y') }} s/d {{
                                \Carbon\Carbon::parse($diskon->end_date)->format('d M Y') }}</span>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button @click="editDiscount(discount)"
                            class="px-3 py-1.5 text-sm text-violet-600 hover:text-violet-800 font-medium rounded-md hover:bg-violet-50">
                            Edit
                        </button>
                        <button @click="deleteDiscount(discount)"
                            class="px-3 py-1.5 text-sm text-red-600 hover:text-red-800 font-medium rounded-md hover:bg-red-50">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Empty State -->
        <template x-if="filteredDiscounts.length === 0">
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">
                    Tidak ada data
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Belum ada kode diskon yang sesuai dengan pencarian Anda.
                </p>
            </div>
        </template>

        <!-- Delete Confirmation Modal -->
        <div x-show="showDeleteModal" class="fixed inset-0 z-50 overflow-y-auto"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div
                    class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-red-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>

                        <h3 class="text-lg font-medium text-gray-900 mt-4">
                            Hapus Kode Diskon
                        </h3>
                        <p class="text-sm text-gray-500 mt-2">
                            Apakah Anda yakin ingin menghapus kode diskon
                            <span class="font-semibold" x-text="selectedDiscount?.code"></span>? Tindakan ini tidak
                            dapat dibatalkan.
                        </p>

                        <div class="mt-6 flex justify-center space-x-3">
                            <button type="button" @click="showDeleteModal = false"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500">
                                Batal
                            </button>
                            <button type="button"
                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Ya, Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>