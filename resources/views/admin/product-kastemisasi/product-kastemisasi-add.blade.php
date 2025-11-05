@extends('layouts.admin')
@section('title', 'Product Customization Options')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3 style="font-size: 2rem; font-weight: bold;">Product Customization Settings</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li>
                            <div class="text-tiny">Customization Options</div>
                        </li>
                    </ul>
                </div>

                <!-- Form kostumisasi -->
                {{-- <form class="tf-section-2 form-add-product" method="POST" action="{{ route('admin.customization.store') }}"> --}}
                <form class="tf-section-2 form-add-product" style="grid-template-columns: 1fr;" method="POST"
                    action="{{ route('admin.product.store') }}">
                    @csrf

                    <div class="wg-box" style="font-size: initial">

                        {{-- Dropdown produk untuk menghubungkan kastemisasi ke produk tertentu --}}
                        <fieldset class="produk_id">
                            <div class="body-title mb-10">Pilih Produk <span class="tf-color-1">*</span></div>
                            <select name="produk_id" class="mb-10" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach ($products as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_produk }}</option>
                                @endforeach
                            </select>
                            <div class="text-tiny">Pilih produk yang akan diberi opsi kastemisasi.</div>
                        </fieldset>

                        <fieldset class="id_bahan">
                            <div class="body-title mb-10">Bahan Dasar <span class="tf-color-1">*</span></div>
                            <select name="id_bahan" class="mb-10" required>
                                <option value="">-- Pilih Bahan --</option>
                                @foreach ($bahans as $bahan)
                                    <option value="{{ $bahan->id_bahan }}">{{ $bahan->nama_bahan }} - Rp
                                        {{ number_format($bahan->harga_bahan, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                            <div class="text-tiny">Pilih bahan dasar kaos.</div>
                        </fieldset>

                        <fieldset class="id_ukuran">
                            <div class="body-title mb-10">Ukuran <span class="tf-color-1">*</span></div>
                            <select name="id_ukuran" class="mb-10" required>
                                <option value="">-- Pilih Ukuran --</option>
                                @foreach ($ukurans as $ukuran)
                                    <option value="{{ $ukuran->id_ukuran }}">{{ $ukuran->ukuran }} - Rp
                                        {{ number_format($ukuran->harga_ukuran, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                            <div class="text-tiny">Pilih ukuran yang tersedia. (Idealnya ini difilter berdasarkan Bahan yang
                                dipilih).</div>
                        </fieldset>

                        <fieldset class="id_sablon">
                            <div class="body-title mb-10">Jenis Sablon <span class="tf-color-1">*</span></div>
                            <select name="id_sablon" class="mb-10" required>
                                <option value="">-- Pilih Sablon --</option>
                                @foreach ($sablons as $sablon)
                                    <option value="{{ $sablon->id_sablon }}">{{ $sablon->nama_sablon }} - Rp
                                        {{ number_format($sablon->harga_sablon, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                            <div class="text-tiny">Pilih jenis sablon yang bisa dipilih customer. (Idealnya ini difilter
                                berdasarkan Bahan yang dipilih).</div>
                        </fieldset>

                        <fieldset class="id_warna">
                            <div class="body-title mb-10">Warna <span class="tf-color-1">*</span></div>
                            <select name="id_warna" class="mb-10" required>
                                <option value="">-- Pilih Warna --</option>
                                @foreach ($warnas as $warna)
                                    <option value="{{ $warna->id_warna }}">{{ $warna->nama_warna }} - Rp
                                        {{ number_format($warna->harga_warna, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                            <div class="text-tiny">Pilih warna yang tersedia untuk produk ini. (Idealnya ini difilter
                                berdasarkan Ukuran yang dipilih).</div>
                        </fieldset>

                        <fieldset class="harga_tambahan">
                            <div class="body-title mb-10">Harga Tambahan (Biaya Kastemisasi Lain)</div>
                            <input type="number" name="total_harga_tambahan" class="mb-10"
                                placeholder="Masukkan tambahan harga (jika ada)">
                            <div class="text-tiny">Contoh: biaya desain, biaya cetak khusus.</div>
                        </fieldset>
                        <fieldset>
                            <div class="body-title mb-10"></div>
                            <button class="tf-button w-full" type="submit">Simpan Opsi Kastemisasi</button>
                        </fieldset>
                    </div>
                </form>

                {{-- Table daftar kastemisasi --}}
                <div class="mt-5">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Bahan</th>
                                <th>Ukuran</th>
                                <th>Warna</th>
                                <th>Sablon</th>
                                <th>Harga Tambahan</th>
                                <th>Total Harga Komponen</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kastemisasis as $kastemisasi)
                                <tr>
                                    <td>{{ $kastemisasi->product->nama_produk ?? '-' }}</td>
                                    {{-- Tampilkan data dari relasi --}}
                                    <td>{{ $kastemisasi->bahan->nama_bahan ?? '-' }}</td>
                                    <td>{{ $kastemisasi->ukuran->ukuran ?? '-' }}</td>
                                    <td>{{ $kastemisasi->warna->nama_warna ?? '-' }}</td>
                                    <td>{{ $kastemisasi->sablon->nama_sablon ?? '-' }}</td>
                                    <td>Rp {{ number_format($kastemisasi->total_harga_tambahan ?? 0, 0, ',', '.') }}</td>

                                    {{-- Hitung Total Harga Komponen --}}
                                    @php
                                        $harga_bahan = $kastemisasi->bahan->harga_bahan ?? 0;
                                        $harga_ukuran = $kastemisasi->ukuran->harga_ukuran ?? 0;
                                        $harga_warna = $kastemisasi->warna->harga_warna ?? 0;
                                        $harga_sablon = $kastemisasi->sablon->harga_sablon ?? 0;
                                        $harga_tambahan = $kastemisasi->total_harga_tambahan ?? 0;
                                        $total_komponen =
                                            $harga_bahan +
                                            $harga_ukuran +
                                            $harga_warna +
                                            $harga_sablon +
                                            $harga_tambahan;
                                    @endphp
                                    <td><b class="text-success">Rp {{ number_format($total_komponen, 0, ',', '.') }}</b>
                                    </td>

                                    <td>
                                        {{-- PERBAIKI ROUTE --}}
                                        <a href="{{ route('admin.product.kastemisasi.edit', $kastemisasi->id_kastemisasi) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form
                                            action="{{ route('admin.product.kastemisasi.destroy', $kastemisasi->id_kastemisasi) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit"
                                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data kostumisasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="bottom-page">
                    <div class="body-text">Copyright © 2025 Innara Collection</div>
                </div>
            </div>
        @endsection

        @section('script')
            <script src="{{ asset('build/admin/assets/js/jquery.min.js') }}"></script>
            <script src="{{ asset('build/admin/assets/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('build/admin/assets/js/bootstrap-select.min.js') }}"></script>
            <script src="{{ asset('build/admin/assets/js/main.js') }}"></script>
        @endsection
