<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Layanan\SewaBaju;
use App\Models\Diskon\DiskonSewaBaju;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiskonSewaBajuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sewaBajuIds = SewaBaju::pluck('id')->toArray();
        $diskonData = [
            [
                'nama_diskon' => 'Diskon Awal Tahun Sewa Baju',
                'persentase_diskon' => 10,
                'start_date' => Carbon::now()->addDays(35)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(80)->format('Y-m-d'),
                'selectSewaBajus' => array_slice($sewaBajuIds, 0, 3),
            ],
            [
                'nama_diskon' => 'Diskon Valentine Sewa Baju',
                'persentase_diskon' => 15,
                'start_date' => Carbon::now()->addDays(35)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(80)->format('Y-m-d'),
                'selectSewaBajus' => array_slice($sewaBajuIds, 1, 3),
            ],
            [
                'nama_diskon' => 'Diskon Musim Panas Sewa Baju',
                'persentase_diskon' => 20,
                'start_date' => Carbon::now()->addDays(35)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(80)->format('Y-m-d'),
                'selectSewaBajus' => array_slice($sewaBajuIds, 2, 3),
            ],
            [
                'nama_diskon' => 'Diskon Akhir Tahun Sewa Baju',
                'persentase_diskon' => 25,
                'start_date' => Carbon::now()->addDays(35)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(80)->format('Y-m-d'),
                'selectSewaBajus' => array_slice($sewaBajuIds, 3, 3),
            ],
            [
                'nama_diskon' => 'Diskon Liburan Sewa Baju',
                'persentase_diskon' => 30,
                'start_date' => Carbon::now()->addDays(35)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(80)->format('Y-m-d'),
                'selectSewaBajus' => array_slice($sewaBajuIds, 4, 3),
            ],
            [
                'nama_diskon' => 'Diskon Tahun Baru Sewa Baju',
                'persentase_diskon' => 35,
                'start_date' => Carbon::now()->addDays(35)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(80)->format('Y-m-d'),
                'selectSewaBajus' => array_slice($sewaBajuIds, 5, 3),
            ],
            [
                'nama_diskon' => 'Diskon Musim Gugur Sewa Baju',
                'persentase_diskon' => 40,
                'start_date' => Carbon::now()->addDays(35)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(80)->format('Y-m-d'),
                'selectSewaBajus' => array_slice($sewaBajuIds, 6, 3),
            ],
        ];

        foreach ($diskonData as $diskon) {
            $diskonRecord = DiskonSewaBaju::create([
                'name' => $diskon['nama_diskon'],
                'discount' => $diskon['persentase_diskon'],
                'start_date' => $diskon['start_date'],
                'end_date' => $diskon['end_date'],
                'status' => ($diskon['start_date'] < now()->format('Y-m-d') && $diskon['end_date'] > now()->format('Y-m-d')) ? 'aktif' : 'tidak aktif',
            ]);

            foreach ($diskon['selectSewaBajus'] as $sewaBajuId) {
                SewaBaju::where('id', $sewaBajuId)->update([
                    'diskon_sewa_baju_id' => $diskonRecord->id,
                    'discount' => $diskon['persentase_diskon'],
                ]);
            }
        }
    }
}
