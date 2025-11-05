@extends('layouts.admin')
@section('title', 'Jasa')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="flex items-center justify-between mb-6">
                <h3 style="font-size: 2rem; font-weight: bold;">Daftar Jasa</h3>
                <ul class="breadcrumbs flex items-center gap-2" style="font-size: large">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>Jasa</li>
                </ul>
            </div>

            @if (session('success'))
                <div class="alert alert-success mb-3" style="font-size: large">{{ session('success') }}</div>
            @endif

            {{-- BAGIAN FORM EDIT (Hanya muncul jika $editJasa ada) --}}
            @if (isset($editJasa))
                <div class="wg-box">
                    {{-- Gunakan $editJasa di sini --}}
                    <form method="POST" action="{{ route('admin.jasa.update', $editJasa->id_jasa) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label class="form-label" style="font-size: large">Nama Jasa</label>
                            {{-- Menggunakan $editJasa --}}
                            <input type="text" class="form-control" value="{{ $editJasa->nama_jasa }}" disabled>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label" style="font-size: large">Harga Jasa</label>
                            {{-- Menggunakan $editJasa --}}
                            <input type="number" name="harga_jasa" class="form-control" value="{{ $editJasa->harga_jasa }}"
                                required>
                            {{-- Menggunakan $editJasa --}}
                            <small class="text-muted" style="font-size: large">Masukkan harga baru untuk
                                {{ strtolower($editJasa->nama_jasa) }}</small>
                        </div>

                        <button type="submit" class="btn btn-success w-full" style="font-size: x-large">Update
                            Harga</button>
                    </form>
                </div>
            @endif
            {{-- AKHIR BAGIAN FORM EDIT --}}


            {{-- BAGIAN TABEL DAFTAR JASA (Menggunakan $daftarJasa) --}}
            <div class="wg-box">
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
                            {{-- Pastikan $daftarJasa tersedia dan dapat di-loop. 
                             Jika route edit diakses, $daftarJasa tidak ada, jadi inisialisasi sebagai array kosong agar tidak error.
                        --}}
                            @php
                                $daftarJasa = $daftarJasa ?? [];
                            @endphp

                            @foreach ($daftarJasa as $item)
                                <tr>
                                    <td>{{ $item->id_jasa }}</td>
                                    <td>{{ $item->nama_jasa }}</td>
                                    <td>Rp {{ number_format($item->harga_jasa, 0, ',', '.') }}</td>
                                    <td>
                                        {{-- Menggunakan $item (dari $daftarJasa) --}}
                                        <a href="{{ route('admin.jasa.edit', $item->id_jasa) }}"
                                            class="btn col-md-2 btn-primary btn-xl" style="font-size: large">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="wg-box mt-8" style="font-size: 2rem; font-weight: bold;">
                <div class="flex items-center justify-between">
                    <h4 class="mb-0">💰 Total Harga Seluruh Jasa</h4>
                    <h3 class="mb-0 text-primary">
                        Rp {{ number_format($totalHargaJasa ?? 0, 0, ',', '.') }}
                    </h3>
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
