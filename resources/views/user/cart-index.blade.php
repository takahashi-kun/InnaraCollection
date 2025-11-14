@extends('layouts.master')
@section('title', 'Checkout')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Keranjang Belanja</h2>
        
        {{-- Tampilkan pesan sukses jika ada (misalnya setelah menghapus item) --}}
        @if (session('success'))
            <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <!-- Keranjang Kiri: Daftar Item -->
            <div class="col-lg-8">
                <div class="cart-table mb-4">
                    <div class="cart-table-head bg-gray-100 p-3 rounded-t-lg font-bold text-gray-700 border-b">
                        <div class="row items-center">
                            <div class="col-6">PRODUK</div>
                            <div class="col-2 text-center">HARGA</div>
                            <div class="col-2 text-center">QTY</div>
                            <div class="col-2 text-center">SUBTOTAL</div>
                        </div>
                    </div>

                    <div class="cart-table-body">
                        @forelse ($cartItems as $item)
                            <div class="row py-4 border-b items-center hover:bg-gray-50 transition duration-150">
                                {{-- KOLOM 1: DETAIL PRODUK --}}
                                <div class="col-lg-6 col-md-6 d-flex align-items-center">
                                    <div class="me-3">
                                        {{-- Tampilkan gambar sablon atau placeholder --}}
                                        @php
                                            // Mengambil URL gambar sablon dari details_json
                                            $sablonUrl = $item->details_json['sablon']['gambar_sablon'] ?? null;
                                        @endphp
                                        {{-- Jika ada URL sablon, tampilkan sablon. Jika tidak, tampilkan gambar kaos default --}}
                                        <img src="{{ $sablonUrl ?: asset('images/kaos/putih.png') }}" alt="Kaos Custom" class="w-20 h-20 object-contain border rounded-md">
                                    </div>
                                    <div>
                                        {{-- Gunakan accessor untuk menampilkan nama varian --}}
                                        <a href="{{ route('configurator') }}" class="text-lg font-semibold text-gray-800 hover:text-blue-600">
                                            {{ $item->variant_name }}
                                        </a>
                                        <p class="text-sm text-gray-500 mt-1">
                                            {{-- Menampilkan detail kustomisasi dari details_json --}}
                                            Bahan: {{ $item->details_json['bahan']['nama_bahan'] ?? 'N/A' }} <br>
                                            Warna: {{ $item->details_json['warna']['nama_warna'] ?? 'N/A' }} <br>
                                            Ukuran: {{ $item->details_json['ukuran']['ukuran'] ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>

                                {{-- KOLOM 2: HARGA SATUAN --}}
                                <div class="col-lg-2 col-md-2 text-center">
                                    <span class="price text-base font-medium text-gray-800">
                                        Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                    </span>
                                </div>

                                {{-- KOLOM 3: KUANTITAS (QTY) --}}
                                <div class="col-lg-2 col-md-2 text-center">
                                    <div class="d-inline-flex border rounded-md items-center">
                                        {{-- Input QTY dinonaktifkan sementara --}}
                                        <input type="number" value="{{ $item->qty }}" min="1" class="form-control form-control_sm text-center w-16 border-0" disabled>
                                    </div>
                                </div>

                                {{-- KOLOM 4: SUBTOTAL & REMOVE --}}
                                <div class="col-lg-2 col-md-2 text-center d-flex flex-column items-center justify-center">
                                    <span class="subtotal text-lg font-bold text-blue-600 mb-2">
                                        Rp {{ number_format($item->total_harga * $item->qty, 0, ',', '.') }}
                                    </span>
                                    
                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-link text-red-500 hover:text-red-700 p-0" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
                                            <i class="ci-close text-xl"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="p-5 text-center text-gray-500">
                                Keranjang Anda kosong. Yuk, <a href="{{ route('configurator') }}" class="text-blue-600 font-medium hover:text-blue-800">mulai kustomisasi kaos Anda</a>!
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Keranjang Kanan: Ringkasan Total -->
            <div class="col-lg-4">
                <div class="cart-total-wrap bg-gray-50 p-6 rounded-lg shadow-md">
                    <h3 class="cart-total-wrap__title text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Ringkasan Keranjang</h3>

                    <div class="d-flex justify-content-between text-lg font-medium py-2">
                        <span class="text-gray-600">Subtotal:</span>
                        <span class="price-value text-gray-800">
                            Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="d-flex justify-content-between text-lg font-medium py-2">
                        <span class="text-gray-600">Biaya Kirim:</span>
                        <span class="price-value text-gray-800">
                            (Dihitung saat Checkout)
                        </span>
                    </div>

                    <div class="d-flex justify-content-between font-extrabold text-2xl border-t mt-3 pt-3">
                        <span class="text-gray-800">Total Keseluruhan:</span>
                        <span class="price-value text-blue-600">
                            Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="mt-4">
                        {{-- Menonaktifkan tombol jika keranjang kosong --}}
                        <a href="{{ $subtotal > 0 ? url('/checkout') : '#' }}" class="btn btn-primary w-100 py-3 rounded-lg transition duration-150 text-center block 
                            {{ $subtotal > 0 ? 'bg-blue-600 hover:bg-blue-700 text-white font-semibold' : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}">
                            PROSES KE CHECKOUT
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
  @endsection
  @section('script')
      <script src="{{ asset('build/assets/admin/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/plugins/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/plugins/countdown.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/theme.js') }}"></script>
  @endsection