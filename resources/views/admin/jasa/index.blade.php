@extends('layouts.admin')
@section('title', 'Jasa')
@section('content')
    <div class="main-content">
        <style>
            .table-transaction>tbody>tr:nth-of-type(odd) {
                --bs-table-accent-bg: #fff !important;
            }
        </style>
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Jasa</h3>
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
                            <div class="text-tiny">Jasa</div>
                        </li>
                    </ul>
                </div>

                <div class="wg-box">
                    <div class="card-form">
                        <div class="card-title">Edit Jasa</div>
                        <form class="tf-section-2 form-add-product" style="grid-template-columns: 1fr;" method="POST"
                            action="{{ route('admin.jasa.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="wg-box">
                                @foreach ($jasa as $item)
                                    <fieldset class="name">
                                        <div class="body-title mb-10">{{ $item->nama_jasa }} <span class="tf-color-1">*</span></div>
                                        <input type="hidden" name="id_jasa[]" value="{{ $item->id_jasa }}">
                                        <input type="number" name="harga_jasa[]" class="mb-10"
                                            placeholder="Harga {{ $item->nama_jasa }}" value="{{ $item->harga_jasa }}" required>
                                        <div class="text-tiny">Masukkan harga untuk {{ strtolower($item->nama_jasa) }}.</div>
                                    </fieldset>
                                @endforeach
                            </div>
                            <div class="button-submit">
                                <button class="tf-button w-full" type="submit">Update Harga Jasa</button>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID Jasa</th>
                                    <th>Nama Jasa</th>
                                    <th>Harga Jasa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jasa as $item)
                                    <tr>
                                        <td>{{ $item->id_jasa }}</td>
                                        <td>{{ $item->nama_jasa }}</td>
                                        <td>Rp {{ number_format($item->harga_jasa, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('admin.jasa.edit', $item->id_jasa) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('admin.jasa.destroy', $item->id_jasa) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus jasa ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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