@extends('layouts.admin')
@section('title', 'Cetak Laporan Transaksi')

@section('content')
    <div class="main-content">

        <style>
            .report-card {
                padding: 24px;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 6px 18px rgba(14, 30, 37, 0.06);
            }

            .report-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .btn-print {
                background: #2d8cf0;
                color: white;
                padding: 8px 15px;
                border-radius: 6px;
            }

            .table-report {
                width: 100%;
                border-collapse: collapse;
                margin-top: 15px;
            }

            .table-report th,
            .table-report td {
                border: 1px solid #e8e8e8;
                padding: 8px 10px;
                font-size: 14px;
            }

            .status-success {
                background: #d6e9c6;
                padding: 4px 7px;
                border-radius: 4px;
            }

            .status-pending {
                background: #fcf8e3;
                padding: 4px 7px;
                border-radius: 4px;
            }

            .status-canceled {
                background: #f2dede;
                padding: 4px 7px;
                border-radius: 4px;
            }

            @media print {
                body * {
                    visibility: hidden;
                }

                .report-card,
                .report-card * {
                    visibility: visible;
                }

                .report-card {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                }

                .filter-box,
                .btn-print {
                    display: none !important;
                }
            }
        </style>
        <style>
            .filter-section {
                background: #ffffff;
                padding: 28px;
                border-radius: 10px;
                box-shadow: 0 6px 18px rgba(14, 30, 37, 0.06);
                margin-bottom: 25px;
            }

            .filter-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 22px;
                align-items: end;
            }

            .filter-group label {
                font-weight: 600;
                font-size: 15px;
                margin-bottom: 5px;
                display: block;
            }

            .filter-group input,
            .filter-group select {
                width: 100%;
                padding: 14px 16px;
                border-radius: 8px;
                border: 1px solid #d1d5db;
                font-size: 15px;
            }

            .filter-actions {
                margin-top: 12px;
                display: flex;
                gap: 12px;
            }

            .btn-lg {
                padding: 12px 24px;
                font-size: 15px;
                border-radius: 8px;
                font-weight: 600;
                border: none;
                cursor: pointer;
            }

            .btn-primary {
                background: #3b82f6;
                color: white;
            }

            .btn-primary:hover {
                background: #2563eb;
            }

            .btn-secondary {
                background: #e5e7eb;
                color: #374151;
            }

            .btn-secondary:hover {
                background: #d1d5db;
            }

            .btn-print {
                background: #34c38f;
                color: white;
            }

            .btn-print:hover {
                background: #28a578;
            }
        </style>

        <div class="main-content-inner">

            <h2 class="text-2xl font-bold mb-4">Cetak Laporan Transaksi</h2>

            {{-- FILTER FORM --}}
            <div class="filter-section">
                {{-- <h3 class="text-xl font-bold mb-4" style="font-size: 14px">Filter Laporan Transaksi</h3> --}}

                <form action="{{ route('admin.laporan') }}" method="GET">
                    <div class="filter-grid">

                        <div class="filter-group">
                            <label>Filter Berdasarkan</label>
                            <select name="filter">
                                <option value="harian" {{ request('filter') == 'harian' ? 'selected' : '' }}>Harian</option>
                                <option value="bulanan" {{ request('filter') == 'bulanan' ? 'selected' : '' }}>Bulanan
                                </option>
                                <option value="tahunan" {{ request('filter') == 'tahunan' ? 'selected' : '' }}>Tahunan
                                </option>
                                <option value="range" {{ request('filter') == 'range' ? 'selected' : '' }}>Rentang Tanggal
                                </option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" value="{{ request('tanggal') }}">
                        </div>

                        <div class="filter-group">
                            <label>Bulan</label>
                            <select name="bulan">
                                <option value="">Pilih Bulan</option>
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="filter-group">
                            <label>Tahun</label>
                            <select name="tahun">
                                <option value="">Pilih Tahun</option>
                                @for ($y = date('Y'); $y >= 2020; $y--)
                                    <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="filter-group">
                            <label>Dari</label>
                            <input type="date" name="dari" value="{{ request('dari') }}">
                        </div>

                        <div class="filter-group">
                            <label>Sampai</label>
                            <input type="date" name="sampai" value="{{ request('sampai') }}">
                        </div>

                    </div>

                    <div class="filter-actions">
                        <button class="btn-lg btn-primary" type="submit">Terapkan</button>

                        <a href="{{ route('admin.laporan') }}" class="btn-lg btn-secondary">Reset</a>

                        <button onclick="window.print()" type="button" class="btn-lg btn-print">
                            Print
                        </button>
                    </div>
                </form>
            </div>

            {{-- REPORT CARD --}}
            <div class="report-card">

                <table class="table-report">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Invoice</th>
                            <th>Pelanggan</th>
                            <th>Status</th>
                            <th>Item</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $i => $order)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $order->invoice_number }}</td>
                                <td>{{ $order->user->name ?? '-' }}</td>
                                <td>
                                    @php
                                        $status = strtolower($order->status);
                                        $class = match ($status) {
                                            'paid', 'delivered' => 'status-success',
                                            'pending' => 'status-pending',
                                            default => 'status-canceled',
                                        };
                                    @endphp
                                    <span class="{{ $class }}">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td>
                                    <ul>
                                        @foreach ($order->items as $it)
                                            <li>{{ $it->qty }}x {{ $it->nama_produk }} – Rp
                                                {{ number_format($it->price, 0, ',', '.') }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="text-right mt-3 font-bold text-lg">
                    TOTAL PENJUALAN: Rp {{ number_format($totalSales, 0, ',', '.') }}
                </div>

            </div>
        </div>
    @endsection
