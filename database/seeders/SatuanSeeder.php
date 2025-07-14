<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Satuan;

class SatuanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Kilogram',    'short_code' => 'kg'],
            ['name' => 'Gram',        'short_code' => 'g'],
            ['name' => 'Liter',       'short_code' => 'l'],
            ['name' => 'Mililiter',   'short_code' => 'ml'],
            ['name' => 'Meter',       'short_code' => 'm'],
            ['name' => 'Centimeter',  'short_code' => 'cm'],
            ['name' => 'Buah',        'short_code' => 'buah'],
            ['name' => 'Lembar',      'short_code' => 'lbr'],
            ['name' => 'Dus',         'short_code' => 'dus'],
            ['name' => 'Paket',       'short_code' => 'pkt'],
            ['name' => 'Botol',       'short_code' => 'btl'],
            ['name' => 'Set',         'short_code' => 'set'],
            ['name' => 'Roll',        'short_code' => 'roll'],
        ];

        Satuan::insert($data);
    }
}
