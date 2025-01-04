<div x-data="{ modalDelete: null }">
    <main class="p-4 lg:p-8">
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Manajemen Paket Wedding
                    </h1>
                    <p class="mt-2 text-gray-600">
                        Kelola semua paket wedding yang tersedia
                    </p>
                </div>
                <a href="{{ route('admin.layanan.paket-pernikahan.create') }}"
                    class="mt-4 md:mt-0 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-violet-600 hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500 transition-all shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Paket
                </a>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="mb-6 p-4 bg-white rounded-lg shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                <div class="flex-1">
                    <input type="text" placeholder="Cari paket..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500" />
                </div>
                <div class="mt-4 md:mt-0">
                    <select
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
                        <option>Semua Paket</option>
                        <option>Featured</option>
                        <option>Non-Featured</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Packages Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($paketPernikahans as $paket)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <div class="relative">
                    @forelse($paket->imagePaketPernikahans->take(1) as $image)
                    <img src="{{ asset('storage/paket-pernikahan/' . $image->path) }}" alt="{{ $paket->name }}"
                        class="w-full h-48 object-cover" />
                    @empty
                    <img src="{{ asset('imgs/logo/logo-aplikasi-ym.svg') }}" class="w-full h-48 object-cover" />
                    @endforelse
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-violet-500 text-white text-sm font-semibold rounded-full">
                            diskon
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <a href="{{ route('admin.layanan.paket-pernikahan.show', $paket->slug) }}"
                                class="text-xl font-bold text-gray-900">{{ $paket->name }}</a>
                            <p class="mt-2 text-violet-600 font-bold text-2xl">
                                Rp <span>{{ number_format($paket->price, 0, ',', '.') }}</span>
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="#" class="p-2 text-violet-600 hover:bg-violet-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </a>

                            {{-- Tombol delete --}}
                            <button type="button"
                                @click="modalDelete = 'modal-delete-paket-pernikahan_{{ $paket->id }}'"
                                class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>

                            <!-- Delete Confirmation Modal -->
                            <div x-show="modalDelete === 'modal-delete-paket-pernikahan_{{ $paket->id }}'"
                                class="fixed inset-0 z-50 overflow-y-auto" style="display: none">
                                <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
                                <div class="relative flex items-center justify-center min-h-screen p-4">
                                    <div class="relative w-full max-w-md p-6 bg-white rounded-xl shadow-lg">
                                        <div class="flex items-center justify-center mb-6">
                                            <div
                                                class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
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
                                            <span class="font-medium text-gray-900">{{ $paket->name }}</span>? Tindakan
                                            ini
                                            tidak
                                            dapat dibatalkan.
                                        </p>

                                        <div class="flex justify-center space-x-3">
                                            <button type="button" @click="modalDelete = null"
                                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                                Batal
                                            </button>
                                            <button type="button" wire:click="deletePaketPernikahan({{ $paket->id }})"
                                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">{{ Str::limit($paket->description, 100, '...') }}</p>
                    <div class="space-y-2">
                        <h4 class="font-semibold text-gray-900">Includes:</h4>
                        @foreach($includes as $include)
                        @php
                        $dom = new DOMDocument();
                        $dom->loadHTML($include->include, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                        $items = $dom->getElementsByTagName('li');
                        @endphp

                        <ul class="space-y-2">
                            @foreach($items as $item)
                            <li class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-violet-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>{!! $item->nodeValue !!}</span>
                            </li>
                            @endforeach
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</div>