<?php

namespace App\Http\Controllers;
use App\Models\Bahan;
use App\Models\Ukuran;
use App\Models\Warna;
use App\Models\jasa;
use App\Models\Sablon;

use Illuminate\Http\Request;

class configuratorController extends Controller
{

public function index(){
        // 1. Mengambil data kustomisasi
        $bahan = Bahan::all();
        $ukurans = Ukuran::all();
        $warnas = Warna::all();
        $sablons = Sablon::all();

        // 2. Menghitung total harga jasa
        $daftarJasa = Jasa::all();
        $totalHargaJasa = $daftarJasa->sum('harga_jasa');

        // 3. Mengambil nilai default untuk inisialisasi JS
        // Ini memastikan JS memiliki objek PHP untuk digunakan sebelum pilihan dibuat.
        $defaultBahan = $bahan->first();
        $defaultUkuran = $ukurans->where('id_bahan', $defaultBahan->id_bahan)->first(); // Asumsi relasi
        $defaultWarna = $warnas->where('nama_warna', 'Putih')->first() ?? $warnas->first();
        $defaultSablon = $sablons->where('nama_sablon', 'Tanpa Sablon')->first() ?? $sablons->first();

        return view('user.configurator', compact(
            'bahan',
            'ukurans',
            'warnas',
            'sablons',
            'totalHargaJasa', // Melewatkan harga jasa ke view

            // Default untuk inisialisasi state awal di JavaScript
            'defaultBahan',
            'defaultUkuran',
            'defaultWarna',
            'defaultSablon'
        ));
    }
}
