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

                <form class="tf-section-2 form-add-product" style="grid-template-columns: 1fr;" method="POST"
                    action="{{ route('admin.product.kastemisasi.store') }}">
                    @csrf

                    <div class="wg-box" style="font-size: initial">

                        <fieldset class="id_produk">
                            <div class="body-title mb-10">Pilih Produk <span class="tf-color-1">*</span></div>
                            <select name="id_produk" class="mb-10" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach ($products as $p)
                                    <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}</option>
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
                            <div class="text-tiny">Pilih ukuran yang tersedia.</div>
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
                            <div class="text-tiny">Pilih jenis sablon yang bisa dipilih customer.</div>
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
                            <div class="text-tiny">Pilih warna yang tersedia untuk produk ini.</div>
                        </fieldset>

                        <fieldset>
                            <div class="body-title mb-10"></div>
                            <button class="tf-button w-full" type="submit">Simpan Varian Kastemisasi</button>
                        </fieldset>
                    </div>
                </form>

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
