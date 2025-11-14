<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class alamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            // Hanya beberapa contoh, Anda perlu menambahkan yang lainnya
            ['province_id' => 11, 'name' => 'Aceh'],
            ['province_id' => 12, 'name' => 'Sumatera Utara'],
            ['province_id' => 14, 'name' => 'Riau'],
            ['province_id' => 18, 'name' => 'Lampung'],
            ['province_id' => 31, 'name' => 'DKI Jakarta'],
            ['province_id' => 32, 'name' => 'Jawa Barat'],
            ['province_id' => 33, 'name' => 'Jawa Tengah'],
            ['province_id' => 35, 'name' => 'Jawa Timur'],
            ['province_id' => 51, 'name' => 'Bali'],
            ['province_id' => 73, 'name' => 'Sulawesi Selatan'],
        ];

        foreach ($provinces as $province) {
            DB::table('provinces')->insert([
                'province_id' => $province['province_id'],
                'name' => $province['name'],
                'rajaongkir_province_id' => $province['province_id'], // Menggunakan ID sendiri sebagai dummy
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $cities = [
            // Contoh untuk Aceh (province_id: 11)
            ['city_id' => 1101, 'province_id' => 11, 'name' => 'Kabupaten Aceh Selatan', 'postal_code' => '23719'],
            ['city_id' => 1171, 'province_id' => 11, 'name' => 'Kota Banda Aceh', 'postal_code' => '23231'],

            // Contoh untuk Sumatera Utara (province_id: 12)
            ['city_id' => 1207, 'province_id' => 12, 'name' => 'Kabupaten Deli Serdang', 'postal_code' => '20511'],
            ['city_id' => 1271, 'province_id' => 12, 'name' => 'Kota Medan', 'postal_code' => '20212'],

            // Contoh untuk DKI Jakarta (province_id: 31)
            ['city_id' => 3101, 'province_id' => 31, 'name' => 'Kota Jakarta Selatan', 'postal_code' => '12110'],
            ['city_id' => 3102, 'province_id' => 31, 'name' => 'Kota Jakarta Pusat', 'postal_code' => '10110'],

            // Contoh untuk Jawa Barat (province_id: 32)
            ['city_id' => 3204, 'province_id' => 32, 'name' => 'Kabupaten Bandung', 'postal_code' => '40311'],
            ['city_id' => 3273, 'province_id' => 32, 'name' => 'Kota Bandung', 'postal_code' => '40111'],

            // Contoh untuk Jawa Timur (province_id: 35)
            ['city_id' => 3573, 'province_id' => 35, 'name' => 'Kota Malang', 'postal_code' => '65111'],
            ['city_id' => 3578, 'province_id' => 35, 'name' => 'Kota Surabaya', 'postal_code' => '60111'],
        ];

        foreach ($cities as $city) {
            DB::table('cities')->insert([
                'city_id' => $city['city_id'],
                'province_id' => $city['province_id'],
                'name' => $city['name'],
                'postal_code' => $city['postal_code'],
                'rajaongkir_city_id' => $city['city_id'], // Menggunakan ID sendiri sebagai dummy
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $subdistricts = [
            // Contoh untuk Kota Banda Aceh (city_id: 1171)
            ['subdistrict_id' => 117101, 'city_id' => 1171, 'name' => 'Baiturrahman'],
            ['subdistrict_id' => 117102, 'city_id' => 1171, 'name' => 'Kuta Alam'],

            // Contoh untuk Kota Medan (city_id: 1271)
            ['subdistrict_id' => 127101, 'city_id' => 1271, 'name' => 'Medan Kota'],
            ['subdistrict_id' => 127102, 'city_id' => 1271, 'name' => 'Medan Area'],

            // Contoh untuk Kota Jakarta Selatan (city_id: 3101)
            ['subdistrict_id' => 310101, 'city_id' => 3101, 'name' => 'Kebayoran Baru'],
            ['subdistrict_id' => 310102, 'city_id' => 3101, 'name' => 'Cilandak'],

            // Contoh untuk Kota Bandung (city_id: 3273)
            ['subdistrict_id' => 327301, 'city_id' => 3273, 'name' => 'Bandung Kidul'],
            ['subdistrict_id' => 327302, 'city_id' => 3273, 'name' => 'Coblong'],

            // Contoh untuk Kota Surabaya (city_id: 3578)
            ['subdistrict_id' => 357801, 'city_id' => 3578, 'name' => 'Gubeng'],
            ['subdistrict_id' => 357802, 'city_id' => 3578, 'name' => 'Rungkut'],
        ];

        foreach ($subdistricts as $subdistrict) {
            DB::table('subdistricts')->insert([
                'subdistrict_id' => $subdistrict['subdistrict_id'],
                'city_id' => $subdistrict['city_id'],
                'name' => $subdistrict['name'],
                'rajaongkir_subdistrict_id' => $subdistrict['subdistrict_id'], // Menggunakan ID sendiri sebagai dummy
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
