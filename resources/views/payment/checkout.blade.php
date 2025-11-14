@extends('layouts.master')
@section('title', 'Pembayaran')
@section('content')
    <div class="container py-5">
        <h1>Selesaikan Pembayaran Order #{{ $order->id }}</h1>
        <p>Total yang harus dibayar: Rp {{ number_format($order->total, 0, ',', '.') }}</p>
        
        <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
    </div>
@endsection

@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" 
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // Snap Token dari controller
            const snapToken = "{{ $snapToken }}"; 

            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    /* You may send your transaction data to your server */
                    alert("Pembayaran berhasil!"); 
                    // Redirect ke halaman sukses/order user
                    window.location.href = "{{ route('account-orders') }}";
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran Anda.");
                },
                onError: function(result) {
                    alert("Pembayaran gagal!");
                },
                onClose: function() {
                    alert('Anda menutup jendela pembayaran tanpa menyelesaikan pembayaran.');
                }
            });
        };
    </script>
@endsection