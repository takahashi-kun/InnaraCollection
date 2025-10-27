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
</style>
<div class="main-content">

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>All Products</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="index.html">
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
                <a class="tf-button style-1 w208" href="{{ route('admin.product.create') }}"><i class="icon-plus"></i>Add new</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $productAsli )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $productAsli->nama_produk }}</td>
                            <td>{{ $productAsli->deskripsi }}</td>
                            <td>{{ $productAsli->harga }}</td>
                            <td>{{ $productAsli->stok }}</td>
                            <td>
                                @if ($productAsli->gambar)
                                    <img src="{{ asset('storage/' . $productAsli->gambar) }}" alt="{{ $productAsli->nama_produk }}" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                             <td>
                                <a href="{{ route('admin.product.edit', $productAsli->id_produk ) }}" class="btn btn-primary btn-XL">Edit</a>

                                <form action="{{ route('admin.product.destroy', $productAsli->id_produk ) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-XL" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
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
    <div class="body-text">Copyright © 2024 SurfsideMedia</div>
</div>
</div>
@endsection
@section('script')
    <script src="{{ asset('build/admin/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('build/admin/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('build/admin/assets/js/bootstrap-select.min.js')}}"></script>   
    <script src="{{ asset('build/admin/assets/js/apexcharts/apexcharts.js')}}"></script>
    <script src="{{ asset('build/admin/assets/js/main.js')}}"></script>
@endsection