<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\productKastemisasi;
use Illuminate\Http\Request;

class productKastemisasiController extends Controller
{
        public function index()
    {
        // daftar kostumisasi (dengan relasi product) dan daftar produk untuk dropdown
        $kastemisasis = productKastemisasi::with('product')->get();
        $products = product::all();

        return view('admin.product-kastemisasi.product-kastemisasi-add', compact('kastemisasis', 'products'));
    }

    // alias create -> tampilkan form yang sama (atau arahkan ke index)
    public function create()
    {
        return $this->index();
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:products,id',
            'jenis_bahan' => 'required|string',
            'ukuran' => 'required|string',
            'ketebalan_bahan' => 'required|string',
            'bahan_sablon' => 'required|string',
            'warna' => 'required|string',
            'harga_tambahan' => 'nullable|numeric',
        ]);
        $data = $request->only([
            'produk_id','jenis_bahan','ukuran','ketebalan_bahan','bahan_sablon','warna','harga_tambahan'
        ]);

        productKastemisasi::create($data);
        return redirect()->back()->with('success','Kostumisasi berhasil disimpan.');
    }

    // Edit kostumisasi tertentu
    public function edit(ProductKastemisasi $productKastemisasi)
    {
        return view('admin.product-kastemisasi.product-kastemisasi-edit', compact('productKastemisasi'));
    }

    // Update data kostumisasi
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
            'jenis_bahan','ukuran','ketebalan_bahan','bahan_sablon','warna','harga_tambahan'
        ]);

        $productKastemisasi->update($data);
        return redirect()->route('admin.product.kastemisasi')->with('success', 'Kostumisasi berhasil diperbarui.');
    }

    // Hapus kostumisasi
    public function destroy(ProductKastemisasi $productKastemisasi)
    {
        $productKastemisasi->delete();
        return redirect()->route('admin.product.kastemisasi')->with('success', 'Kostumisasi berhasil dihapus.');
    }
}
