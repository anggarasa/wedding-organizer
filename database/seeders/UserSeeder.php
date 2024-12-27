<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'slug' => Str::uuid(),
            'name' => 'Yayah Make Up',
            'email' => 'yayahmakeup13@gmail.com',
            'phone' => '085864130067',
            'password' => Hash::make('admin123')
        ]);
        $admin->assignRole('admin');
    }
}
