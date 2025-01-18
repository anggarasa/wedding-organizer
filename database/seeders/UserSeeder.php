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
            'slug' => 'yayah-make-up',
            'name' => 'Yayah Make Up',
            'email' => 'yayahmakeup13@gmail.com',
            'phone' => '085864130067',
            'password' => Hash::make('admin123')
        ]);
        $admin->assignRole('admin');

        $users = [
            [
                'slug' => 'user-1',
                'name' => 'User 1',
                'email' => 'user1@gmail.com',
                'phone' => '084573428364',
                'password' => Hash::make('user123'),
            ],
            [
                'slug' => 'user-2',
                'name' => 'User 2',
                'email' => 'user2@gmail.com',
                'phone' => '086735988436',
                'password' => Hash::make('user123'),
            ],
            [
                'slug' => 'user-3',
                'name' => 'User 3',
                'email' => 'user3@gmail.com',
                'phone' => '089953665781',
                'password' => Hash::make('user123'),
            ],
        ];
        
        foreach ($users as $user) {
            $user = User::create([
                'slug' => $user['slug'],
                'name' => $user['name'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'password' => $user['password'],
            ]);
            $user->assignRole('user');
        }
    }
}
