<?php

namespace Database\Seeders;

use App\Models\jasa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class jasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_jasa' => 'Jahit', 'harga_jasa' => 10000],
            ['nama_jasa' => 'Obras', 'harga_jasa' => 8000],
            ['nama_jasa' => 'Overdeck', 'harga_jasa' => 7000],
            ['nama_jasa' => 'Sablon', 'harga_jasa' => 12000],
            ['nama_jasa' => 'Finishing', 'harga_jasa' => 5000],
        ];

        foreach ($data as $item) {
            jasa::updateOrCreate(['nama_jasa' => $item['nama_jasa']], $item);
        }
    }
}
