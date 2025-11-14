@extends('layouts.master')
@section('title', 'Checkout')
@section('content')
    <main class="pt-90">
        <section class="shop-checkout container">
            <h2 class="page-title">Checkout</h2>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <!-- Left: Order Summary -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Ringkasan Pesanan</h4>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td>
                                                {{ $item->product->nama_produk }} <br>
                                                <small class="text-gray-600">
                                                    Bahan: {{ $item->bahan['nama_bahan'] ?? '-' }}<br>
                                                    Warna: {{ $item->warna['nama_warna'] ?? '-' }}<br>
                                                    Ukuran: {{ $item->ukuran['ukuran'] ?? '-' }}
                                                </small>
                                            </td>

                                            {{-- harga satuan --}}
                                            <td>
                                                Rp {{ number_format($item->details_json['harga_jual'], 0, ',', '.') }}
                                            </td>

                                            <td>{{ $item->qty }}</td>

                                            {{-- subtotal per item --}}
                                            <td>
                                                Rp
                                                {{ number_format($item->details_json['harga_jual'] * $item->qty, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right: Checkout Form -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Pengiriman & Pembayaran</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('checkout.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Alamat Pengiriman *</label>
                                    <textarea name="shipping_address" class="form-control" rows="3" required>{{ $alamatUser->alamat_lengkap ?? '' }}
                                </textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Biaya Pengiriman (Rp) *</label>
                                    <input type="number" name="shipping" value="{{ $shippingCost }}" class="form-control"
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Metode Pembayaran *</label>
                                    <select name="payment_method" class="form-control" required>
                                        <option value="">Pilih Metode</option>
                                        <option value="midtrans">Midtrans Payment</option>
                                        <option value="transfer">Transfer Bank Manual</option>
                                        <option value="cash">Cash on Delivery</option>
                                    </select>
                                </div>

                                <div class="mb-3 p-3 bg-light rounded">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>Subtotal:</strong>
                                        <strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>Pengiriman:</strong>
                                        <strong id="shippingAmount">
                                            Rp {{ number_format($shippingCost, 0, ',', '.') }}
                                        </strong>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <strong class="h5">Total:</strong>
                                        <strong class="h5" id="totalAmount">
                                            Rp {{ number_format($subtotal + $shippingCost, 0, ',', '.') }}
                                        </strong>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Buat Pesanan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let shipping = {{ $shippingCost }};
            let subtotal = {{ $subtotal }};
            let total = subtotal + shipping;

            document.getElementById('shippingAmount').textContent =
                "Rp " + shipping.toLocaleString('id-ID');

            document.getElementById('totalAmount').textContent =
                "Rp " + total.toLocaleString('id-ID');
        });
    </script>
@endsection
