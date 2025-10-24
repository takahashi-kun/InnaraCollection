@extends('layouts.admin')
@section('title', 'Add New Product')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Add New Product</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li>
                            <div class="text-tiny">Add Product</div>
                        </li>
                    </ul>
                </div>
                <form class="tf-section-2 form-add-product" style="grid-template-columns: 1fr;" method="POST" action="{{ route('admin.product.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="wg-box">
                        <fieldset class="name">
                            <div class="body-title mb-10">Product Name <span class="tf-color-1">*</span></div>
                            <input type="text" name="nama_produk" class="mb-10" placeholder="Product Name" required>
                            <div class="text-tiny">Enter the name of the product.</div>
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
                            <textarea name="deskripsi" class="mb-10" placeholder="Product Description" required></textarea>
                            <div class="text-tiny">Provide a detailed description of the product.</div>
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Price <span class="tf-color-1">*</span></div>
                            <input type="number" name="harga" class="mb-10" placeholder="Price" required>
                            <div class="text-tiny">Set the regular price of the product.</div>
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Stok <span class="tf-color-1">*</span></div>
                            <input type="number" name="stok" class="mb-10" placeholder="Stok Barang" min="0" required>
                            <div class="text-tiny">Masukkan Stok Barang.</div>
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Product Image <span class="tf-color-1">*</span></div>
                            <input type="file" name="gambar" class="mb-10" accept="image/*" required>
                            <div class="text-tiny">Upload a high-quality image of the product.</div>
                        </fieldset>
                    </div>
                    <div class="button-submit">
                        <button class="tf-button w-full" type="submit">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="bottom-page">
            <div class="body-text">Copyright © 2024 SurfsideMedia</div>
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
