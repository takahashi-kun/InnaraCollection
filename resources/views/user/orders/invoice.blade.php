<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $order->invoice_number }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #333;
            padding: 20px;
        }

        h1, h2, h3, h4 {
            margin: 0;
            padding: 0;
        }

        .invoice-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .section {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        th {
            background: #efefef;
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 13px;
        }

        .text-right {
            text-align: right;
        }

        .total-box {
            margin-top: 15px;
            width: 45%;
            margin-left: auto;
        }

        .total-box td {
            padding: 6px 8px;
        }

        .footer {
            margin-top: 35px;
            font-size: 12px;
            text-align: center;
            color: #444;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="section">
        <h1 class="invoice-title">INVOICE: {{ $order->invoice_number }}</h1>
        <p style="margin-top: 5px;">
            <strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}<br>
            <strong>Nama:</strong> {{ $order->user->name }}<br>
            <strong>Alamat Pengiriman:</strong> {{ $order->shipping_address ?? '-' }}
        </p>
    </div>

    {{-- PRODUCTS --}}
    <div class="section">
        <h3><strong>Detail Pesanan</strong></h3>

        <table>
            <thead>
                <tr>
                    <th style="width: 30%">Produk</th>
                    <th style="width: 15%">Qty</th>
                    <th style="width: 15%">Harga</th>
                    <th style="width: 15%">Subtotal</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->nama_produk }}</td>

                        <td>{{ $item->qty }}</td>

                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>

                        <td>Rp {{ number_format($item->qty * $item->price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    {{-- TOTAL --}}
    <table class="total-box">
        <tr>
            <td><strong>Subtotal</strong></td>
            <td class="text-right">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td><strong>Ongkir</strong></td>
            <td class="text-right">Rp {{ number_format($order->shipping, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td><strong>Total</strong></td>
            <td class="text-right"><strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></td>
        </tr>
    </table>

    {{-- FOOTER --}}
    <div class="footer">
        <hr style="margin-bottom:10px;">
        <strong>Innara Collection</strong><br>
        Jl. H. Aen Suhendra, Nanjung, Kec. Margaasih,<br>
        Kab. Bandung, Jawa Barat 40217 <br><br>

        <strong>Email:</strong> InnaraCollection@gmail.com <br>
        <strong>Telp:</strong> +1 000-000-0000
    </div>

</body>
</html>
