@extends('layouts.master')

@section('title', 'Kaos Customizer 2D')

@section('content')
    <style>
        .tshirt-base {
            max-width: 400px;
            aspect-ratio: 1/1;
            background: #f0f0f0;
            border-radius: .75rem;
        }

        .option-card {
            cursor: pointer;
            padding: .5rem;
            border: 1px solid #e5e7eb;
            border-radius: .5rem;
            transition: all 0.2s;
        }

        .option-card:hover {
            border-color: #3b82f6;
            box-shadow: 0 0 8px rgba(59, 130, 246, 0.2);
        }

        .option-card input {
            display: none;
        }

        .option-card input:checked+div,
        .option-card input:checked+.color-swatch+div {
            background: #dbeafe;
            border-color: #3b82f6;
        }
    </style>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Konfigurator Kaos</h1>

        <div class="grid lg:grid-cols-2 gap-6">
            <!-- VISUAL PREVIEW -->
            <div>
                <div class="tshirt-base p-4 flex items-center justify-center shadow-md">
                    <img src="{{ asset('images/kaos/putih.png') }}" alt="Kaos" style="max-width:90%; max-height:90%;">
                </div>
                <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                    <h3 class="font-semibold mb-2">Pilihan Anda:</h3>
                    <ul class="text-sm space-y-1">
                        <li>Bahan: <strong id="previewBahan">-</strong></li>
                        <li>Ukuran: <strong id="previewUkuran">-</strong></li>
                        <li>Warna: <strong id="previewWarna">-</strong></li>
                        <li>Sablon: <strong id="previewSablon">-</strong></li>
                    </ul>
                    <hr class="my-2">
                    <p class="text-lg font-bold">Total: <span id="previewTotal">Rp 0</span></p>
                </div>
            </div>

            <!-- FORM KUSTOMISASI -->
            <div>
                <form id="configForm" method="POST" action="{{ route('cart.store') }}">
                    @csrf

                    {{-- 1. Bahan (radio) --}}
                    <div class="mb-6">
                        <label class="block text-lg font-semibold mb-3">1. Pilih Bahan</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach ($bahan as $item)
                                <label class="option-card p-4 border-2 cursor-pointer">
                                    <input type="radio" name="id_bahan" value="{{ $item->id_bahan }}"
                                        data-nama="{{ $item->nama_bahan }}" data-harga="{{ $item->harga_bahan }}"
                                        {{ old('id_bahan') == $item->id_bahan ? 'checked' : ($loop->first ? 'checked' : '') }}
                                        onchange="updatePreview()">
                                    <div>
                                        <div class="font-bold text-gray-800">{{ $item->nama_bahan }}</div>
                                        <div class="text-sm text-gray-500">{{ $item->ketebalan_bahan }}</div>
                                        <div class="text-sm font-semibold text-green-600">
                                            +Rp {{ number_format($item->harga_bahan, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('id_bahan')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 2. Ukuran (radio) --}}
                    <div class="mb-6">
                        <label class="block text-lg font-semibold mb-3">2. Pilih Ukuran</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($ukurans as $u)
                                <label class="option-card px-4 py-3 border-2 cursor-pointer">
                                    <input type="radio" name="id_ukuran" value="{{ $u->id_ukuran }}"
                                        data-ukuran="{{ $u->ukuran }}" data-harga="{{ $u->harga_ukuran }}"
                                        {{ old('id_ukuran') == $u->id_ukuran ? 'checked' : ($loop->first ? 'checked' : '') }}
                                        onchange="updatePreview()">
                                    <div class="font-semibold">
                                        {{ $u->ukuran }}
                                        @if ($u->harga_ukuran > 0)
                                            <span class="text-green-600">+Rp
                                                {{ number_format($u->harga_ukuran, 0, ',', '.') }}</span>
                                        @else
                                            <span class="text-gray-500">(Dasar)</span>
                                        @endif
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('id_ukuran')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 3. Warna (radio) --}}
                    <div class="mb-6">
                        <label class="block text-lg font-semibold mb-3">3. Pilih Warna</label>
                        <div class="flex flex-wrap gap-3 items-center">
                            @foreach ($warnas as $w)
                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input type="radio" name="id_warna" value="{{ $w->id_warna }}"
                                        data-nama="{{ $w->nama_warna }}" data-harga="{{ $w->harga_warna }}"
                                        data-hex="{{ $w->kode_hex }}"
                                        {{ old('id_warna') == $w->id_warna ? 'checked' : ($loop->first ? 'checked' : '') }}
                                        onchange="updatePreview()" class="hidden">
                                    <div class="w-12 h-12 rounded-full border-2 border-gray-300 group-hover:border-blue-500 transition"
                                        style="background-color: {{ $w->kode_hex }};" title="{{ $w->nama_warna }}"></div>
                                    <span class="text-sm font-medium">{{ $w->nama_warna }}
                                        @if ($w->harga_warna > 0)
                                            <span class="text-green-600">(+Rp
                                                {{ number_format($w->harga_warna, 0, ',', '.') }})</span>
                                        @endif
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        @error('id_warna')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 4. Sablon (radio) --}}
                    <div class="mb-6">
                        <label class="block text-lg font-semibold mb-3">4. Pilih Sablon</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach ($sablons as $s)
                                <label class="option-card text-center p-4 border-2 cursor-pointer">
                                    <input type="radio" name="id_sablon" value="{{ $s->id_sablon }}"
                                        data-nama="{{ $s->nama_sablon }}" data-harga="{{ $s->harga_sablon }}"
                                        data-gambar="{{ $s->gambar_sablon ?? '' }}"
                                        {{ old('id_sablon') == $s->id_sablon ? 'checked' : ($loop->first ? 'checked' : '') }}
                                        onchange="updatePreview()">
                                    <div class="h-20 flex items-center justify-center mb-2">
                                        @if ($s->gambar_sablon)
                                            <img src="{{ $s->gambar_sablon }}" alt="{{ $s->nama_sablon }}"
                                                class="max-h-full object-contain">
                                        @else
                                            <span class="text-sm italic text-gray-500">Tanpa Sablon</span>
                                        @endif
                                    </div>
                                    <div class="font-bold text-sm">{{ $s->nama_sablon }}</div>
                                    @if ($s->ukuran_sablon)
                                        <div class="text-xs text-gray-600">{{ $s->ukuran_sablon }}</div>
                                    @endif
                                    <div class="text-sm font-semibold text-green-600">
                                        {{ $s->harga_sablon > 0 ? '+Rp ' . number_format($s->harga_sablon, 0, ',', '.') : 'Gratis' }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('id_sablon')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jumlah --}}
                    <div class="mb-6">
                        <label class="block font-semibold mb-2">Jumlah</label>
                        <input type="number" name="qty" value="{{ old('qty', 1) }}" min="1" max="100"
                            class="w-24 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    {{-- Hidden fields untuk data yang dipilih (akan diisi oleh JS) --}}
                    <input type="hidden" name="id_produk" value="{{ $product->id_produk ?? 2 }}">
                    <input type="hidden" name="bahan_nama" id="nama_bahan">
                    <input type="hidden" name="bahan_harga" id="harga_bahan">
                    <input type="hidden" name="ukuran_nama" id="ukuran">
                    <input type="hidden" name="ukuran_harga" id="harga_ukuran">
                    <input type="hidden" name="warna_nama" id="nama_warna">
                    <input type="hidden" name="warna_harga" id="harga_warna">
                    <input type="hidden" name="sablon_nama" id="nama_sablon">
                    <input type="hidden" name="sablon_harga" id="harga_sablon">

                    {{-- Tombol Aksi --}}
                    <div class="flex gap-3 justify-end">
                        <button type="submit" name="action" value="cart"
                            class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-150">
                            Tambah ke Keranjang
                        </button>
                        <button type="submit" name="action" value="checkout"
                            class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-150">
                            Checkout Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Update preview dan hidden fields
        function updatePreview() {
            const form = document.getElementById('configForm');

            const bahanInput = form.querySelector('input[name="id_bahan"]:checked');
            const ukuranInput = form.querySelector('input[name="id_ukuran"]:checked');
            const warnaInput = form.querySelector('input[name="id_warna"]:checked');
            const sablonInput = form.querySelector('input[name="id_sablon"]:checked');

            // Bahan
            if (bahanInput) {
                document.getElementById('nama_bahan').value = bahanInput.dataset.nama;
                document.getElementById('harga_bahan').value = bahanInput.dataset.harga;

                let pb = document.getElementById('previewBahan');
                if (pb) pb.textContent = bahanInput.dataset.nama;
            }

            // Ukuran
            if (ukuranInput) {
                document.getElementById('ukuran').value = ukuranInput.dataset.ukuran;
                document.getElementById('harga_ukuran').value = ukuranInput.dataset.harga;

                let pu = document.getElementById('previewUkuran');
                if (pu) pu.textContent = ukuranInput.dataset.ukuran;
            }

            // Warna
            if (warnaInput) {
                document.getElementById('nama_warna').value = warnaInput.dataset.nama;
                document.getElementById('harga_warna').value = warnaInput.dataset.harga;

                let pw = document.getElementById('previewWarna');
                if (pw) pw.textContent = warnaInput.dataset.nama;
            }

            // Sablon
            if (sablonInput) {
                document.getElementById('nama_sablon').value = sablonInput.dataset.nama;
                document.getElementById('harga_sablon').value = sablonInput.dataset.harga;

                let ps = document.getElementById('previewSablon');
                if (ps) ps.textContent = sablonInput.dataset.nama;
            }
        }

        // Handle form submit
        document.getElementById('configForm').addEventListener('submit', function(e) {
            const action = e.submitter.value;

            if (action === 'checkout') {
                this.action = "{{ route('checkout.show') }}";
            } else {
                this.action = "{{ route('cart.store') }}";
            }
        });

        // Init preview saat load
        updatePreview();
    </script>
@endsection
