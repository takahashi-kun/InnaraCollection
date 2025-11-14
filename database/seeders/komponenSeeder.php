<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bahan;
use App\Models\Warna;
use App\Models\ukuran;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class komponenSeeder extends Seeder
{
    protected $bahanData = [
        [
            'nama_bahan' => 'Cotton Combed',
            'ketebalan' => [
                ['ketebalan_bahan' => '20s', 'harga_bahan' => 25000],
                ['ketebalan_bahan' => '24s', 'harga_bahan' => 27000],
                ['ketebalan_bahan' => '30s', 'harga_bahan' => 28000],
            ],
        ],
        [
            'nama_bahan' => 'Cotton Carded',
            'ketebalan' => [
                ['ketebalan_bahan' => '20s', 'harga_bahan' => 23000],
                ['ketebalan_bahan' => '24s', 'harga_bahan' => 25000],
                ['ketebalan_bahan' => '30s', 'harga_bahan' => 26000],
            ],
        ],
    ];

    protected $allSizes = ['S', 'M', 'L', 'XL', 'XXL'];

    protected $ukuranHarga = [
        'S' => 0, 'M' => 0, 'L' => 1500, 'XL' => 4000, 'XXL' => 6500
    ];

    /**
     * Data Warna Asli dan Kode HEX Asli (disinkronkan)
     * Menggunakan data yang Anda sediakan.
     */
    protected $baseColors = ["Fuchsia",
        "Fanta","Merah Cabe","Maroon","Merah Hati","Woodrose","Dusty Pink","Baby Pink","Pink Muda","Bubblegum Pink","Terra Cotta","Rustic Rose","Red Plum","Blush Red","Dusty Rose","Dusty Peach","Baby Peach","Salem M","Salem","Merah Bata","Kuning Mas",
        "Bright Orange","Orange","Orange Bata","Sunset Orange","Kuning Kenari","Kuning Lemon","Baby Yellow","Honey","Mustard","Hijau Sampurna","Dark Mustard","Almond Brown","Cinnamon","Toffee","Beige","Light Brown","Coklat Milo","Susu","Coklat Kopi","Cream","Safari",
        "Dark Olive","Hijau TNI","Army Green","Sage Green","Khaky","Mineral Green","Stone Green","Cactus Green","Seafoam Green","Baby Green","Hijau Stabilo","Hijau Pucuk","Hijau Pupus","Hijau Linmas","Hijau Fuji","Hijau Tua","Hijau Botol","Hijau Botol Spesial","Hijau Mint","Tosca Muda",
        "Tosca Tua","Tosca BNI","Atlantic Sea","Aqua Haze","Mineral Blue","Biru Tosca","Deep Blue","Ocean Blue","Palladian Blue","Sky Blue","Biru Muda","Dusty Blue","Steel Blue","Biru C","Denim Blue","Turkish Muda A","Turkish Muda B","Turkish Tua","Benhur","Navy","Lilac",
        "Lavender","Dark Lavender","Royal Purple","Ungu Tua","Dusty Lilac","Pale Mauve","Twilight Mauve","Dusty Violet","Vintage Violet","Magenta","Hitam Reaktif","Hitam Sulfur","Misty M71","Abu Sedang","Stone Grey","Abu Tua","Jet Black","Putih Bluish","Putih Netral","Broken White","Abu Muda A","Abu Muda B",
        ];    
     protected $baseHexCode = [
    "#CB4273","#C0335F","#CC333D","#7D2027","#803A40","#AE9092","#E0AD9E","#F4E6E2","#EEA5C5","#E77591","#CE837A","#A26E64","#823F54","#B15662","#B87D83","#DE948F","#F4BF86","#F4A19F","#DB6265","#B65748","#FEB236",
    "#FFA326","#FF7338","#C96939","#F75B3B","#FDDB27","#F3D321","#F1EA7F","#BB9645","#DDA142","#BEA437","#F9A12E","#A97A54","#A2553A","#755841","#E5BDB0","#B9A68D","#967759","#AF9C83","#5A4B47","#F4E0AD","#CCC4B4",
    "#74654F","#565D47","#515848","#859E7F","#A09165","#A6C2AE","#467768","#526447","#BBC3BE","#B4E7A0","#CAD66A","#BDE040","#75CB5D","#728D6C","#00804F","#4E7459","#2F5050","#324D4D","#C7E9E3","#5ECCB9","#009170",
    "#008D9B","#2D5C6C","#73A2A1","#587587","#2B6E8D","#2E5C73","#195D99","#ACB9BF","#92B2D5","#5B89CB","#889BAE","#5B7691","#4871B3","#45566F","#4CB9D6","#00B5D7","#008AB6","#384477","#393C47","#C493C3","#9D86BD",
    "#9369A8","#6F4774","#563C65","#AD9294","#C4A4A3","#8A7377","#A57D85","#8D5269","#864061","#3D3F43","#3D4040","#7B7674","#7B7674","#696F6A","#6A6C6E","#3B3D3F","#E9E9E7","#F1F0EC","#F1F0ED","#86879E","#B7C7C5",
    ];    
    /**
     * Membuat array asosiatif warna dan kode HEX.
     */
    protected function getCombinedColorData(): array
    {
        $data = [];
        foreach ($this->baseColors as $index => $namaWarna) {
            $data[] = [
                'nama_warna' => $namaWarna,
                'kode_hex' => $this->baseHexCode[$index],
            ];
        }
        return $data;
    }

    /**
     * Membuat peta harga yang stabil berdasarkan kombinasi (Nama Warna Asli + Ukuran).
     */
    protected function getStableColorPriceMap(array $colorData, array $allSizes): array
    {
        $priceMap = [];
        foreach ($colorData as $color) {
            foreach ($allSizes as $size) {
                // Gunakan hash dari kombinasi untuk menghasilkan harga yang stabil
                $seed = $color['nama_warna'] . $size;
                $hash = crc32($seed); 
                
                // Menghasilkan angka acak stabil antara 30 dan 70
                $stableRand = ($hash % (70 - 30 + 1)) + 30;
                // Harga antara 3000 sampai 7000 (kelipatan 100)
                $price = $stableRand * 100;
                
                $priceMap[$color['nama_warna']][$size] = $price;
            }
        }
        return $priceMap;
    }


    public function run()
    {
        // 1. Inisialisasi Data dan Pembersihan
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('warnas')->truncate();
        DB::table('ukurans')->truncate();
        DB::table('bahans')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $combinedColors = $this->getCombinedColorData();
        $colorPriceMap = $this->getStableColorPriceMap($combinedColors, $this->allSizes);

        // 2. Loop Utama untuk Membuat Kombinasi
        foreach ($this->bahanData as $bahanEntry) {
            foreach ($bahanEntry['ketebalan'] as $ketebalanEntry) {
                
                // Masukkan Bahan (Material + Ketebalan)
                $bahanId = DB::table('bahans')->insertGetId([
                    'nama_bahan' => $bahanEntry['nama_bahan'],
                    'ketebalan_bahan' => $ketebalanEntry['ketebalan_bahan'],
                    'harga_bahan' => $ketebalanEntry['harga_bahan'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Masukkan Ukuran
                foreach ($this->allSizes as $ukuran) {
                    $ukuranId = DB::table('ukurans')->insertGetId([
                        'id_bahan' => $bahanId,
                        'ukuran' => $ukuran,
                        'harga_ukuran' => $this->ukuranHarga[$ukuran] ?? 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Masukkan Warna (Mengaitkan semua warna ke setiap ukuran)
                    foreach ($combinedColors as $warnaEntry) {
                        
                        // Nama Warna di tabel: [NAMA_ASLI] [UKURAN] (e.g., 'Fuchsia S')
                        $namaWarnaFinal = $warnaEntry['nama_warna'] . ' ' . $ukuran;
                        
                        // Harga stabil berdasarkan (Warna Asli + Ukuran)
                        $hargaWarnaFinal = $colorPriceMap[$warnaEntry['nama_warna']][$ukuran];
                        
                        DB::table('warnas')->insert([
                            'id_ukuran' => $ukuranId,
                            'nama_warna' => $namaWarnaFinal,
                            'kode_hex' => $warnaEntry['kode_hex'], 
                            'harga_warna' => $hargaWarnaFinal,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}
