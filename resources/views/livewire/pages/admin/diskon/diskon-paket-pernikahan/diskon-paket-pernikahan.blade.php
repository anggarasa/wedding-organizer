<div x-data="{
    showDeleteModal: null,
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
                Kelola Diskon Paket
            </h1>
            <p class="text-gray-600">
                Buat dan kelola diskon paket untuk pelanggan Anda
            </p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-r from-violet-500 to-violet-600 rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-sm">Total Diskon Aktif</p>
                        <h3 class="text-white text-2xl font-bold">{{ $diskonPakets->where('status', 'aktif')->count() }}
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
                        <p class="text-white text-sm">Total Diskon Tidak Aktif</p>
                        <h3 class="text-white text-2xl font-bold">{{ $diskonPakets->where('status',
                            'tidak aktif')->count() }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-30 rounded-full p-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-sm">Diskon Paket Kadaluarsa</p>
                        <h3 class="text-white text-2xl font-bold">{{ $diskonPakets->where('status',
                            'kadaluarsa')->count() }}</h3>
                    </div>
                    <div class="bg-white bg-opacity-30 rounded-full py-2 px-4">
                        <i class="fas fa-x text-2xl text-white"></i>
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

            <livewire:pages.admin.diskon.diskon-paket-pernikahan.modal-diskon-paket-pernikahan />
        </div>

        <!-- Table -->
        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead class="bg-gray-50 dark:bg-neutral-800">
                <tr>
                    <th scope="col" class="px-6 py-3 text-start">
                        <div class="flex items-center gap-x-2">
                            <span
                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                Name
                            </span>
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3 text-start">
                        <div class="flex items-center gap-x-2">
                            <span
                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                Paket Pernikahan
                            </span>
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3 text-start">
                        <div class="flex items-center gap-x-2">
                            <span
                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                Diskon
                            </span>
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3 text-start">
                        <div class="flex items-center gap-x-2">
                            <span
                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                Start Date
                            </span>
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3 text-start">
                        <div class="flex items-center gap-x-2">
                            <span
                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                End Date
                            </span>
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3 text-start">
                        <div class="flex items-center gap-x-2">
                            <span
                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                Status
                            </span>
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3 text-end"></th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">
                @foreach ($diskonPakets as $diskon)
                <tr>
                    <td class="size-px whitespace-nowrap">
                        <div class="px-6 py-3">
                            <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{
                                $diskon->name }}</span>
                        </div>
                    </td>

                    <td class="h-px w-52 whitespace-nowrap" x-data="{ modalId: null }">
                        <a class="block relative z-10 cursor-pointer"
                            @click="modalId = 'diskon-paket-detail_{{ $diskon->id }}'">
                            <div class="px-6 py-2 flex -space-x-2">
                                @php
                                $displayedpakets = $diskon->paketPernikahans->take(3);
                                $remainingPakets = $diskon->paketPernikahans->count() - 3;
                                @endphp

                                @foreach ($displayedpakets as $paket)
                                <div class="inline-flex">
                                    @foreach ($paket->imagePaketPernikahans->take(1) as $image)
                                    <img class="inline-block size-6 rounded-full object-cover ring-2 ring-white dark:ring-neutral-900"
                                        src="{{ asset('storage/paket-pernikahan/'. $image->path) }}"
                                        alt="{{ $paket->name }}">
                                    @endforeach
                                    <span
                                        class="opacity-0 transition-opacity block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700">
                                        {{ $paket->name }}
                                    </span>
                                </div>
                                @endforeach

                                @if ($remainingPakets > 0)
                                <div class="inline-flex">
                                    <span
                                        class="inline-flex justify-center items-center size-6 bg-gray-100 text-xs rounded-full ring-2 ring-white dark:bg-neutral-500 dark:text-white dark:ring-neutral-900">
                                        <span class="font-medium leading-none">{{ $remainingPakets
                                            }}+</span>
                                    </span>
                                    <span
                                        class="opacity-0 transition-opacity block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700">
                                        {{ $remainingPakets }} more paket(s)
                                    </span>
                                </div>
                                @endif
                            </div>
                        </a>

                        <!-- Modal -->
                        <div x-show="modalId === 'diskon-paket-detail_{{ $diskon->id }}'" class="fixed
                        inset-0 z-50 p-4 bg-black bg-opacity-50 flex items-center justify-center"
                            style="display: none;">
                            <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full p-6">
                                <h2 class="text-xl font-bold mb-4">Paket Pernikahan Terkait</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 overflow-y-auto max-h-80">
                                    @foreach ($diskon->paketPernikahans as $paket)
                                    <div class="border rounded-lg p-4 flex items-center">
                                        @foreach ($paket->imagePaketPernikahans->take(1) as $image)
                                        <img class="w-16 h-16 rounded-full object-cover mr-4"
                                            src="{{ asset('storage/paket-pernikahan/' . $image->path) }}"
                                            alt="{{ $paket->name }}">
                                        @endforeach
                                        <div>
                                            <a href="{{ route('admin.layanan.paket-pernikahan.show', $paket->slug) }}"
                                                class="text-lg font-semibold hover:underline">{{
                                                Str::limit($paket->name, 15, '...') }}</a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="mt-6 text-right">
                                    <button @click="modalId = null"
                                        class="px-4 py-2 bg-violet-500 text-white rounded">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </td>


                    <td class="size-px whitespace-nowrap">
                        <div class="px-6 py-3">
                            <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                {{ number_format($diskon->discount, 0, ',', '.') }}%
                            </span>
                        </div>
                    </td>

                    <td class="size-px whitespace-nowrap">
                        <div class="px-6 py-3">
                            <span class="text-sm text-gray-500 dark:text-neutral-500">
                                {{ \Carbon\Carbon::parse($diskon->start_date)->format('F j, Y') }}
                            </span>
                        </div>
                    </td>

                    <td class="size-px whitespace-nowrap">
                        <div class="px-6 py-3">
                            <span class="text-sm text-gray-500 dark:text-neutral-500">
                                {{ \Carbon\Carbon::parse($diskon->end_date)->format('F j, Y') }}

                            </span>
                        </div>
                    </td>

                    <td class="size-px whitespace-nowrap">
                        <div class="px-6 py-3">
                            <span
                                class="py-1 px-1.5 inline-flex cursor-pointer items-center gap-x-1 text-xs font-medium {{ $diskon->status == 'aktif' ? 'bg-green-100 text-green-800' : ($diskon->status == 'kadaluarsa' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }} rounded-full">
                                {{ $diskon->status == 'aktif' ? 'Aktif' : ($diskon->status == 'kadaluarsa' ?
                                'Kadaluarsa' :
                                'Tidak Aktif') }}
                            </span>
                        </div>
                    </td>

                    <td class="size-px whitespace-nowrap">
                        <div class="px-6 py-1.5 space-x-4">
                            <button type="button" wire:click="editDiskonPaket({{ $diskon->id }})"
                                class="inline-flex items-center px-3 py-1 text-sm text-violet-600 bg-violet-100 rounded-lg hover:bg-violet-200">
                                <i class="fa-regular fa-pen-to-square text-base mr-1"></i>
                                Edit
                            </button>
                            <button type="button"
                                @click="showDeleteModal = 'modal-delete-diskon-paket_{{ $diskon->id }}'"
                                class="inline-flex items-center px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200">
                                <i class="fa-regular fa-trash-can text-base mr-1"></i>
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Delete Confirmation Modal -->
                <div x-show="showDeleteModal === 'modal-delete-diskon-paket_{{ $diskon->id }}'"
                    @close-modal-delete-diskon-paket.window="showDeleteModal = null"
                    class="fixed inset-0 z-50 overflow-y-auto" style="display: none">
                    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
                    <div class="relative flex items-center justify-center min-h-screen p-4">
                        <div class="relative w-full max-w-md p-6 bg-white rounded-xl shadow-lg">
                            <div class="flex items-center justify-center mb-6">
                                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
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
                                <span class="font-medium text-gray-900">{{ $diskon->name }}</span>? Tindakan
                                ini
                                tidak
                                dapat dibatalkan.
                            </p>

                            <div class="flex justify-center space-x-3">
                                <button type="button" @click="showDeleteModal = null"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                    Batal
                                </button>
                                <button type="button" wire:click="deleteDiskonPaket({{ $diskon->id }})"
                                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        <!-- End Table -->

        <!-- Pagination -->
        {{ $diskonPakets->links('vendor.pagination.tailwind') }}
        <!-- Pagination -->

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
    </main>
</div>