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
    public function run()
    {
        $this->call([
            JenisBantuanSeeder::class,
            SatuanSeeder::class,
            TujuanDonasiSeeder::class,
        ]);
    }

}
