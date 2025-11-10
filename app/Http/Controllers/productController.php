<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\product;

class productController extends Controller
{
    use HasFactory;
    public function index()
    {
        $product = Product::all();
        return view('admin.products.product', compact('product'));
    }

    public function cetakLaporan()
    {
        $product = Product::all();
        return view('admin.laporan.cetak', compact('product'));
    }

    public function create()
    {
        return view('admin.products.product-add');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'deskripsi'   => 'required|string',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,svg|max:10800',
        ]);

        $data = $request->only('nama_produk', 'deskripsi', 'stok'); 
        $data['harga'] = 0; 

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        product::create($data);
        return redirect()->route('admin.product')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.product', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'deskripsi'   => 'required|string',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,svg|max:10800',
        ]);

        // ambil semua data yang boleh diupdate
        $data = $request->only(['nama_produk', 'deskripsi', 'stok']);

        // cek apakah ada gambar baru
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        // update data produk
        $product->update($data);

        return redirect()->route('admin.product')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product')->with('success', 'Produk berhasil dihapus.');
    }
}
