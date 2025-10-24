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
        $productOriginal = product::all();
        return view('admin.products.product', compact('productOriginal'));
    }
    public function cetakLaporan(){
        $productOriginal = product::all();
        return view('admin.laporan.cetak', compact('productOriginal'));
    }
    
    public function create()
    {
        return view('admin.products.product-add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10800',
        ]);

        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('products', 'public');
        }

        product::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $imagePath,
        ]);

        return redirect()->route('admin.product')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(product $product)
    {
        return view('admin.products.product-edit', compact('product'));
    }

    public function update(Request $request, product $productOriginal)
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $productOriginal->gambar;
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('products', 'public');
        }

        $productOriginal->update([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $imagePath,
        ]);

        return redirect()->route('admin.product')->with('success', 'Produk berhasil diperbarui.');
    }
    public function destroy(product $productOriginal)
    {
        $productOriginal->delete();
        return redirect()->route('admin.product')->with('success', 'Produk berhasil dihapus.');
    }
}
