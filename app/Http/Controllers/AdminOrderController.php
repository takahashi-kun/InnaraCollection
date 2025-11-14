<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use App\Models\Report;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class AdminOrderController extends Controller
{

    public function dashboardOrders()
    {

        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();

        $recentOrders = Order::with('items', 'user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'recentOrders',
            'totalOrders',
            'pendingOrders',
            'deliveredOrders',
            'cancelledOrders'
        ));
    }

    // ===== HALAMAN DAFTAR ORDER ADMIN =====
    public function index()
    {
        $orders = Order::with('items', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.order.orders', compact('orders'));
    }

    // ===== VERIFIKASI PEMBAYARAN =====
    public function verify(Order $order)
    {
        if ($order->status !== 'pending') {
            return back()->with('error', 'Order sudah diverifikasi sebelumnya.');
        }

        $order->status = 'paid';
        $order->save();

        return back()->with('success', 'Order berhasil diverifikasi!');
    }

    // ===== UPDATE STATUS ORDER =====
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,processing,delivered,cancelled'
        ]);

        $order->status = $request->status;

        if ($request->status == 'delivered') {
            $order->delivered_at = now();
        }

        $order->save();

        return back()->with('success', 'Status order diperbarui.');
    }
    public function cetakLaporan(Request $request)
    {
        $filter = $request->filter ?? 'harian';

        $query = Order::with('items', 'user');

        if ($filter === 'harian' && $request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }

        if ($filter === 'bulanan' && $request->bulan && $request->tahun) {
            $query->whereMonth('created_at', $request->bulan)
                ->whereYear('created_at', $request->tahun);
        }

        if ($filter === 'tahunan' && $request->tahun) {
            $query->whereYear('created_at', $request->tahun);
        }

        if ($filter === 'range' && $request->dari && $request->sampai) {
            $query->whereBetween('created_at', [$request->dari, $request->sampai]);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        $totalSales = $orders->sum('total');

        return view('admin.laporan.cetak', compact('orders', 'totalSales'));
    }
}
