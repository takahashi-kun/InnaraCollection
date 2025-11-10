@extends('layouts.master')

@section('title', 'Kaos Customizer 2D')

@section('content')
    <style>
        /* Gaya Kustom untuk Kaos dan Sablon */
        .tshirt-base {
            width: 100%;
            height: auto;
            max-width: 400px;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            aspect-ratio: 1 / 1; 
            border-radius: 0.75rem;
            background-color: #f0f0f0; /* Latar belakang untuk area kaos */
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .tshirt-base img.base-tshirt-image {
            width: 95%; 
            height: 95%;
            object-fit: contain;
            position: relative; 
            z-index: 1;
        }

        .color-overlay {
            position: absolute;
            width: 95%; 
            height: 95%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            mix-blend-mode: multiply; 
            opacity: 1; 
            z-index: 2; 
            pointer-events: none; 
        }

        .sablon-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 150px; 
            max-height: 150px;
            object-fit: contain;
            pointer-events: none; 
            z-index: 3; 
            transition: opacity 0.3s ease;
        }

        /* Kelas untuk item yang dipilih */
        .option-card {
            cursor: pointer;
            transition: all 0.2s;
            border-width: 1px; /* Border default */
        }
        .option-card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }
        .option-card.selected {
            border-color: #3b82f6; /* Tailwind blue-500 */
            border-width: 3px;
            box-shadow: 0 0 0 1px #3b82f6;
        }

        /* Style khusus untuk tombol ukuran */
        .size-button.selected {
            background-color: #3b82f6;
            color: white;
            border-width: 1px; /* Override border-width dari option-card */
        }
    </style>
    <div class="container-fluid py-5">
        <div class="row lg:flex">

            <!-- 1. PANEL KUSTOMISASI (Visualizer Kiri) -->
            <div class="lg:w-1/2 flex flex-col items-center p-4 bg-gray-100 rounded-lg shadow-inner">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Tampilan Kaos</h2>
                <div id="tshirtVisualizer" class="tshirt-base mb-6">
                    
                    <!-- Gambar Kaos Putih Dasar -->
                    <img id="baseTshirtImage" class="base-tshirt-image" 
                         src="{{ asset('images/kaos/putih.png') }}" alt="Kaos Putih Dasar">
                    
                    <!-- Overlay Warna -->
                    <div id="colorOverlay" class="color-overlay"></div>

                    <!-- Overlay Sablon -->
                    <img id="sablonOverlay" class="sablon-overlay opacity-0" src="" alt="Desain Sablon">
                </div>
                
                <div class="w-full text-center">
                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button type="button" onclick="showSablon(true)" id="btnShowSablon" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-l-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500 transition duration-150">
                            Lihat Sablon
                        </button>
                        <button type="button" onclick="showSablon(false)" id="btnHideSablon" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500 transition duration-150">
                            Sembunyikan Sablon
                        </button>
                    </div>
                </div>
            </div>

            <!-- 2. OPSI KUSTOMISASI & HARGA (Panel Kanan) -->
            <div class="lg:w-1/2 p-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Pilih Opsi Kustomisasi</h2>

                <!-- 1. Jenis Bahan (Menggunakan data dari Controller) -->
                <div class="mb-6">
                    <label class="block text-lg font-medium text-gray-700 mb-2">1. Jenis Bahan</label>
                    <div id="bahanOptions" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($bahan as $item)
                            <div class="option-card p-3 border rounded-lg hover:border-blue-400"
                                data-id="{{ $item->id_bahan }}"
                                data-harga="{{ $item->harga_bahan }}"
                                onclick="selectBahan(this)">
                                <p class="font-bold text-gray-800">{{ $item->nama_bahan }}</p>
                                <p class="text-sm text-gray-500">{{ $item->ketebalan_bahan }}</p>
                                <p class="text-sm text-green-600 font-medium">+ Rp {{ number_format($item->harga_bahan, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 2. Ukuran (Menggunakan data dari Controller) -->
                <div class="mb-6">
                    <label class="block text-lg font-medium text-gray-700 mb-2">2. Ukuran</label>
                    <div id="ukuranOptions" class="flex flex-wrap gap-2" 
                         data-ukurans="{{ json_encode($ukurans) }}">
                        <!-- Opsi Ukuran akan dirender oleh JavaScript berdasarkan Bahan yang dipilih -->
                        @foreach ($ukurans as $item)
                            {{-- Kita menyembunyikan ukuran yang tidak relevan, tapi tetap ada di DOM untuk JS --}}
                            <button type="button" 
                                class="size-button option-card px-4 py-2 border rounded-full text-sm font-medium transition duration-150 border-gray-300 text-gray-700 hover:bg-gray-100 hidden" 
                                data-bahan-id="{{ $item->id_bahan }}"
                                data-id="{{ $item->id_ukuran }}"
                                data-ukuran="{{ $item->ukuran }}"
                                data-harga="{{ $item->harga_ukuran }}"
                                onclick="selectUkuran(this)">
                                {{ $item->ukuran }} ({{ $item->harga_ukuran > 0 ? '+Rp ' . number_format($item->harga_ukuran, 0, ',', '.') : 'Dasar' }})
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- 3. Warna Kaos (Menggunakan data dari Controller) -->
                <div class="mb-6">
                    <label class="block text-lg font-medium text-gray-700 mb-2">3. Warna Kaos</label>
                    <div id="warnaOptions" class="flex flex-wrap gap-3">
                        @foreach ($warnas as $item)
                            <div class="option-card w-12 h-12 rounded-full border-2 transition duration-150 flex items-center justify-center border-gray-300" 
                                data-id="{{ $item->id_warna }}"
                                data-hex="{{ $item->kode_hex }}"
                                data-nama="{{ $item->nama_warna }}"
                                data-harga="{{ $item->harga_warna }}"
                                style="background-color: {{ $item->kode_hex }}"
                                onclick="selectWarna(this)">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 4. Desain Sablon (Menggunakan data dari Controller) -->
                <div class="mb-8">
                    <label class="block text-lg font-medium text-gray-700 mb-2">4. Desain Sablon</label>
                    <div id="sablonOptions" class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($sablons as $item)
                            <div class="option-card p-3 border rounded-lg hover:border-blue-400 text-center border-gray-200"
                                data-id="{{ $item->id_sablon }}"
                                data-gambar="{{ $item->gambar_sablon }}"
                                data-nama="{{ $item->nama_sablon }}"
                                data-harga="{{ $item->harga_sablon }}"
                                onclick="selectSablon(this)">
                                <div class="h-20 flex items-center justify-center mb-2">
                                    @if ($item->gambar_sablon)
                                        <img src="{{ $item->gambar_sablon }}" alt="{{ $item->nama_sablon }}" class="max-h-full object-contain mx-auto rounded-md shadow-sm">
                                    @else
                                        <span class="text-gray-500 italic text-sm">Tanpa Sablon</span>
                                    @endif
                                </div>
                                <p class="font-bold text-gray-800 text-sm">{{ $item->nama_sablon }}</p>
                                <p class="text-xs text-gray-500">{{ $item->ukuran_sablon }}</p>
                                <p class="text-sm text-green-600 font-medium">{{ $item->harga_sablon > 0 ? '+Rp ' . number_format($item->harga_sablon, 0, ',', '.') : 'Gratis' }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Ringkasan Harga -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-md shadow-lg">
                    <h3 class="text-xl font-bold text-blue-800 mb-2">Ringkasan Harga</h3>
                    <div class="space-y-1 text-gray-700">
                        <p>Harga Dasar Bahan: <span id="priceBahan" class="font-medium">Rp 0</span></p>
                        <p>Harga Ukuran Tambahan: <span id="priceUkuran" class="font-medium">Rp 0</span></p>
                        <p>Harga Warna Tambahan: <span id="priceWarna" class="font-medium">Rp 0</span></p>
                        <p>Harga Sablon: <span id="priceSablon" class="font-medium">Rp 0</span></p>
                        <p>Biaya Jasa Produksi: <span id="priceJasa" class="font-medium">Rp {{ number_format($totalHargaJasa, 0, ',', '.') }}</span></p>
                    </div>
                    <div class="border-t pt-2 mt-2">
                        <p class="text-2xl font-extrabold text-blue-900">
                            Total Harga: <span id="totalPrice">Rp {{ number_format($totalHargaJasa, 0, ',', '.') }}</span>
                        </p>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-6 flex justify-end gap-4">
                    <button id="addToCart" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-150">
                        Tambah ke Keranjang
                    </button>
                    <button id="checkout" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-150">
                        Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <script>
        // ============== DATA GLOBAL DARI LARAVEL BLADE ==============
        const BIAYA_JASA = {{ $totalHargaJasa }};
        const UKURANS_ALL = {!! json_encode($ukurans) !!}; // Semua data ukuran untuk filtering di JS
        
        // ============== GLOBAL STATE (PILIHAN PENGGUNA) ==============
        // Inisialisasi state menggunakan data default yang dilewatkan dari Controller
        let selectedBahan = {!! json_encode($defaultBahan) !!};
        let selectedUkuran = {!! json_encode($defaultUkuran) !!};
        let selectedWarna = {!! json_encode($defaultWarna) !!};
        let selectedSablon = {!! json_encode($defaultSablon) !!};
        let isSablonVisible = false; // Default: Sembunyikan sablon

        // ============== HELPER FUNCTIONS ==============
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number);
        }

        // ============== RENDER/UPDATE FUNCTIONS ==============

        function updateUkuranOptions() {
            const allSizeButtons = document.querySelectorAll('#ukuranOptions .size-button');
            let foundValidSelection = false;
            let firstValidButton = null;

            allSizeButtons.forEach(button => {
                const bahanId = parseInt(button.getAttribute('data-bahan-id'));
                const isRelevant = bahanId === selectedBahan.id_bahan;
                
                // Tampilkan/Sembunyikan
                button.classList.toggle('hidden', !isRelevant);
                
                if (isRelevant && !firstValidButton) {
                    firstValidButton = button;
                }

                // Cek apakah ukuran yang sudah dipilih masih relevan
                if (selectedUkuran && isRelevant && parseInt(button.getAttribute('data-id')) === selectedUkuran.id_ukuran) {
                    foundValidSelection = true;
                }
            });

            // Jika ukuran yang dipilih tidak valid lagi (karena bahan berubah)
            if (!foundValidSelection && firstValidButton) {
                // Pilih ukuran pertama yang valid
                selectUkuran(firstValidButton, false); 
            } else if (!foundValidSelection && !selectedUkuran) {
                // Jika belum ada pilihan dan tidak ada ukuran yang valid (seharusnya tidak terjadi)
                selectedUkuran = null;
            }
        }

        function updateActiveSelection(containerId, selectedId) {
            const container = document.getElementById(containerId);
            container.querySelectorAll('.option-card').forEach(card => {
                const cardId = parseInt(card.getAttribute('data-id'));
                const isSelected = cardId === selectedId;
                card.classList.toggle('selected', isSelected);

                // Khusus untuk warna, tambahkan ikon check
                if (containerId === 'warnaOptions') {
                    if (isSelected) {
                        card.innerHTML = `<svg class="w-6 h-6 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>`;
                    } else {
                        // Pastikan tombol warna tanpa ikon saat tidak dipilih
                        card.innerHTML = ''; 
                    }
                }
            });
        }
        
        function updateVisualization() {
            const colorOverlay = document.getElementById('colorOverlay');
            const sablonOverlay = document.getElementById('sablonOverlay');

            // 1. Update Warna Kaos
            if (selectedWarna && selectedWarna.kode_hex) {
                colorOverlay.style.backgroundColor = selectedWarna.kode_hex;
            }
            
            // 2. Update Sablon
            const sablonSrc = selectedSablon ? selectedSablon.gambar_sablon || '' : '';

            if (sablonSrc && isSablonVisible) {
                sablonOverlay.src = sablonSrc;
                sablonOverlay.classList.remove('opacity-0');
            } else {
                sablonOverlay.classList.add('opacity-0');
                sablonOverlay.src = ''; 
            }
        }

        function updatePrice() {
            let total = BIAYA_JASA;
            let priceBahanVal = 0;
            let priceUkuranVal = 0;
            let priceWarnaVal = 0;
            let priceSablonVal = 0;

            if (selectedBahan) {
                priceBahanVal = parseFloat(selectedBahan.harga_bahan);
                total += priceBahanVal;
            }
            if (selectedUkuran) {
                priceUkuranVal = parseFloat(selectedUkuran.harga_ukuran);
                total += priceUkuranVal;
            }
            if (selectedWarna) {
                priceWarnaVal = parseFloat(selectedWarna.harga_warna);
                total += priceWarnaVal;
            }
            if (selectedSablon) {
                priceSablonVal = parseFloat(selectedSablon.harga_sablon);
                total += priceSablonVal;
            }

            // Update Ringkasan Harga
            document.getElementById('priceBahan').textContent = formatRupiah(priceBahanVal);
            document.getElementById('priceUkuran').textContent = formatRupiah(priceUkuranVal);
            document.getElementById('priceWarna').textContent = formatRupiah(priceWarnaVal);
            document.getElementById('priceSablon').textContent = formatRupiah(priceSablonVal);
            document.getElementById('totalPrice').textContent = formatRupiah(total);
        }

        function renderAll() {
            // Urutan penting: Bahan dulu, lalu Ukuran, lalu visualisasi & harga
            updateActiveSelection('bahanOptions', selectedBahan ? selectedBahan.id_bahan : null);
            updateUkuranOptions();
            updateActiveSelection('ukuranOptions', selectedUkuran ? selectedUkuran.id_ukuran : null);
            updateActiveSelection('warnaOptions', selectedWarna ? selectedWarna.id_warna : null);
            updateActiveSelection('sablonOptions', selectedSablon ? selectedSablon.id_sablon : null);
            updateVisualization();
            updatePrice();
        }

        // ============== SELECTOR/ACTION FUNCTIONS ==============

        function selectBahan(element, triggerRender = true) {
            selectedBahan = {
                id_bahan: parseInt(element.getAttribute('data-id')),
                nama_bahan: element.querySelector('p:first-child').textContent,
                harga_bahan: parseFloat(element.getAttribute('data-harga'))
                // Properti lain diambil seperlunya
            };
            // Karena bahan berubah, ukuran harus disetel ulang (ini ditangani oleh updateUkuranOptions)
            selectedUkuran = null; 
            
            if (triggerRender) {
                renderAll();
            }
        }

        function selectUkuran(element, triggerRender = true) {
            selectedUkuran = {
                id_ukuran: parseInt(element.getAttribute('data-id')),
                ukuran: element.getAttribute('data-ukuran'),
                harga_ukuran: parseFloat(element.getAttribute('data-harga')),
                // Properti lain diambil seperlunya
            };
            
            if (triggerRender) {
                renderAll();
            }
        }

        function selectWarna(element) {
            selectedWarna = {
                id_warna: parseInt(element.getAttribute('data-id')),
                nama_warna: element.getAttribute('data-nama'),
                kode_hex: element.getAttribute('data-hex'),
                harga_warna: parseFloat(element.getAttribute('data-harga'))
            };
            renderAll();
        }

        function selectSablon(element) {
            selectedSablon = {
                id_sablon: parseInt(element.getAttribute('data-id')),
                nama_sablon: element.getAttribute('data-nama'),
                gambar_sablon: element.getAttribute('data-gambar'),
                harga_sablon: parseFloat(element.getAttribute('data-harga'))
            };
            renderAll();
        }
        
        function showSablon(show) {
            isSablonVisible = show;
            updateVisualization();
            
            const btnShow = document.getElementById('btnShowSablon');
            const btnHide = document.getElementById('btnHideSablon');
            
            // Update button styles
            if (isSablonVisible) {
                btnShow.classList.remove('bg-white', 'text-gray-900', 'border', 'border-gray-200');
                btnShow.classList.add('bg-blue-600', 'text-white');
                btnHide.classList.remove('bg-blue-600', 'text-white');
                btnHide.classList.add('bg-white', 'text-gray-900', 'border', 'border-gray-200');
            } else {
                btnHide.classList.remove('bg-white', 'text-gray-900', 'border', 'border-gray-200');
                btnHide.classList.add('bg-blue-600', 'text-white');
                btnShow.classList.remove('bg-blue-600', 'text-white');
                btnShow.classList.add('bg-white', 'text-gray-900', 'border', 'border-gray-200');
            }
        }

        // ============== INITIALIZATION ==============
        
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Aplikasi Kaos Customizer diinisialisasi.');
            
            // Inisialisasi awal UI
            renderAll();
            showSablon(false); 

            // Event listener untuk tombol aksi
            document.getElementById('addToCart').addEventListener('click', () => {
                console.log(`Pesanan Kaos telah ditambahkan ke keranjang!\n\nDetail:\n- Bahan: ${selectedBahan.nama_bahan}\n- Ukuran: ${selectedUkuran ? selectedUkuran.ukuran : 'N/A'}\n- Warna: ${selectedWarna.nama_warna}\n- Sablon: ${selectedSablon.nama_sablon}\n- Total: ${document.getElementById('totalPrice').textContent}`);
                // Ganti alert dengan modal/notifikasi di aplikasi nyata
                alert('Kaos ditambahkan ke keranjang (Lihat log konsol untuk detail)!');
            });

            document.getElementById('checkout').addEventListener('click', () => {
                console.log('Checkout ditekan. (Langkah selanjutnya adalah integrasi RajaOngkir)');
                // Ganti alert dengan modal/notifikasi di aplikasi nyata
                alert('Anda akan diarahkan ke halaman Checkout untuk perhitungan RajaOngkir!');
            });
        });
    </script>
@endsection