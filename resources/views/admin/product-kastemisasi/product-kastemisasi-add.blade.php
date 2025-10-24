@extends('layouts.admin')
@section('title', 'Product Customization Options')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Product Customization Settings</h3>
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
                    action="{{ route('products.kastemisasi.store') }}">
                    @csrf

                    <div class="wg-box">

                        {{-- Dropdown produk untuk menghubungkan kastemisasi ke produk tertentu --}}
                        <fieldset class="name">
                            <div class="body-title mb-10">Pilih Produk <span class="tf-color-1">*</span></div>
                            <select name="produk_id" class="mb-10" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach ($products as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_produk }}</option>
                                @endforeach
                            </select>
                            <div class="text-tiny">Pilih produk yang akan diberi opsi kastemisasi.</div>
                        </fieldset>

                        <fieldset class="name">
                            <div class="body-title mb-10">Jenis Bahan <span class="tf-color-1">*</span></div>
                            <input type="text" name="jenis_bahan" class="mb-10" placeholder="Contoh: Cotton Combed 30s"
                                required>
                            <div class="text-tiny">Masukkan jenis bahan dasar kaos (misalnya Combed, Polyester, Dri-Fit).
                            </div>
                        </fieldset>

                        <fieldset class="name">
                            <div class="body-title mb-10">Ukuran <span class="tf-color-1">*</span></div>
                            <input type="text" name="ukuran" class="mb-10" placeholder="Contoh: S, M, L, XL" required>
                            <div class="text-tiny">Masukkan ukuran yang tersedia, pisahkan dengan koma jika lebih dari satu.
                            </div>
                        </fieldset>

                        <fieldset class="name">
                            <div class="body-title mb-10">Ketebalan Bahan <span class="tf-color-1">*</span></div>
                            <input type="text" name="ketebalan_bahan" class="mb-10" placeholder="Contoh: 24s, 30s, 40s"
                                required>
                            <div class="text-tiny">Semakin besar angka “s”, semakin tipis bahan kaos.</div>
                        </fieldset>

                        <fieldset class="name">
                            <div class="body-title mb-10">Bahan Sablon <span class="tf-color-1">*</span></div>
                            <input type="text" name="bahan_sablon" class="mb-10"
                                placeholder="Contoh: Rubber, Plastisol, Polyflex" required>
                            <div class="text-tiny">Masukkan jenis bahan sablon yang bisa dipilih customer.</div>
                        </fieldset>

                        <fieldset class="name">
                            <div class="body-title mb-10">Warna <span class="tf-color-1">*</span></div>
                            <input type="text" name="warna" class="mb-10"
                                placeholder="Contoh: Putih, Hitam, Navy, Merah" required>
                            <div class="text-tiny">Masukkan daftar warna yang tersedia untuk produk ini.</div>
                        </fieldset>

                        <fieldset class="name">
                            <div class="body-title mb-10">Harga Tambahan (Opsional)</div>
                            <input type="number" name="harga_tambahan" class="mb-10"
                                placeholder="Masukkan tambahan harga (jika ada)">
                            <div class="text-tiny">Contoh: bahan premium dikenai tambahan Rp10.000.</div>
                        </fieldset>
                        <fieldset>
                            <div class="body-title mb-10"></div>
                            <button class="tf-button w-full" type="submit">Simpan Kostumisasi</button>
                        </fieldset>
                    </div>

                    {{-- <div class="cols gap10 mt-4">
                        <button class="tf-button w-full" type="submit">Simpan Kostumisasi</button>
                    </div> --}}
                </form>

                {{-- Table daftar kastemisasi --}}
                <div class="mt-5">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Jenis Bahan</th>
                                <th>Ukuran</th>
                                <th>Ketebalan Bahan</th>
                                <th>Bahan Sablon</th>
                                <th>Warna</th>
                                <th>Harga Tambahan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->product->nama_produk ?? '-' }}</td>
                                    <td>{{ $product->jenis_bahan }}</td>
                                    <td>{{ $product->ukuran }}</td>
                                    <td>{{ $product->ketebalan_bahan }}</td>
                                    <td>{{ $product->bahan_sablon }}</td>
                                    <td>{{ $product->warna }}</td>
                                    <td>Rp {{ number_format($product->harga_tambahan, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('products.kastemisasi.edit', $product->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('products.kastemisasi.destroy', $product->id) }}"
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
