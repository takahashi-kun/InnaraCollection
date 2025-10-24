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
    </style>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Product Komponen Settings</h3>
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
                            <div class="price-label">{{ $bahan->nama_bahan }}</div>
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
                            <div class="price-label">{{ $ukuran->ukuran }}</div>
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
                            <div class="price-label">{{ $warna->nama_warna }}</div>
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
                            <div class="price-label">{{ $sablon->nama_sablon }}</div>
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
                <table class="regular-table">
                    <thead>
                        <tr>
                            <th>Ukuran</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ukurans as $ukuran)
                            <tr>
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
            </div>

            <div class="table-container">
                <h4>Data Warna</h4>
                <table class="regular-table">
                    <thead>
                        <tr>
                            <th>Nama Warna</th>
                            <th>Kode HEX</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($warnas as $warna)
                            <tr>
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
            </div>

            <div class="table-container">
                <h4>Data Sablon</h4>
                <table class="regular-table">
                    <thead>
                        <tr>
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

        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('build/admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('build/admin/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('build/admin/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('build/admin/assets/js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('build/admin/assets/js/main.js') }}"></script>
@endsection
