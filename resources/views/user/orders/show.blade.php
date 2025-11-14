<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Detail - {{ $order->invoice_number }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            padding: 30px;
            color: #333;
        }

        .container {
            width: 900px;
            background: #fff;
            margin: 0 auto;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .1);
        }

        h2 {
            margin-bottom: 5px;
        }

        .sub-title {
            color: #888;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .section-title {
            font-size: 18px;
            margin: 25px 0 10px;
            font-weight: bold;
            color: #444;
        }

        /* Table Style (mengikuti tema kamu) */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        table thead th {
            background: #6a6e51;
            padding: 10px;
            color: #fff;
            border: 1px solid #6a6e51;
        }

        table tbody td {
            padding: 10px;
            border: 1px solid #6a6e51;
            text-align: center;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 4px;
            color: #fff;
            font-size: 12px;
            text-transform: capitalize;
        }

        .bg-success {
            background: #40c710 !important;
        }

        .bg-danger {
            background: #f44032 !important;
        }

        .bg-warning {
            background: #f5d700 !important;
            color: #000;
        }

        .bg-info {
            background: #2196f3 !important;
        }

        .summary-box {
            background: #fafafa;
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            font-size: 15px;
        }

        .summary-item.total {
            font-size: 18px;
            font-weight: bold;
            border-top: 1px dashed #aaa;
            padding-top: 10px;
            margin-top: 5px;
        }

        .btn {
            padding: 10px 18px;
            text-decoration: none;
            background: #6a6e51;
            color: #fff;
            border-radius: 6px;
            transition: .2s;
        }

        .btn:hover {
            background: #575a46;
        }

        .back-btn {
            background: #999;
            margin-right: 10px;
        }

        .back-btn:hover {
            background: #777;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>

<body>

    <div class="container">

        {{-- HEADER --}}
        <h2>Order Detail</h2>
        <div class="sub-title">
            Invoice: <strong>{{ $order->invoice_number }}</strong> <br>
            Order Date: {{ $order->created_at->format('d M Y, H:i') }}
        </div>

        {{-- ORDER STATUS --}}
        <div class="section-title">Status</div>
        <span
            class="badge 
        @if ($order->status == 'pending') bg-warning
        @elseif($order->status == 'paid') bg-info
        @elseif($order->status == 'completed') bg-success
        @else bg-danger @endif
    ">
            {{ $order->status }}
        </span>

        {{-- SHIPPING ADDRESS --}}
        <div class="section-title">Shipping Address</div>
        <div class="summary-box">
            {{ $order->shipping_address }}
        </div>

        {{-- ITEMS TABLE --}}
        <div class="section-title">Items</div>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>Rp {{ number_format($item->price) }}</td>
                        <td>Rp {{ number_format($item->qty * $item->price) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <pre>{{ print_r($item->details_json, true) }}</pre>

        {{-- SUMMARY --}}
        <div class="section-title">Order Summary</div>

        <div class="summary-box">
            <div class="summary-item">
                <span>Subtotal:</span>
                <span>Rp {{ number_format($order->subtotal) }}</span>
            </div>

            <div class="summary-item">
                <span>Shipping:</span>
                <span>Rp {{ number_format($order->shipping) }}</span>
            </div>

            <div class="summary-item total">
                <span>Total:</span>
                <span>Rp {{ number_format($order->total) }}</span>
            </div>
        </div>


        {{-- ACTION BUTTONS --}}
        <a href="{{ route('account-orders') }}" class="btn back-btn">← Back to Orders</a>

        <a href="{{ route('order.invoice', $order->id) }}" class="btn">
            Download Invoice
        </a>


        <div class="footer">
            Thank you for shopping with us.
        </div>

    </div>

</body>

</html>
