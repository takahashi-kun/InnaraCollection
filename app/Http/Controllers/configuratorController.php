<?php

namespace App\Http\Controllers;
use App\Models\Bahan;
use App\Models\Ukuran;
use App\Models\Warna;
use App\Models\jasa;
use App\Models\product;
use App\Models\Sablon;

use Illuminate\Http\Request;

class configuratorController extends Controller
{

public function index(){

        $product = product::find(2);
        $bahan = Bahan::all();
        $ukurans = Ukuran::all();
        $warnas = Warna::all();
        $sablons = Sablon::all();

        $daftarJasa = Jasa::all();
        $totalHargaJasa = $daftarJasa->sum('harga_jasa');

        $defaultBahan = $bahan->first();
        $defaultUkuran = $ukurans->where('id_bahan', $defaultBahan->id_bahan)->first();
        $defaultWarna = $warnas->where('nama_warna', 'Putih')->first() ?? $warnas->first();
        $defaultSablon = $sablons->where('nama_sablon', 'Tanpa Sablon')->first() ?? $sablons->first();

        return view('user.configurator', compact(
            'product',
            'bahan',
            'ukurans',
            'warnas',
            'sablons',
            'totalHargaJasa', 
            'defaultBahan',
            'defaultUkuran',
            'defaultWarna',
            'defaultSablon'
        ));
    }
}
