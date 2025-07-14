<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TujuanDonasi;

class TujuanDonasiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Donasi Khusus Kesehatan Jiwa ', 'is_active' => true],
            ['name' => 'Donasi Pendidikan', 'is_active' => true],
            ['name' => 'Donasi Sosial Umum', 'is_active' => true],
        ];

        TujuanDonasi::insert($data);
    }
}
