<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisBantuan;

class JenisBantuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['name' => 'Bantuan Khusus Kesehatan Jiwa (untuk ODGJ)'],
            ['name' => 'Bantuan Pendidikan'],
            ['name' => 'Bantuan Sosial Umum'],
        ];

        JenisBantuan::insert($data);
    }
}
