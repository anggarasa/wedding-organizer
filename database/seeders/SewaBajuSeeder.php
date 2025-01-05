<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Layanan\SewaBaju;
use App\Models\Images\ImageSewaBaju;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SewaBajuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sewaBajus = [
            [
                'name' => 'Kebaya Akad Putih Elegan',
                'description' => 'Kebaya dengan detail bordir yang elegan, cocok untuk acara akad.',
                'price' => 1500000.00,
                'status' => 'Tersedia',
                'ukuran' => 'M',
                'category' => 'Kebaya Akad',
                'images' => [
                    ['image' => 'componen-wedding-3.jpg', 'size' => 1200.50],
                ],
            ],
            [
                'name' => 'Gaun Pengantin Modern Merah',
                'description' => 'Gaun pengantin dengan desain modern berwarna merah menyala.',
                'price' => 2000000.00,
                'status' => 'Disewa',
                'ukuran' => 'L',
                'category' => 'Gaun Pengantin Modern',
                'images' => [
                    ['image' => 'componen-wedding-1.jpg', 'size' => 1300.80],
                ],
            ],
            [
                'name' => 'Anggun Serasi Pastel',
                'description' => 'Baju pernikahan ini mengusung tema modern dengan nuansa serba biru pastel yang lembut dan elegan.',
                'price' => 1000000.00,
                'status' => 'Tersedia',
                'ukuran' => 'XL',
                'category' => 'Kebaya Resepsi',
                'images' => [
                    ['image' => 'componen-wedding-2.jpg', 'size' => 900.20],
                ],
            ],
            [
                'name' => 'Gaun Pernikahan Elegan Biru Muda',
                'description' => 'Gaun pernikahan ini adalah gaun panjang berwarna biru muda dengan detail bordir yang rumit dan indah.',
                'price' => 1900000.00,
                'status' => 'Tersedia',
                'ukuran' => 'L',
                'category' => 'Kebaya Resepsi',
                'images' => [
                    ['image' => 'componen-wedding-5.jpg', 'size' => 900.20],
                ],
            ],
            [
                'name' => 'Kebaya Pengantin Ungu Elegan',
                'description' => 'Baju pernikahan dalam gambar ini adalah baju tradisional dengan warna ungu muda.',
                'price' => 190000.00,
                'status' => 'Tersedia',
                'ukuran' => 'L',
                'category' => 'Kebaya Akad',
                'images' => [
                    ['image' => 'componen-wedding-14.jpg', 'size' => 900.20],
                ],
            ],
            [
                'name' => 'Gaun Pengantin Emas Tradisional dengan Mahkota Ornamen',
                'description' => 'Pengantin pria mengenakan setelan jas berwarna cokelat dengan dasi berwarna perak, sementara pengantin wanita mengenakan gaun panjang berwarna emas dengan hiasan bordir yang rumit dan detail.',
                'price' => 1230000.00,
                'status' => 'Tersedia',
                'ukuran' => 'L',
                'category' => 'Kebaya Resepsi',
                'images' => [
                    ['image' => 'componen-wedding-7.jpg', 'size' => 900.20],
                ],
            ],
            [
                'name' => 'Gaun Pernikahan Anggun Merah Muda Berenda',
                'description' => 'Baju pernikahan ini adalah gaun panjang berwarna merah muda dengan detail renda berwarna merah muda yang lebih gelap di sepanjang tepi gaun dan kerudung.',
                'price' => 1690000.00,
                'status' => 'Tersedia',
                'ukuran' => 'L',
                'category' => 'Gaun Pengantin Modern',
                'images' => [
                    ['image' => 'componen-wedding-11.jpg', 'size' => 900.20],
                ],
            ],
        ];

        foreach ($sewaBajus as $sewaBajuData) {
            $sewaBaju = SewaBaju::create([
                'slug' => Str::slug($sewaBajuData['name']),
                'name' => $sewaBajuData['name'],
                'description' => $sewaBajuData['description'],
                'price' => $sewaBajuData['price'],
                'status' => $sewaBajuData['status'],
                'ukuran' => $sewaBajuData['ukuran'],
                'category' => $sewaBajuData['category'],
            ]);

            foreach ($sewaBajuData['images'] as $imageData) {
                ImageSewaBaju::create([
                    'sewa_baju_id' => $sewaBaju->id,
                    'image' => $imageData['image'],
                    'size' => $imageData['size'],
                ]);
            }
        }
    }
}
