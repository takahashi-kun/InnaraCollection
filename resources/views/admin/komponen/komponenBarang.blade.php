@extends('layouts.admin')
@section('title', 'Komponen Barang')
@section('content')
    <style>
        .cards-container {
            display: flex;
            flex-direction: row;
            gap: 20px;
            flex-wrap: nowrap;
            padding: 20px;
            overflow-x: auto;
        }

        .card-form {
            flex: 1;
            min-width: 300px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            flex-direction: column;
            min-height: 600px;
            /* Set minimum height to ensure consistent card heights */
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }


        .wg-box {
            flex-grow: 1;
            padding: 15px;
        }

        .button-submit {
            margin-top: auto;
            /* Push button to bottom */
            padding: 15px 0;
        }

        .tf-button {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
        }

        .form-add-product {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        fieldset.name {
            margin-bottom: 15px;
        }

        /* Styles for data cards */
        .data-cards-container {
            display: flex;
            flex-direction: row;
            gap: 20px;
            flex-wrap: nowrap;
            padding: 20px;
            overflow-x: auto;
            margin-top: 30px;
        }

        .data-card {
            flex: 1;
            min-width: 300px;
            background: white;
            border-radius: 8px;
            font-size: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .data-table th,
        .data-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .data-table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .edit-btn {
            background: #2d8cf0;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
        }

        .delete-btn {
            background: #dc3545;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            margin-left: 8px;
        }

        .price-info {
            padding: 15px;
        }

        .price-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .price-label {
            color: #666;
            font-size: 14px;
        }

        .price-value {
            font-weight: 600;
            color: #2d8cf0;
        }

        .tables-section {
            margin-top: 30px;
            padding: 20px;
        }

        .section-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .table-container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            font-size: 14px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .regular-table {
            width: 100%;
            border-collapse: collapse;
        }

        .regular-table th,
        .regular-table td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        .regular-table th {
            background: #f8f9fa;
            font-weight: 600;
        }

        .head {
            font-size: 2rem;
            font-weight: bold;
        }
    </style>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3 class="head">Product Komponen Settings</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li>
                            <div class="text-tiny">Komponen Opsi</div>
                        </li>
                    </ul>
                </div>
                {{-- Cards Container --}}
                <div class="cards-container">
                    {{-- Bahan Card --}}
                    <div class="card-form">
                        <div class="card-title">Tambah Bahan</div>
                        <form class="tf-section-2 form-add-product" style="grid-template-columns: 1fr;" method="POST"
                            action="{{ route('admin.komponen.bahan.store') }}">
                            @csrf
                            <div class="wg-box">
                                <fieldset class="name">
                                    <div class="body-title mb-10"> Bahan Baru. <span class="tf-color-1">*</span></div>
                                    <input type="text" name="nama_bahan" class="mb-10" placeholder="Nama Bahan"
                                        required>
                                    <div class="text-tiny">Masukkan nama bahan baru untuk produk.</div>
                                </fieldset>
                                <fieldset class="name">
                                    <div class="body-title mb-10">Tambah Ketebalan Bahan. <span class="tf-color-1">*</span>
                                    </div>
                                    <input type="text" name="ketebalan_bahan" class="mb-10"
                                        placeholder="Ketebalan Bahan" required>
                                    <div class="text-tiny">Masukkan Ketebalan bahan baru untuk produk.</div>
                                </fieldset>
                                <fieldset class="name">
                                    <div class="body-title mb-10">Tambah Harga Bahan. <span class="tf-color-1">*</span>
                                    </div>
                                    <input type="number" name="harga_bahan" class="mb-10" placeholder="Harga Bahan"
                                        required>
                                    <div class="text-tiny">Masukkan Harga bahan baru untuk produk.</div>
                                </fieldset>
                            </div>
                            <div class="button-submit">
                                <button class="tf-button w-full" type="submit">Simpan Bahan</button>
                            </div>
                        </form>
                    </div>

                    {{-- form add ukuran --}}
                    <div class="card-form">
                        <div class="card-title">Tambah Ukuran</div>
                        <form class="tf-section-2 form-add-product" style="grid-template-columns: 1fr;" method="POST"
                            action="{{ route('admin.komponen.ukuran.store') }}">
                            @csrf
                            <div class="wg-box">
                                <fieldset class="name">
                                    <div class="body-title mb-10"> Pilih Bahan Induk. <span class="tf-color-1">*</span>
                                    </div>
                                    <select name="id_bahan" class="mb-10" required>
                                        <option value="">-- Pilih Bahan --</option>
                                        @foreach ($bahans as $bahan)
                                            <option value="{{ $bahan->id_bahan }}">{{ $bahan->nama_bahan }} : {{ $bahan->ketebalan_bahan }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-tiny">Pilih bahan yang akan memiliki ukuran ini.</div>
                                </fieldset>
                                <fieldset class="name">
                                    <div class="body-title mb-10"> Ukuran Baru. <span class="tf-color-1">*</span>
                                    </div>
                                    <input type="text" name="ukuran" class="mb-10" placeholder="Ukuran" required>
                                    <div class="text-tiny">Masukkan Ukuran baru untuk produk.</div>
                                </fieldset>
                                <fieldset class="name">
                                    <div class="body-title mb-10">Tambah Harga Ukuran Baru. <span
                                            class="tf-color-1">*</span>
                                    </div>
                                    <input type="number" name="harga_ukuran" class="mb-10" placeholder="Harga Ukuran"
                                        required>
                                    <div class="text-tiny">Masukkan Harga Ukuran baru untuk produk.</div>
                                </fieldset>
                            </div>
                            <div class="button-submit">
                                <button class="tf-button w-full" type="submit">Simpan Ukuran</button>
                            </div>
                        </form>
                    </div>

                    {{-- form add warna --}}
                    <div class="card-form">
                        <div class="card-title">Tambah Warna</div>
                        <form class="tf-section-2 form-add-product" style="grid-template-columns: 1fr;" method="POST"
                            action="{{ route('admin.komponen.warna.store') }}">
                            @csrf
                            <div class="wg-box">
                                <fieldset class="name">
                                    <div class="body-title mb-10"> Pilih Ukuran Induk. <span class="tf-color-1">*</span>
                                    </div>
                                    <select name="id_ukuran" class="mb-10" required>
                                        <option value="">-- Pilih Ukuran --</option>
                                        @foreach ($ukurans as $ukuran)
                                            {{-- Asumsi Anda sudah memperbaiki relasi Bahan di model Ukuran --}}
                                            <option value="{{ $ukuran->id_ukuran }}">{{ $ukuran->ukuran }}
                                                @if ($ukuran->bahan)
                                                    ({{ $ukuran->bahan->nama_bahan }})
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-tiny">Pilih ukuran yang akan memiliki warna ini.</div>
                                </fieldset>
                                <fieldset class="name">
                                    <div class="body-title mb-10"> Warna Baru. <span class="tf-color-1">*</span></div>
                                    <input type="text" name="nama_warna" class="mb-10" placeholder="Nama Warna"
                                        required>
                                    <div class="text-tiny">Masukkan warna baru untuk produk.</div>
                                </fieldset>
                                <fieldset class="name">
                                    <div class="body-title mb-10">Tambah Kode HEX Warna Baru. <span
                                            class="tf-color-1">*</span>
                                    </div>
                                    <input type="text" name="kode_hex" class="mb-10" placeholder="Kode Hex Warna"
                                        required>
                                    <div class="text-tiny">Masukkan Kode Hex warna baru untuk produk.</div>
                                </fieldset>
                                <fieldset class="name">
                                    <div class="body-title mb-10">Tambah Harga Warna. <span class="tf-color-1">*</span>
                                    </div>
                                    <input type="number" name="harga_warna" class="mb-10" placeholder="Harga Warna"
                                        required>
                                    <div class="text-tiny">Masukkan Harga Warna baru untuk produk.</div>
                                </fieldset>
                            </div>
                            <div class="button-submit">
                                <button class="tf-button w-full" type="submit">Simpan Warna</button>
                            </div>
                        </form>
                    </div>
                    {{-- form add sablon --}}
                    <div class="card-form">
                        <div class="card-title">Tambah Sablon</div>
                        <form class="tf-section-2 form-add-product" style="grid-template-columns: 1fr;" method="POST"
                            action="{{ route('admin.komponen.sablon.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="wg-box">
                                <fieldset class="name">
                                    <div class="body-title mb-10"> Pilih Bahan Induk. <span class="tf-color-1">*</span>
                                    </div>
                                    <select name="id_bahan" class="mb-10" required>
                                        <option value="">-- Pilih Bahan --</option>
                                        @foreach ($bahans as $bahan)
                                            <option value="{{ $bahan->id_bahan }}">{{ $bahan->nama_bahan }} ({{ $bahan->ketebalan_bahan }}) </option>
                                        @endforeach
                                    </select>
                                    <div class="text-tiny">Pilih bahan yang akan memiliki jenis sablon ini.</div>
                                </fieldset>
                                <fieldset class="name">
                                    <div class="body-title mb-10"> Nama Sablon Baru. <span class="tf-color-1">*</span>
                                    </div>
                                    <input type="text" name="nama_sablon" class="mb-10" placeholder="Nama Sablon"
                                        required>
                                    <div class="text-tiny">Masukkan Nama Sablon baru untuk produk.</div>
                                </fieldset>
                                <fieldset class="name">
                                    <div class="body-title mb-10">Tambah Ukuran Sablon Baru. <span
                                            class="tf-color-1">*</span>
                                    </div>
                                    <input type="text" name="ukuran_sablon" class="mb-10"
                                        placeholder="Ukuran Sablon" required>
                                    <div class="text-tiny">Masukkan ukuran Sablon baru untuk produk.</div>
                                </fieldset>
                                <fieldset class="name">
                                    <div class="body-title mb-10">Tambah Harga Sablon. <span class="tf-color-1">*</span>
                                    </div>
                                    <input type="number" name="harga_sablon" class="mb-10" placeholder="Harga Sablon"
                                        required>
                                    <div class="text-tiny">Masukkan Harga Sablon baru untuk produk.</div>
                                </fieldset>
                                <fieldset class="name">
                                    <div class="body-title mb-10">Tambah Gambar Contoh Sablon. <span
                                            class="tf-color-1">*</span>
                                    </div>
                                    <input type="file" name="gambar_sablon" class="mb-10" accept="image/*" required>
                                    <div class="text-tiny">Unggah gambar contoh sablon untuk referensi.</div>
                                </fieldset>
                            </div>
                            <div class="button-submit">
                                <button class="tf-button w-full" type="submit">Simpan Sablon</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        {{-- Price Cards Container --}}
        <div class="data-cards-container">
            {{-- Bahan Price Card --}}
            <div class="data-card">
                <div class="card-title">Harga Bahan</div>
                <div class="price-info">
                    @foreach ($bahans as $bahan)
                        <div class="price-item">
                            <div class="price-label">{{ $bahan->nama_bahan }} : {{ $bahan->ketebalan_bahan }}</div>
                            <div class="price-value">Rp {{ number_format($bahan->harga_bahan, 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Ukuran Price Card --}}
            <div class="data-card">
                <div class="card-title">Harga Ukuran</div>
                <div class="price-info">
                    @foreach ($ukurans as $ukuran)
                        <div class="price-item">
                            <div class="price-label"><span>{{ $ukuran->bahan->nama_bahan }}
                                    ({{ $ukuran->bahan->ketebalan_bahan }})
                                    : </span>{{ $ukuran->ukuran }}</div>
                            <div class="price-value">Rp {{ number_format($ukuran->harga_ukuran, 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Warna Price Card --}}
            <div class="data-card">
                <div class="card-title">Harga Warna</div>
                <div class="price-info">
                    @foreach ($warnas as $warna)
                        <div class="price-item">
                            <div class="price-label"><span>{{ $warna->ukuran->ukuran }} : </span>{{ $warna->nama_warna }}
                            </div>
                            <div class="price-value">Rp {{ number_format($warna->harga_warna, 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Sablon Price Card --}}
            <div class="data-card">
                <div class="card-title">Harga Sablon</div>
                <div class="price-info">
                    @foreach ($sablons as $sablon)
                        <div class="price-item">
                            <div class="price-label"><span>{{ $sablon->bahan->nama_bahan }} :
                                </span>{{ $sablon->nama_sablon }}</div>
                            <div class="price-value">Rp {{ number_format($sablon->harga_sablon, 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Regular Tables Section --}}
        <div class="tables-section">
            <h3 class="section-title">Data Komponen</h3>

            {{-- Bahan Table --}}
            <div class="table-container">
                <h4>Data Bahan</h4>
                <table class="regular-table">
                    <thead>
                        <tr>
                            <th>Nama Bahan</th>
                            <th>Ketebalan</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bahans as $bahan)
                            <tr>
                                <td>{{ $bahan->nama_bahan }}</td>
                                <td>{{ $bahan->ketebalan_bahan }}</td>
                                <td>Rp {{ number_format($bahan->harga_bahan, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('admin.komponen.bahan.edit', $bahan->id_bahan) }}"
                                        class="edit-btn">Edit</a>
                                    <form action="{{ route('admin.komponen.bahan.destroy', $bahan->id_bahan) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn"
                                            onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="table-container">
                <h4>Data ukuran</h4>

                {{-- Form Pencarian Ukuran --}}
                <form method="GET" action="{{ url()->current() }}" class="search-form" style="margin-bottom: 15px;">
                    <div style="display: flex; gap: 10px;">
                        {{-- Input Search Ukuran --}}
                        <input type="text" name="search_ukuran" placeholder="Cari Ukuran/Bahan..."
                            value="{{ request('search_ukuran') }}"
                            style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">

                        {{-- Input tersembunyi untuk mempertahankan halaman warna saat mencari ukuran --}}
                        @if (request()->has('warna_page'))
                            <input type="hidden" name="warna_page" value="{{ request('warna_page') }}">
                        @endif

                        <button type="submit" class="tf-button">Cari</button>
                        @if (request('search_ukuran'))
                            {{-- Tombol Reset Search Ukuran --}}
                            <a href="{{ url()->current() . (request()->has('warna_page') ? '?warna_page=' . request('warna_page') : '') }}"
                                class="tf-button btn-secondary"
                                style="background-color: #f8f9fa; color: #333; border: 1px solid #ccc;">Reset</a>
                        @endif
                    </div>
                </form>
                {{-- End Form Pencarian --}}

                <table class="regular-table">
                    {{-- ... (Thead dan Tbody Anda) ... --}}
                    <tbody>
                        @foreach ($ukurans as $ukuran)
                            {{-- ... (Baris data ukuran) ... --}}
                            <tr>
                                <td>{{ $ukuran->bahan->nama_bahan }} ({{ $ukuran->bahan->ketebalan_bahan }})</td>
                                <td>{{ $ukuran->ukuran }}</td>
                                <td>Rp {{ number_format($ukuran->harga_ukuran, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('admin.komponen.ukuran.edit', $ukuran->id_ukuran) }}"
                                        class="edit-btn">Edit</a>
                                    <form action="{{ route('admin.komponen.ukuran.destroy', $ukuran->id_ukuran) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn"
                                            onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Tampilkan Pagination Ukuran --}}
                <div class="mt-4">
                    {{-- Menggunakan request()->except('ukuran_page') untuk mempertahankan parameter search dan halaman lain --}}
                    {{ $ukurans->appends(request()->except('ukuran_page'))->links() }}
                </div>

            </div>


            <div class="table-container">
                <h4>Data Warna</h4>

                {{-- Form Pencarian Warna --}}
                <form method="GET" action="{{ url()->current() }}" class="search-form" style="margin-bottom: 15px;">
                    <div style="display: flex; gap: 10px;">
                        {{-- Input Search Warna --}}
                        <input type="text" name="search_warna" placeholder="Cari Warna/HEX/Ukuran/Bahan..."
                            value="{{ request('search_warna') }}"
                            style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">

                        {{-- Input tersembunyi untuk mempertahankan halaman ukuran saat mencari warna --}}
                        @if (request()->has('ukuran_page'))
                            <input type="hidden" name="ukuran_page" value="{{ request('ukuran_page') }}">
                        @endif

                        <button type="submit" class="tf-button">Cari</button>
                        @if (request('search_warna'))
                            {{-- Tombol Reset Search Warna --}}
                            <a href="{{ url()->current() . (request()->has('ukuran_page') ? '?ukuran_page=' . request('ukuran_page') : '') }}"
                                class="tf-button btn-secondary"
                                style="background-color: #f8f9fa; color: #333; border: 1px solid #ccc;">Reset</a>
                        @endif
                    </div>
                </form>
                {{-- End Form Pencarian --}}

                <table class="regular-table">
                    {{-- ... (Thead dan Tbody Anda) ... --}}
                    <tbody>
                        @foreach ($warnas as $warna)
                            {{-- ... (Baris data warna) ... --}}
                            <tr>
                                <td>{{ $warna->ukuran->bahan->nama_bahan }} ({{ $warna->ukuran->bahan->ketebalan_bahan }})
                                </td>
                                <td>{{ $warna->ukuran->ukuran }}</td>
                                <td>{{ $warna->nama_warna }}</td>
                                <td>{{ $warna->kode_hex }}</td>
                                <td>Rp {{ number_format($warna->harga_warna, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('admin.komponen.warna.edit', $warna->id_warna) }}"
                                        class="edit-btn">Edit</a>
                                    <a href="#" class="delete-btn"
                                        onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus?')) document.getElementById('delete-warna-{{ $warna->id_warna }}').submit();">Hapus</a>
                                    <form id="delete-warna-{{ $warna->id_warna }}"
                                        action="{{ route('admin.komponen.warna.destroy', $warna->id_warna) }}"
                                        method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Tampilkan Pagination Warna --}}
                <div class="mt-4">
                    {{-- Menggunakan request()->except('warna_page') untuk mempertahankan parameter search dan halaman lain --}}
                    {{ $warnas->appends(request()->except('warna_page'))->links() }}
                </div>

            </div>


            <div class="table-container">
                <h4>Data Sablon</h4>
                <table class="regular-table">
                    <thead>
                        <tr>
                            <th>Nama Bahan</th>
                            <th>Nama Sablon</th>
                            <th>Ukuran</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sablons as $sablon)
                            <tr>
                                <td>{{ $sablon->bahan->nama_bahan }}</td>
                                {{-- <td>{{ $kastemisasi->nama_warna }}</td> --}}
                                <td>{{ $sablon->nama_sablon }}</td>
                                <td>{{ $sablon->ukuran_sablon }}</td>
                                <td>Rp {{ number_format($sablon->harga_sablon, 0, ',', '.') }}</td>
                                <td>
                                    @if ($sablon->gambar_sablon)
                                        <img src="{{ asset('storage/' . $sablon->gambar_sablon) }}" alt="Sablon"
                                            style="width:50px;height:50px;object-fit:cover;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.komponen.sablon.edit', $sablon->id_sablon) }}"
                                        class="edit-btn">Edit</a>
                                    <a href="#" class="delete-btn"
                                        onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus?')) document.getElementById('delete-sablon-{{ $sablon->id_sablon }}').submit();">Hapus</a>
                                    <form id="delete-sablon-{{ $sablon->id_sablon }}"
                                        action="{{ route('admin.komponen.sablon.destroy', $sablon->id_sablon) }}"
                                        method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="wg-box mt-4" style="font-size: 2rem; font-weight: bold;">
                <div class="flex items-center justify-between">
                    <h4 class="mb-0">💰 Total Harga Seluruh Komponen</h4>
                    <h3 class="mb-0 text-primary">
                        Rp {{ number_format($totalHargaSemuaKomponen ?? 0, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('build/assets/admin2/js/jquery.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin2/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin2/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin2/js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('build/assets/admin2/js/main.js') }}"></script>
@endsection
