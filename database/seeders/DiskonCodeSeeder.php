<?php

namespace Database\Seeders;

use App\Models\Diskon\DiskonCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiskonCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diskonCodes = [
            [
                'code' => 'DISKON1',
                'description' => 'Diskon 10% untuk pembelian pertama',
                'discount' => 10,
                'penggunaan' => 1,
                'start_date' => now()->subDays(7),
                'end_date' => now()->addDays(7),
                'status' => 'aktif',
            ],
            [
                'code' => 'DISKON2',
                'description' => 'Diskon 20% untuk pembelian kedua',
                'discount' => 20,
                'penggunaan' => 2,
                'start_date' => now()->subDays(14),
                'end_date' => now()->addDays(14),
                'status' => 'aktif',
            ],
            [
                'code' => 'DISKON3',
                'description' => 'Diskon 5% untuk pembelian ketiga',
                'discount' => 5,
                'penggunaan' => 3,
                'start_date' => now()->subDays(21),
                'end_date' => now()->addDays(21),
                'status' => 'tidak aktif',
            ],
            [
                'code' => 'DISKON4',
                'description' => 'Diskon 15% untuk pembelian keempat',
                'discount' => 15,
                'penggunaan' => 4,
                'start_date' => now()->subDays(28),
                'end_date' => now()->addDays(28),
                'status' => 'aktif',
            ],
            [
                'code' => 'DISKON5',
                'description' => 'Diskon 25% untuk pembelian kelima',
                'discount' => 25,
                'penggunaan' => 3,
                'start_date' => now()->subDays(35),
                'end_date' => now()->addDays(35),
                'status' => 'aktif',
            ],
            [
                'code' => 'DISKON6',
                'description' => 'Diskon 30% untuk pembelian keenam',
                'discount' => 30,
                'penggunaan' => 1,
                'start_date' => now()->subDays(42),
                'end_date' => now()->addDays(42),
                'status' => 'tidak aktif',
            ],
            [
                'code' => 'DISKON7',
                'description' => 'Diskon 35% untuk pembelian ketujuh',
                'discount' => 35,
                'penggunaan' => 2,
                'start_date' => now()->subDays(49),
                'end_date' => now()->addDays(49),
                'status' => 'aktif',
            ],
            [
                'code' => 'DISKON8',
                'description' => 'Diskon 40% untuk pembelian kedelapan',
                'discount' => 40,
                'penggunaan' => 3,
                'start_date' => now()->subDays(56),
                'end_date' => now()->addDays(56),
                'status' => 'aktif',
            ],
            [
                'code' => 'DISKON9',
                'description' => 'Diskon 45% untuk pembelian kesembilan',
                'discount' => 45,
                'penggunaan' => 1,
                'start_date' => now()->subDays(63),
                'end_date' => now()->addDays(63),
                'status' => 'tidak aktif',
            ],
            [
                'code' => 'DISKON10',
                'description' => 'Diskon 50% untuk pembelian kesepuluh',
                'discount' => 50,
                'penggunaan' => 2,
                'start_date' => now()->subDays(70),
                'end_date' => now()->addDays(70),
                'status' => 'kadaluarsa',
            ],
        ];

        foreach ($diskonCodes as $code) {
            DiskonCode::create([
                'code' => $code['code'],
                'description' => $code['description'],
                'discount' => $code['discount'],
                'penggunaan' => $code['penggunaan'],
                'start_date' => $code['start_date'],
                'end_date' => $code['end_date'],
                'status' => $code['status'],
            ]);
        }
    }
}
