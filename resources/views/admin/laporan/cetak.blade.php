
@extends('layouts.admin')
@section('title', 'Cetak Laporan Produk')
@section('content')
<div class="main-content">

    <style>
        /* Card fills available vertical space */
        .report-card {
            padding: 24px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 6px 18px rgba(14, 30, 37, 0.06);
            min-height: calc(100vh - 220px);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .report-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .report-title {
            font-size: 20px;
            font-weight: 600;
        }

        .report-actions .btn {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
        }

        .btn-print { background: #2d8cf0; }
        .btn-export { background: #34c38f; }

        .table-report {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            flex: 1 1 auto;
            overflow: auto;
        }

        .table-report th, .table-report td {
            border: 1px solid #e8eaf0;
            padding: 10px 12px;
            text-align: left;
            vertical-align: middle;
            font-size: 14px;
        }

        .table-report thead th {
            background: #fafbff;
            font-weight: 600;
        }

        .img-thumb {
            width: 80px;
            height: auto;
            object-fit: cover;
            border-radius: 4px;
        }

        /* Print rules */
        @media print {
            body * { visibility: hidden; }
            .report-card, .report-card * { visibility: visible; }
            .report-card { position: absolute; left: 0; top: 0; width: 100%; box-shadow: none; }
            .report-actions { display: none; }
        }
    </style>

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-20">
                <div>
                    <h3>Cetak Laporan Produk</h3>
                    <div class="text-tiny">Export atau cetak data produk Innara Collection</div>
                </div>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li><a href="{{ route('admin.dashboard') }}"><div class="text-tiny">Dashboard</div></a></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><div class="text-tiny">Laporan</div></li>
                </ul>
            </div>

            <div class="report-card">
                <div class="report-header">
                    <div class="report-title">Daftar Produk</div>
                    <div class="report-actions">
                        <a href="#" class="btn btn-print" onclick="window.print(); return false;">Cetak</a>
                        {{-- <a href="{{ route('') }}?export=csv" class="btn btn-export">Export CSV</a> --}}
                    </div>
                </div>

                <div style="overflow:auto;">
                    <table class="table-report">
                        <thead>
                            <tr>
                                <th style="width:60px">No</th>
                                <th>Nama Produk</th>
                                <th>Deskripsi</th>
                                <th style="width:110px">Harga</th>
                                <th style="width:90px">Stok</th>
                                <th style="width:120px">Gambar</th>
                                <th style="width:150px">Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productOriginal ?? [] as $idx => $p)
                                <tr>
                                    <td>{{ $idx + 1 }}</td>
                                    <td>{{ $p->nama_produk }}</td>
                                    <td style="max-width:420px; white-space:pre-wrap;">{{ Str::limit($p->deskripsi ?? '-', 240) }}</td>
                                    <td>Rp {{ number_format($p->harga ?? 0, 0, ',', '.') }}</td>
                                    <td>{{ $p->stok ?? 0 }}</td>
                                    <td>
                                        @if(!empty($p->gambar))
                                            <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->nama_produk }}" class="img-thumb">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $p->created_at?->format('d M Y H:i') ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data produk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div style="display:flex; justify-content:flex-end; gap:12px; margin-top:8px;">
                    <div class="text-tiny">Generated: {{ now()->format('d M Y H:i') }}</div>
                </div>
            </div>

        </div>
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