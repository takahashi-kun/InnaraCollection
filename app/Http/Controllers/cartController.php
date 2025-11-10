<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart;
use App\Models\product;
use Illuminate\Support\Facades\Auth;
class cartController extends Controller
{
    /**
     * Menampilkan semua item di keranjang pengguna yang sedang login.
     */
    public function index()
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        
        // Ambil item keranjang berdasarkan user_id dan status pending
        $cartItems = Cart::where('user_id', $userId)
            ->where('status', 'pending') 
            ->get();
            
        // Hitung total keseluruhan
        $subtotal = $cartItems->sum(function ($item) {
            // Pastikan total_harga adalah float karena di-cast di Model
            return $item->total_harga * $item->qty;
        });
        $items = Auth::check()
            ? cart::where('user_id', Auth::id())->with('product')->get()
            : cart::with('product')->get(); // sesuaikan untuk session-based cart


        // Pastikan kita menggunakan view yang benar: user.carts.cart-index
        return view('user.cart-index', compact('cartItems', 'subtotal','items'));
    }

    /**
     * Menambahkan item kustomisasi baru ke keranjang.
     */
    public function add(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'qty' => 'required|integer|min:1',
            'bahan' => 'required|array',
            'ukuran' => 'required|array',
            'warna' => 'required|array',
            'sablon' => 'required|array',
            'total_harga' => 'required|numeric|min:0', // Harga per item
        ]);
        
        if (!Auth::check()) {
            // Mengembalikan respons 401 Unauthorized jika belum login
            return response()->json(['success' => false, 'message' => 'Harap login untuk menambahkan ke keranjang.'], 401);
        }

        $userId = Auth::id();

        // 2. Kumpulkan Detail Kustomisasi
        // Penting: Data yang disimpan di sini HARUS sama persis dengan yang dikirim dari JS
        $details = [
            'bahan' => [
                'id_bahan' => $request->input('bahan.id_bahan'),
                'nama_bahan' => $request->input('bahan.nama_bahan'),
                'harga_bahan' => $request->input('bahan.harga_bahan'),
            ],
            'ukuran' => [
                'id_ukuran' => $request->input('ukuran.id_ukuran'),
                'ukuran' => $request->input('ukuran.ukuran'),
                'harga_ukuran' => $request->input('ukuran.harga_ukuran'),
            ],
            'warna' => [
                'id_warna' => $request->input('warna.id_warna'),
                'nama_warna' => $request->input('warna.nama_warna'),
                'harga_warna' => $request->input('warna.harga_warna'),
                'kode_hex' => $request->input('warna.kode_hex'),
            ],
            'sablon' => [
                'id_sablon' => $request->input('sablon.id_sablon'),
                'nama_sablon' => $request->input('sablon.nama_sablon'),
                'harga_sablon' => $request->input('sablon.harga_sablon'),
                'gambar_sablon' => $request->input('sablon.gambar_sablon'), // URL Sablon
            ],
        ];

        // 3. Cek apakah varian yang SAMA persis sudah ada di keranjang
        // Kita menggunakan whereJsonContains untuk mengecek semua detail di atas
        // Note: whereJsonContains terkadang sensitif, pastikan data yang dikirim dan disimpan konsisten.
        $existingCartItem = Cart::where('user_id', $userId)
            ->where('status', 'pending')
            ->where('total_harga', $request->total_harga) // Filter harga untuk mempermudah pengecekan
            ->whereJsonContains('details_json', $details)
            ->first();

        if ($existingCartItem) {
            // Jika ada, tambahkan kuantitas (QTY)
            $existingCartItem->qty += $request->qty;
            $existingCartItem->save();
            $message = 'Kuantitas item yang sama di keranjang berhasil diperbarui.';
        } else {
            // Jika tidak ada, buat item keranjang baru
            Cart::create([
                'user_id' => $userId,
                'total_harga' => $request->total_harga,
                'qty' => $request->qty,
                'status' => 'pending', 
                'details_json' => $details, // Simpan detail kustomisasi
            ]);
            $message = 'Item kustomisasi baru berhasil ditambahkan ke keranjang.';
        }

        // 4. Beri Respons Sukses
        return response()->json(['success' => true, 'message' => $message]);
    }

    /**
     * Menghapus item dari keranjang.
     */
    public function remove($id)
    {
        $userId = Auth::id();

        $cartItem = Cart::where('user_id', $userId)
                        ->where('status', 'pending')
                        ->findOrFail($id);
        
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:products,id_produk',
            'qty' => 'required|integer|min:1'
        ]);

        $product = product::find($request->id_produk);

        if (!$product) {
            return back()->withErrors(['Produk tidak ditemukan']);
        }

        // optional: cek stok jika kolom stok ada
        if (isset($product->stok) && $product->stok < $request->qty) {
            return back()->withErrors(['Stok tidak mencukupi']);
        }

        // jika tabel cart menyimpan user_id dan id_produk, qty
        $cartData = [
            'id_produk' => $product->id_produk,
            'qty' => $request->qty,
        ];

        if (Auth::check()) {
            $cartData['user_id'] = Auth::id();
        }

        // buat record cart (pastikan model $fillable include fields di atas)
        $cart = cart::create($cartData);

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang');
    }
}
