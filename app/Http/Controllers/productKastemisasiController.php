<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\jasa;
use App\Models\Ukuran;
use App\Models\Warna;
use App\Models\Sablon;
use App\Models\product;
use App\Models\productKastemisasi;
use Illuminate\Http\Request;

class productKastemisasiController extends Controller
{
    public function index()
    {
        // Hanya memuat data yang diperlukan untuk form
        $products = product::all();
        $bahans = Bahan::all();
        $ukurans = Ukuran::all();
        $warnas = Warna::all();
        $sablons = Sablon::all();

        return view('admin.product-kastemisasi.product-kastemisasi-add', compact(
            'products',
            'bahans',
            'ukurans',
            'warnas',
            'sablons'
        ));
    }
    public function showVariants(Product $product)
    {
        $kastemisasis = $product->kastemisasis()->with('bahan', 'ukuran', 'warna', 'sablon')->get();
        
        return view('admin.products.product-kastemisasi-show', compact(
            'product',
            'kastemisasis'
        ));
    }
    // alias create -> tampilkan form yang sama (atau arahkan ke index)
    public function create()
    {
        return $this->index();
    }
    public function store(Request $request)
    {
        // 1. VALIDASI
        $request->validate([
            'id_produk' => 'required|exists:products,id_produk', 
            'id_bahan' => 'required|exists:bahans,id_bahan',
            'id_ukuran' => 'required|exists:ukurans,id_ukuran',
            'id_warna' => 'required|exists:warnas,id_warna',
            'id_sablon' => 'required|exists:sablons,id_sablon',
        ]);
        
        // 2. HITUNG HARGA PRODUKSI
        $bahan = Bahan::findOrFail($request->id_bahan);
        $ukuran = Ukuran::findOrFail($request->id_ukuran);
        $warna = Warna::findOrFail($request->id_warna);
        $sablon = Sablon::findOrFail($request->id_sablon);
        
        //  model Jasa diambil
        $harga_jasa = jasa::sum('harga_jasa');

        $harga_komponen_dasar =
            $bahan->harga_bahan +
            $ukuran->harga_ukuran +
            $warna->harga_warna +
            $sablon->harga_sablon;

        $harga_produksi_total = $harga_komponen_dasar + $harga_jasa;

        // 3. SIMPAN KE PRODUCT KASTATEMISASI
        $dataKastemisasi = $request->only([
            'id_produk',
            'id_bahan',
            'id_ukuran',
            'id_warna',
            'id_sablon',
        ]);
        $dataKastemisasi['total_harga_tambahan'] = $harga_produksi_total;

        productKastemisasi::create($dataKastemisasi);

        // 4. REDIRECT KE HALAMAN VARIAN PRODUK TERSEBUT
        return redirect()->route('admin.product.kastemisasi.show', $request->id_produk)->with('success', 'Varian Kostumisasi berhasil disimpan.');
    }

    public function edit(ProductKastemisasi $productKastemisasi)
    {
        return view('admin.product-kastemisasi.product-kastemisasi-edit', compact('productKastemisasi'));
    }

    public function update(Request $request, ProductKastemisasi $productKastemisasi)
    {
        $request->validate([
            'jenis_bahan' => 'required|string',
            'ukuran' => 'required|string',
            'ketebalan_bahan' => 'required|string',
            'bahan_sablon' => 'required|string',
            'warna' => 'required|string',
            'harga_tambahan' => 'nullable|integer',
        ]);
        $data = $request->only([
            'jenis_bahan',
            'ukuran',
            'ketebalan_bahan',
            'bahan_sablon',
            'warna',
            'harga_tambahan'
        ]);

        $productKastemisasi->update($data);
        return redirect()->route('admin.product.kastemisasi')->with('success', 'Kostumisasi berhasil diperbarui.');
    }

    // Hapus kostumisasi
    public function destroy(ProductKastemisasi $productKastemisasi)
    {
        $productId = $productKastemisasi->id_produk;
        $productKastemisasi->delete();
        return redirect()->route('admin.product.kastemisasi')->with('success', 'Kostumisasi berhasil dihapus.');
    }
}
