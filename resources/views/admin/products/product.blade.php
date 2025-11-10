@extends('layouts.admin')
@section('title', 'All Products')
@section('content')
    <style>
        .btn-XL {
            padding: 10px 20px;
            font-size: 16px;
            min-width: 80px;
            margin: 5px;
        }

        .btn-primary.btn-XL {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-danger.btn-XL {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
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
                    <h3 class="head">All Products</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">All Products</div>
                        </li>
                    </ul>
                </div>

                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">
                            <form class="form-search">
                                <fieldset class="name">
                                    <input type="text" placeholder="Search here..." class="" name="name"
                                        tabindex="2" value="" aria-required="true" required="">
                                </fieldset>
                                <div class="button-submit">
                                    <button class="" type="submit"><i class="icon-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <a class="tf-button style-1 w208" href="{{ route('admin.product.create') }}"><i
                                class="icon-plus"></i>Add new</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Stok</th>
                                    {{-- <th>Harga</th> <-- Dihapus Sesuai Permintaan --}}
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($product as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->nama_produk }}"
                                                style="width: 50px; height: 50px; object-fit: cover;"></td>
                                        <td>{{ $p->nama_produk }}</td>
                                        <td>{{ Str::limit($p->deskripsi, 50) }}</td>
                                        <td>{{ $p->stok }}</td>
                                        {{-- <td>Rp {{ number_format($p->harga ?? 0, 0, ',', '.') }}</td> <-- Dihapus Sesuai Permintaan --}}
                                        <td>
                                            <a href="{{ route('admin.product.kastemisasi.show', $p->id_produk) }}"
                                                class="btn btn-sm btn-info">Lihat Varian</a>

                                            <a href="{{ route('admin.product.edit', $p->id_produk) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('admin.product.destroy', $p->id_produk) }}"
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
                                        <td colspan="6" class="text-center">Belum ada data produk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">


                    </div>
                </div>
            </div>
        </div>


        <div class="bottom-page">
            <div class="body-text">Copyright © 2025 Innara Collection</div>
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
