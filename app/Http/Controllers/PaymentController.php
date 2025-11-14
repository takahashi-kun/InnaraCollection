<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;

class PaymentController extends Controller
{
    public function pay($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => $order->user->no_tlp,
            ]
        ];

        // Generate Snap Token
        $snapToken = Snap::getSnapToken($params);

        return view('payment.checkout', compact('snapToken', 'order'));
    }
    public function callback(Request $request)
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        $notif = new \Midtrans\Notification();

        $orderId = $notif->order_id;
        $transaction = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($transaction == 'capture') {
            if ($fraud == 'challenge') {
                $order->status = 'challenge';
            } else {
                $order->status = 'paid';
            }
        } elseif ($transaction == 'settlement') {
            $order->status = 'paid';
        } elseif ($transaction == 'pending') {
            $order->status = 'pending';
        } elseif ($transaction == 'deny') {
            $order->status = 'denied';
        } elseif ($transaction == 'expire') {
            $order->status = 'expired';
        } elseif ($transaction == 'cancel') {
            $order->status = 'canceled';
        }

        $order->save();

        return response()->json(['message' => 'Callback processed']);
    }
}
