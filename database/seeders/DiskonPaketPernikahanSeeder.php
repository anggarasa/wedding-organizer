<?php

namespace Database\Seeders;

use App\Models\Diskon\DiskonPaketPernikahan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Layanan\PaketPernikahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiskonPaketPernikahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paketIds = PaketPernikahan::pluck('id')->toArray();

        $diskonData = [
            [
                'name' => 'Diskon Awal Tahun Wedding Organizer',
                'discount' => 10,
                'start_date' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(10)->format('Y-m-d'),
                'selectPakets' => array_slice($paketIds, 0, 3),
            ],
            [
                'name' => 'Diskon Valentine Wedding Organizer',
                'discount' => 15,
                'start_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(15)->format('Y-m-d'),
                'selectPakets' => array_slice($paketIds, 1, 3),
            ],
            [
                'name' => 'Diskon Musim Panas Wedding Organizer',
                'discount' => 20,
                'start_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(20)->format('Y-m-d'),
                'selectPakets' => array_slice($paketIds, 2, 3),
            ],
            [
                'name' => 'Diskon Akhir Tahun Wedding Organizer',
                'discount' => 25,
                'start_date' => Carbon::now()->addDays(10)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(30)->format('Y-m-d'),
                'selectPakets' => array_slice($paketIds, 3, 3),
            ],
            [
                'name' => 'Diskon Liburan Wedding Organizer',
                'discount' => 30,
                'start_date' => Carbon::now()->addDays(15)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(40)->format('Y-m-d'),
                'selectPakets' => array_slice($paketIds, 4, 3),
            ],
            [
                'name' => 'Diskon Tahun Baru Wedding Organizer',
                'discount' => 35,
                'start_date' => Carbon::now()->addDays(20)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(50)->format('Y-m-d'),
                'selectPakets' => array_slice($paketIds, 5, 3),
            ],
            [
                'name' => 'Diskon Musim Gugur Wedding Organizer',
                'discount' => 40,
                'start_date' => Carbon::now()->addDays(25)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(60)->format('Y-m-d'),
                'selectPakets' => array_slice($paketIds, 6, 3),
            ],
            [
                'name' => 'Diskon Musim Dingin Wedding Organizer',
                'discount' => 45,
                'start_date' => Carbon::now()->addDays(30)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(70)->format('Y-m-d'),
                'selectPakets' => array_slice($paketIds, 7, 3),
            ],
            [
                'name' => 'Diskon Musim Semi Wedding Organizer',
                'discount' => 50,
                'start_date' => Carbon::now()->addDays(35)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(80)->format('Y-m-d'),
                'selectPakets' => array_slice($paketIds, 2, 3),
            ],
            [
                'name' => 'Diskon Spesial Wedding Organizer',
                'discount' => 55,
 'start_date' => Carbon::now()->addDays(40)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(90)->format('Y-m-d'),
                'selectPakets' => array_slice($paketIds, 1, 3),
            ],
        ];

        foreach ($diskonData as $diskon) {
            $diskonRecord = DiskonPaketPernikahan::create([
                'name' => $diskon['name'],
                'discount' => $diskon['discount'],
                'start_date' => $diskon['start_date'],
                'end_date' => $diskon['end_date'],
                'status' => ($diskon['start_date'] < now()->format('Y-m-d') && $diskon['end_date'] > now()->format('Y-m-d')) ? 'aktif' : 'tidak aktif',
            ]);

            foreach ($diskon['selectPakets'] as $paketId) {
                PaketPernikahan::where('id', $paketId)->update([
                    'diskon_paket_pernikahan_id' => $diskonRecord->id,
                    'discount' => $diskon['discount'],
                ]);
            }
        }
    }
}
