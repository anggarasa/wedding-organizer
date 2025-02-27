<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SpatieSeeder::class,
            UserSeeder::class,
            SewaBajuSeeder::class,
            PaketPernikahanSeeder::class,
            DiskonCodeSeeder::class,
            DiskonPaketPernikahanSeeder::class,
            DiskonSewaBajuSeeder::class,
        ]);
    }
}
