<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $userId = Auth::id();
        $orders = Order::with('items')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.accounts.account-orders', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        $order->load('items');
        return view('user.orders.show', compact('order'));
    }

    public function invoice(Order $order)
    {
        $this->authorize('view', $order);
        $order->load('items', 'user');
        $pdf = PDF::loadView('user.orders.invoice', compact('order'));
        return $pdf->download("invoice_{$order->id}.pdf");
    }
    // public function success($id)
    // {
    //     $order = Order::findOrFail($id);
    //     return view('user.accounts.account-orders', compact('order'));
    // }
}
