<x-admin-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  <!-- Dashboard Content -->
  <main class="p-4 lg:p-8">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
      <!-- Stats Card 1 -->
      <div class="p-6 bg-white rounded-lg shadow">
        <h3 class="text-gray-500">Total Booking</h3>
        <p class="text-2xl font-bold">150</p>
      </div>
      <!-- Stats Card 2 -->
      <div class="p-6 bg-white rounded-lg shadow">
        <h3 class="text-gray-500">Pending Booking</h3>
        <p class="text-2xl font-bold">12</p>
      </div>
      <!-- Stats Card 3 -->
      <div class="p-6 bg-white rounded-lg shadow">
        <h3 class="text-gray-500">Total Paket</h3>
        <p class="text-2xl font-bold">8</p>
      </div>
      <!-- Stats Card 4 -->
      <div class="p-6 bg-white rounded-lg shadow">
        <h3 class="text-gray-500">Total Pendapatan</h3>
        <p class="text-2xl font-bold">Rp 250.000.000</p>
      </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="mt-8">
      <div class="p-6 bg-white rounded-lg shadow">
        <h2 class="mb-4 text-lg font-semibold">Booking Terbaru</h2>
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr class="text-left border-b">
                <th class="p-2">Nama</th>
                <th class="p-2">Paket</th>
                <th class="p-2">Tanggal</th>
                <th class="p-2">Status</th>
                <th class="p-2">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-b">
                <td class="p-2">Sarah Putri</td>
                <td class="p-2">Paket Gold</td>
                <td class="p-2">2024-01-15</td>
                <td class="p-2">
                  <span class="px-2 py-1 text-sm text-yellow-800 bg-yellow-100 rounded-full">Pending</span>
                </td>
                <td class="p-2">
                  <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">
                    Detail
                  </button>
                </td>
              </tr>
              <tr class="border-b">
                <td class="p-2">Rina Amanda</td>
                <td class="p-2">Paket Diamond</td>
                <td class="p-2">2024-01-20</td>
                <td class="p-2">
                  <span class="px-2 py-1 text-sm text-green-800 bg-green-100 rounded-full">Confirmed</span>
                </td>
                <td class="p-2">
                  <button class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">
                    Detail
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</x-admin-layout>