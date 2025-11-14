@extends('layouts.admin')
@section('title', 'Varian Kastemisasi: ' . $product->nama_produk)
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3 style="font-size: 2rem; font-weight: bold;">Varian Kastemisasi: {{ $product->nama_produk }}</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ route('admin.product') }}">
                                <div class="text-tiny">Daftar Produk</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li>
                            <div class="text-tiny">Varian Kastemisasi</div>
                        </li>
                    </ul>
                </div>

                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 mb-20">
                        <a href="{{ route('admin.product.kastemisasi.add') }}" class="tf-button style-1 w-full text-center">
                            Tambah Varian Baru
                        </a>
                    </div>
                </div>

                <div class="wg-box table-responsive">
                    <h5 class="mb-3">Daftar Varian untuk {{ $product->nama_produk }} (Total {{ $kastemisasis->count() }} Varian)</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Bahan</th>
                                <th>Ukuran</th>
                                <th>Warna</th>
                                <th>Sablon</th>
                                <th>Harga Produksi Total</th>
                                <th>Harga Jual Akhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kastemisasis as $kastemisasi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kastemisasi->bahan->nama_bahan ?? '-' }}</td>
                                    <td>{{ $kastemisasi->ukuran->ukuran ?? '-' }}</td>
                                    <td>{{ $kastemisasi->warna->nama_warna ?? '-' }}</td>
                                    <td>{{ $kastemisasi->sablon->nama_sablon ?? '-' }}</td>

                                    {{-- Kolom Harga Produksi Total (Komponen + Jasa) --}}
                                    <td>
                                        Rp {{ number_format($kastemisasi->total_harga_tambahan ?? 0, 0, ',', '.') }}
                                    </td>

                                    {{-- Kolom Harga Jual Akhir (Produksi * 1.3) --}}
                                    @php
                                        // Asumsi margin 30% atau faktor pengali 1.3
                                        $harga_produksi_kastem = $kastemisasi->total_harga_tambahan ?? 0;
                                        $harga_jual_akhir = $harga_produksi_kastem * 1.3;
                                    @endphp

                                    <td>
                                        <b class="text-success">Rp {{ number_format($harga_jual_akhir, 0, ',', '.') }}</b>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.product.kastemisasi.edit', $kastemisasi->id_kastemisasi) }}"
                                            class="btn btn-XL btn-warning" style="font-size: 16px;">Edit</a>
                                        <form
                                            action="{{ route('admin.product.kastemisasi.destroy', $kastemisasi->id_kastemisasi) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-XL btn-danger" style="font-size: 16px;" type="submit"
                                                onclick="return confirm('Yakin ingin menghapus varian ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Produk ini belum memiliki varian kastemisasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="bottom-page">
                    <div class="body-text">Copyright © 2025 Innara Collection</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('build/assets/admin2/js/jquery.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin2/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin2/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin2/js/main.js') }}"></script>
@endsection
