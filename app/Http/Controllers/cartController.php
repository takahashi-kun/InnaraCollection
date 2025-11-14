<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart;
use App\Models\productKastemisasi;
use App\Models\product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class cartController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $userId = Auth::id();
        $cartItems = cart::with('product')->where('user_id', $userId)->get();

        $subtotal = $cartItems->sum(function ($item) {
            return ($item->details_json['harga_jual'] ?? ($item->total_harga ?? 0)) * $item->qty;
        });

        return view('user.cart-index', compact('cartItems', 'subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required',
            'qty' => 'nullable|integer|min:1',
            'id_bahan' => 'required',
            'id_ukuran' => 'required',
            'id_warna' => 'required',
            'id_sablon' => 'required',
            // hidden fields with harga/nama may be strings/numbers
        ]);

        $userId = Auth::id();
        $product = product::find($request->input('id_produk'));
        if (!$product) {
            return redirect()->back()->with('error', 'Product tidak ditemukan');
        }

        $qty = (int) $request->input('qty', 1);

        // Ambil harga dari input hidden (keandalan: controller menerima harga dari view)
        $bahanHarga = (float) $request->input('bahan_harga', 0);
        $ukuranHarga = (float) $request->input('ukuran_harga', 0);
        $warnaHarga = (float) $request->input('warna_harga', 0);
        $sablonHarga = (float) $request->input('sablon_harga', 0);

        // Jika product punya field harga (coba dua nama umum), gunakan sebagai base
        $baseHarga = 0;
        if (isset($product->harga)) $baseHarga = (float) $product->harga;
        elseif (isset($product->harga_produk)) $baseHarga = (float) $product->harga_produk;

        $hargaJual = $baseHarga + $bahanHarga + $ukuranHarga + $warnaHarga + $sablonHarga;

        // Simpan ke product_kastemisasi (untuk referensi)
        $kastemisasi = productKastemisasi::create([
            'id_produk' => $product->id_produk ?? $product->id ?? 2,
            'id_bahan' => $request->input('id_bahan'),
            'id_ukuran' => $request->input('id_ukuran'),
            'id_warna' => $request->input('id_warna'),
            'id_sablon' => $request->input('id_sablon'),
            'nama' => ($product->nama_produk ?? ($product->name ?? 'Product')) . ' - Kustom',
            'harga_jual' => $hargaJual,
            'meta' => [
                'bahan' => [
                    'id' => $request->input('id_bahan'),
                    'nama' => $request->input('bahan_nama'),
                    'harga' => $bahanHarga,
                ],
                'ukuran' => [
                    'id' => $request->input('id_ukuran'),
                    'nama' => $request->input('ukuran_nama'),
                    'harga' => $ukuranHarga,
                ],
                'warna' => [
                    'id' => $request->input('id_warna'),
                    'nama' => $request->input('warna_nama'),
                    'harga' => $warnaHarga,
                ],
                'sablon' => [
                    'id' => $request->input('id_sablon'),
                    'nama' => $request->input('sablon_nama'),
                    'harga' => $sablonHarga,
                ],
            ]
        ]);

        // Simpan item ke cart (details_json menyimpan kastemisasi + harga jual)
        $existing = cart::where('user_id', $userId)
            ->where('id_produk', $product->id_produk ?? $product->id)
            ->where('details_json->kastemisasi_id', $kastemisasi->id)
            ->first();

        if ($existing) {
            $existing->qty += $qty;
            $existing->save();
        } else {
            cart::create([
                'user_id' => $userId,
                'id_produk' => $product->id_produk ?? $product->id,
                'qty' => $qty,
                'details_json' => [
                    'kastemisasi_id' => $kastemisasi->id,
                    'harga_jual' => $hargaJual,
                    'meta' => $kastemisasi->meta,
                ],
            ]);
        }
        // kurangi stok produk 
        if ($product->stok < $qty) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        $product->stok -= $qty;
        $product->save();


        return redirect()->route('cart.index')->with('success', 'Produk kastemisasi berhasil ditambahkan ke keranjang');
    }

    public function update(Request $request, $id)
    {
        $cartItem = cart::findOrFail($id);
        $request->validate(['qty' => 'required|integer|min:1']);
        $newQty = (int)$request->qty;
        $oldQty = $cartItem->qty;

        $product = product::find($cartItem->id_produk);

        if ($product) {
            $selisih = $newQty - $oldQty;

            if ($selisih > 0) {
                // Tambah qty → perlu kurangi stok
                if ($product->stok < $selisih) {
                    return back()->with('error', 'Stok tidak mencukupi.');
                }
                $product->stok -= $selisih;
            } else {
                // Kurangi qty → stok bertambah
                $product->stok += abs($selisih);
            }

            $product->save();
        }

        $cartItem->qty = $newQty;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Keranjang diperbarui');
    }

    public function destroy($id)
    {
        $cartItem = cart::findOrFail($id);
        // Ambil produk terkait
        $product = product::find($cartItem->id_produk);

        if ($product) {
            // Tambahkan stok kembali
            $product->stok += $cartItem->qty;
            $product->save();
        }

        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Item dihapus dari keranjang');
    }
}
