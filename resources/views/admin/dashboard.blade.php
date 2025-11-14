@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <style>
        .main-content {
            width: 100%;
            margin: 0;
            padding: 0;
            background-color: #f8fbff;
        }

        .main-content-inner,
        .main-content-wrap {
            width: 100%;
            max-width: 100%;
            padding: 0;
            margin: 0;
        }

        .dashboard-container {
            width: 100%;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        /* ====== SAMBUTAN ====== */
        .welcome-box {
            width: 100%;
            background: linear-gradient(90deg, #4e73df, #1cc88a);
            color: #fff;
            border-radius: 10px;
            padding: 25px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .welcome-box h3 {
            margin: 0;
            font-weight: 600;
            font-size: 3.25rem;
        }

        .dashp {
            font-size: 2rem;
            color: #fff;
        }

        .welcome-icon i {
            font-size: 45px;
            opacity: 0.9;
        }

        /* ====== CARD PESANAN ====== */
        .wg-chart-default {
            background: #fff;
            border-radius: 10px;
            padding: 20px 25px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            width: 100%;
        }

        .body-text {
            font-size: 14px;
            color: #555;
        }

        .body-text {
            font-weight: 600;
            font-size: 15px;
        }

        .p-15 {
            font-weight: 600;
            font-size: 15px;
        }

        .ic-bg {
            background: #f3f4f6;
            border-radius: 8px;
            padding: 10px;
        }

        .icon-shopping-bag {
            font-size: 22px;
            color: #4e73df;
        }

        h4 {
            font-size: initial;
        }

        /* ====== FOOTER ====== */
        .bottom-page {
            text-align: center;
            padding: 15px;
            background: #f8f9fc;
            color: #555;
            font-size: 14px;
            border-top: 1px solid #eee;
            margin-top: 40px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .welcome-box {
                flex-direction: column;
                align-items: flex-start;
            }

            .welcome-icon {
                margin-top: 15px;
            }
        }
    </style>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">

                <!-- 🔹 Full Width Container -->
                <div class="container-fluid dashboard-container">

                    <!-- 🔹 Sambutan -->
                    <div class="welcome-box">
                        <div>
                            <h3>Selamat Datang, <span class="fw-bold">{{ auth()->user()->name }}</span> 👋</h3>
                            <p class="dashp">Senang bertemu kembali! Semoga harimu menyenangkan dan penuh produktivitas.</p>
                        </div>
                        <div class="welcome-icon">
                            <i class="icon-user"></i>
                        </div>
                    </div>

                    <!-- 🔹 Statistik (menggunakan grid bootstrap biar rapi & full kanan) -->
                    <div class="row g-3 mb-4">

                        <!-- Total Pesanan -->
                        <div class="col-md-6 col-lg-3">
                            <div class="wg-chart-default">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="ic-bg">
                                        <i class="icon-shopping-bag" style="font-size: 32px;"></i>
                                    </div>
                                    <div>
                                        <div class="body-text">Total Pesanan</div>
                                        <h4>{{ $totalOrders }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pesanan Tertunda -->
                        <div class="col-md-6 col-lg-3">
                            <div class="wg-chart-default">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="ic-bg">
                                        <i class="icon-clock" style="font-size: 32px;"></i>
                                    </div>
                                    <div>
                                        <div class="body-text">Pesanan Tertunda</div>
                                        <h4>{{ $pendingOrders }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pesanan Terkirim -->
                        <div class="col-md-6 col-lg-3">
                            <div class="wg-chart-default">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="ic-bg">
                                        <i class="icon-truck" style="font-size: 32px;"></i>
                                    </div>
                                    <div>
                                        <div class="body-text">Pesanan Terkirim</div>
                                        <h4>{{ $deliveredOrders }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pesanan Dibatalkan -->
                        <div class="col-md-6 col-lg-3">
                            <div class="wg-chart-default">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="ic-bg">
                                        <i class="icon-x" style="font-size: 32px;"></i>
                                    </div>
                                    <div>
                                        <div class="body-text">Pesanan Dibatalkan</div>
                                        <h4>{{ $cancelledOrders }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="tf-section mb-30" style="margin-top: 20px">
                        <div class="wg-box">
                            <div class="flex items-center justify-between">
                                <h5 class="p-15">Recent Orders</h5>
                                <div class="dropdown default">
                                    <a class="btn btn-secondary dropdown-toggle" href="#">
                                        <span class="view-all">View all</span>
                                    </a>
                                </div>
                            </div>
                            <div class="wg-table table-all-user">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>OrderNo</th>
                                                <th>Name</th>
                                                <th class="text-center">Phone</th>
                                                <th class="text-center">Subtotal</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Order Date</th>
                                                <th class="text-center">Total Items</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($recentOrders as $order)
                                                <tr>
                                                    <td class="text-center">{{ $order->id }}</td>
                                                    <td class="text-center">{{ $order->user->name }}</td>
                                                    <td class="text-center">{{ $order->user->no_tlp }}</td>
                                                    <td class="text-center">Rp{{ number_format($order->subtotal) }}</td>
                                                    <td class="text-center">Rp{{ number_format($order->total) }}</td>

                                                    <td class="text-center">{{ $order->status }}</td>
                                                    <td class="text-center">{{ $order->created_at }}</td>
                                                    <td class="text-center">{{ $order->items->sum('qty') }}</td>

                                                    <td class="text-center">
                                                        <a href="{{ route('admin.order.show', $order->id) }}">
                                                            <div class="list-icon-function view-icon">
                                                                <div class="item eye">
                                                                    <i class="icon-eye"></i>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="11" class="text-center">Tidak ada order pending.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bottom-page">
                    Copyright © 2025 Innara Collection
                </div>

            </div>
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
