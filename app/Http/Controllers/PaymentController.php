<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    public function pay($orderId)
    {
        $order = Order::with('user')->findOrFail($orderId);

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id, // WAJIB unik
                'gross_amount' => (int) $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => $order->user->no_tlp,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        // simpan snap_token ke order
        $order->snap_token = $snapToken;
        $order->save();

        return view('payment.checkout', compact('snapToken', 'order'));
    }


    public function callback(Request $request)
    {
        $notification = new Notification();

        $orderId = str_replace("ORDER-", "", $notification->order_id);
        $status = $notification->transaction_status;
        $fraud = $notification->fraud_status;

        $order = Order::find($orderId);
        if (!$order) return;

        if ($status == 'capture' && $fraud == 'accept') $order->status = 'paid';
        elseif ($status == 'settlement') $order->status = 'paid';
        elseif ($status == 'pending') $order->status = 'pending';
        elseif (in_array($status, ['deny', 'expire', 'cancel'])) $order->status = 'cancelled';

        $order->save();
    }
}
