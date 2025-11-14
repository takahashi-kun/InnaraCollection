<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\AlamatUser;
use App\Models\cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function show()
    {
        $userId = Auth::id();
        $cartItems = cart::with('product')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong');
        }

        // Hitung subtotal
        $subtotal = $cartItems->sum(function ($item) {
            return ($item->details_json['harga_jual'] ?? 0) * $item->qty;
        });

        // Hitung total qty dari cartItems
        $totalQty = $cartItems->sum('qty');

        // Ambil alamat pengguna
        $alamatUser = AlamatUser::where('user_id', $userId)->first();

        // Hitung ongkos kirim berdasarkan alamat + qty
        $shippingCost = $this->calculateShippingCost($alamatUser, $totalQty);

        return view('user.checkout', compact(
            'cartItems',
            'subtotal',
            'shippingCost',
            'alamatUser'
        ));
    }
    private function calculateShippingCost($alamatUser, int $totalQty = 1)
    {
        if (!$alamatUser || $totalQty <= 0) {
            return 0;
        }

        $basePerItem = 2000; // dasar ongkir per item
        $baseTotal = $basePerItem * $totalQty;

        // tambahan 15%
        $additional = $baseTotal * 0.15;

        return (float) round($baseTotal + $additional, 2);
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $cartItems = cart::with('product')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong');
        }

        $request->validate([
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string',
            'shipping' => 'required|numeric|min:0'
        ]);

        // Recalculate subtotal & qty server-side (trust server-side values)
        $subtotal = $cartItems->sum(function ($item) {
            return ($item->details_json['harga_jual'] ?? 0) * $item->qty;
        });

        $totalQty = $cartItems->sum('qty');

        // Optional: recalc shipping on server side to avoid tampering
        $alamatUser = AlamatUser::where('user_id', $userId)->first();
        $calculatedShipping = $this->calculateShippingCost($alamatUser, $totalQty);

        // If you want to force using server-calculated shipping regardless of client,
        // overwrite $request->shipping with $calculatedShipping:
        $shipping = $calculatedShipping;

        $total = $subtotal + $shipping;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => $userId,
                'status' => 'pending',
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'shipping_address' => $request->shipping_address,
                // if you have invoice_number fill it here (or generate later)
            ]);

            foreach ($cartItems as $ci) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'id_produk' => $ci->id_produk,
                    'nama_produk' => $ci->product->nama_produk ?? 'Produk',
                    'qty' => $ci->qty,
                    'price' => $ci->details_json['harga_jual'] ?? 0,
                    'meta' => $ci->details_json,
                ]);
            }

            // Kosongkan cart
            cart::where('user_id', $userId)->delete();

            DB::commit();
            return redirect()->route('account-orders')->with('success', 'Order berhasil dibuat');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat order: ' . $e->getMessage());
        }
    }
}
