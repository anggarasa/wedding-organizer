<div x-data="{ 
    bookingDropdown: false,
    settingsDropdown: false,
    selectedPackage: null,
    packages: [
        {
            id: 1,
            name: 'Paket Silver',
            price: 5000000,
            description: 'Paket pernikahan dasar dengan layanan make up untuk pengantin',
            includes: ['Make up pengantin', 'Touch up 1x', 'Hair do'],
            image: 'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\' viewBox=\'0 0 400 300\' fill=\'none\'%3E%3Crect width=\'400\' height=\'300\' fill=\'%238B5CF6\' opacity=\'0.1\'/%3E%3Cpath d=\'M180 140h40v40h-40z\' fill=\'%238B5CF6\' opacity=\'0.2\'/%3E%3C/svg%3E',
            featured: true
        },
        {
            id: 2,
            name: 'Paket Gold',
            price: 8000000,
            description: 'Paket pernikahan menengah dengan layanan lengkap untuk pengantin dan keluarga',
            includes: ['Make up pengantin', 'Touch up 2x', 'Hair do', 'Make up keluarga 2 orang'],
            image: 'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\' viewBox=\'0 0 400 300\' fill=\'none\'%3E%3Crect width=\'400\' height=\'300\' fill=\'%238B5CF6\' opacity=\'0.1\'/%3E%3Cpath d=\'M180 140h40v40h-40z\' fill=\'%238B5CF6\' opacity=\'0.2\'/%3E%3C/svg%3E',
            featured: false
        }
    ],
}">
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
                            <button type="button" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
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