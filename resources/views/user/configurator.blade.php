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
            transform: scale(1.03);
        }
    </style>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Konfigurator Kaos</h1>

        <div class="grid lg:grid-cols-2 gap-6">

            <div>
                <div class="tshirt-base p-4 flex items-center justify-center shadow-md" id="tshirtPreview">
                    <img id="kaosPreview" src="{{ asset('images/kaos/putih.png') }}" id="tshirtImage" alt="Kaos"
                        style="max-width:90%; max-height:90%; transition:0.4s;">
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

            <div>
                <form id="configForm" method="POST" action="{{ route('cart.store') }}">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-lg font-semibold mb-3">1. Pilih Bahan</label>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach ($bahan as $item)
                                <label class="option-card p-4 border-2 cursor-pointer">
                                    <input type="radio" name="id_bahan" value="{{ $item->id_bahan }}"
                                        data-nama="{{ $item->nama_bahan }}" data-harga="{{ $item->harga_bahan }}"
                                        {{ $loop->first ? 'checked' : '' }} onchange="updatePreview()">
                                    <div>
                                        <div class="font-bold text-gray-800">{{ $item->nama_bahan }}</div>
                                        <div class="text-sm text-gray-500">{{ $item->ketebalan_bahan }}</div>
                                        <div class="text-sm font-semibold text-green-600">
                                            +Rp {{ number_format($item->harga_bahan) }}
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-lg font-semibold mb-3">2. Pilih Ukuran</label>

                        @php
                            $uniqueSizes = collect($ukurans)->unique('ukuran')->values();
                        @endphp

                        <div class="flex gap-2 overflow-x-auto pb-2 whitespace-nowrap">
                            @foreach ($uniqueSizes as $u)
                                <label class="option-card px-4 py-3 border-2 cursor-pointer inline-block">
                                    <input type="radio" name="id_ukuran" value="{{ $u->id_ukuran }}"
                                        data-ukuran="{{ $u->ukuran }}" data-harga="{{ $u->harga_ukuran }}"
                                        {{ $loop->first ? 'checked' : '' }} onchange="updatePreview()">
                                    <div class="font-semibold">
                                        {{ $u->ukuran }}
                                        @if ($u->harga_ukuran > 0)
                                            <span class="text-green-600">+Rp {{ number_format($u->harga_ukuran) }}</span>
                                        @else
                                            <span class="text-gray-500">(Dasar)</span>
                                        @endif
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-lg font-semibold mb-3">3. Pilih Warna</label>

                        <input type="text" id="searchWarna" placeholder="Cari warna..."
                            class="border px-3 py-2 rounded-lg mb-3 w-full focus:ring focus:ring-blue-300">

                        <div id="warnaContainer" class="grid grid-cols-3 md:grid-cols-4 gap-3"></div>

                        <div class="flex justify-between mt-3">
                            <button id="prevWarna" type="button"
                                class="px-3 py-1 bg-gray-200 rounded disabled:opacity-50">Prev</button>

                            <button id="nextWarna" type="button"
                                class="px-3 py-1 bg-gray-200 rounded disabled:opacity-50">Next</button>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-lg font-semibold mb-3">4. Pilih Sablon</label>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach ($sablons as $s)
                                <label class="option-card text-center p-4 border-2 cursor-pointer">
                                    <input type="radio" name="id_sablon" value="{{ $s->id_sablon }}"
                                        data-nama="{{ $s->nama_sablon }}" data-harga="{{ $s->harga_sablon }}"
                                        onchange="updatePreview()">

                                    <div class="h-20 flex items-center justify-center mb-2">
                                        @if ($s->gambar_sablon)
                                            <img src="{{ $s->gambar_sablon }}" class="max-h-full object-contain">
                                        @else
                                            <span class="text-sm italic text-gray-500">Tanpa Sablon</span>
                                        @endif
                                    </div>

                                    <div class="font-bold text-sm">{{ $s->nama_sablon }}</div>

                                    <div class="text-sm font-semibold text-green-600">
                                        {{ $s->harga_sablon > 0 ? '+Rp ' . number_format($s->harga_sablon) : 'Gratis' }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block font-semibold mb-2">Jumlah</label>
                        <input type="number" name="qty" value="1" min="1" max="100"
                            class="w-24 px-3 py-2 border rounded-lg focus:ring-blue-500">
                    </div>

                    <input type="hidden" name="id_produk" value="{{ $product->id_produk ?? 2 }}">
                    <input type="hidden" name="bahan_nama" id="nama_bahan">
                    <input type="hidden" name="bahan_harga" id="harga_bahan">
                    <input type="hidden" name="ukuran_nama" id="ukuran">
                    <input type="hidden" name="ukuran_harga" id="harga_ukuran">
                    <input type="hidden" name="warna_nama" id="nama_warna">
                    <input type="hidden" name="warna_harga" id="harga_warna">
                    <input type="hidden" name="sablon_nama" id="nama_sablon">
                    <input type="hidden" name="sablon_harga" id="harga_sablon">

                    <div class="flex gap-3 justify-end">
                        <button type="submit" name="action" value="cart"
                            class="px-6 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">
                            Tambah ke Keranjang
                        </button>

                        <button type="submit" name="action" value="checkout"
                            class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                            Checkout Sekarang
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function updatePreview() {
            const form = document.getElementById('configForm');

            const bahanInput = form.querySelector('input[name="id_bahan"]:checked');
            const ukuranInput = form.querySelector('input[name="id_ukuran"]:checked');
            const warnaInput = form.querySelector('input[name="id_warna"]:checked');
            const sablonInput = form.querySelector('input[name="id_sablon"]:checked');
            const qtyInput = form.querySelector('input[name="qty"]');
            let total = 0;

            // Bahan
            if (bahanInput) {
                let harga = parseInt(bahanInput.dataset.harga || 0);
                document.getElementById('nama_bahan').value = bahanInput.dataset.nama;
                document.getElementById('harga_bahan').value = bahanInput.dataset.harga;
                document.getElementById('previewBahan').textContent = bahanInput.dataset.nama;
                total += harga;
            }

            // Ukuran
            if (ukuranInput) {
                let harga = parseInt(ukuranInput.dataset.harga || 0);
                document.getElementById('ukuran').value = ukuranInput.dataset.ukuran;
                document.getElementById('harga_ukuran').value = ukuranInput.dataset.harga;
                document.getElementById('previewUkuran').textContent = ukuranInput.dataset.ukuran;
                total += harga;
            }

            // Warna
            if (warnaInput) {
                let harga = parseInt(warnaInput.dataset.harga || 0);
                const hex = warnaInput.dataset.hex;
                document.getElementById('nama_warna').value = warnaInput.dataset.nama;
                document.getElementById('harga_warna').value = warnaInput.dataset.harga;
                total += harga;
                let pw = document.getElementById('previewWarna');
                if (pw) pw.textContent = warnaInput.dataset.nama;
                document.getElementById("tshirtPreview").style.backgroundColor = hex;

                const previewImg = document.getElementById("kaosPreview");
                previewImg.style.filter = ``;
                previewImg.style.backgroundColor = hex;
            }

            // Sablon
            if (sablonInput) {
                let harga = parseInt(sablonInput.dataset.harga || 0);
                document.getElementById('nama_sablon').value = sablonInput.dataset.nama;
                document.getElementById('harga_sablon').value = sablonInput.dataset.harga;
                document.getElementById('previewSablon').textContent = sablonInput.dataset.nama;
                total += harga;
            }
            let qty = parseInt(qtyInput.value || 1);

            let finalTotal = total * qty;

            document.getElementById("previewTotal").textContent =
                "Rp " + finalTotal.toLocaleString("id-ID");

        }

        updatePreview();
    </script>

    <script>
        const warnaData = @json($warnas);

        let warnaPage = 1;
        const warnaPerPage = 12;

        function renderWarna() {
            const search = document.getElementById("searchWarna").value.toLowerCase();

            let filtered = warnaData.filter(w =>
                w.nama_warna.toLowerCase().includes(search)
            );

            const start = (warnaPage - 1) * warnaPerPage;
            const paginated = filtered.slice(start, start + warnaPerPage);

            const container = document.getElementById("warnaContainer");
            container.innerHTML = "";

            paginated.forEach(w => {
                container.innerHTML += `
            <label class="cursor-pointer text-center">
                <input type="radio" name="id_warna" value="${w.id_warna}"
                    data-nama="${w.nama_warna}" data-harga="${w.harga_warna}"
                    data-hex="${w.kode_hex}" onchange="updatePreview()" class="hidden">

                <div class="w-14 h-14 rounded-full border-2 border-gray-300 mx-auto mb-1"
                     style="background:${w.kode_hex};"></div>

                <div class="text-xs font-medium">${w.nama_warna}</div>
            </label>
            `;
            });

            document.getElementById("prevWarna").disabled = warnaPage <= 1;
            document.getElementById("nextWarna").disabled = start + warnaPerPage >= filtered.length;
        }

        document.getElementById("searchWarna").addEventListener("input", () => {
            warnaPage = 1;
            renderWarna();
        });

        document.getElementById("prevWarna").addEventListener("click", () => {
            if (warnaPage > 1) {
                warnaPage--;
                renderWarna();
            }
        });

        document.getElementById("nextWarna").addEventListener("click", () => {
            warnaPage++;
            renderWarna();
        });

        renderWarna();
    </script>
@endsection
