@extends('user.layouts.accounts')
@section('title', 'Orders')
@section('page_title', 'Orders')
@section('style')
<style>
    .table> :not(caption)>tr>th {
        padding: 0.625rem 1.5rem .625rem !important;
        background-color: #6a6e51 !important;
        color: #fff;
    }
    .table> :not(caption)>tr>td {
        padding: .8rem 1rem !important;
    }
    .table-bordered> :not(caption)>tr>th,
    .table-bordered> :not(caption)>tr>td {
        border-width: 1px 1px;
        border-color: #6a6e51;
    }
    .bg-success { background-color: #40c710 !important; }
    .bg-danger { background-color: #f44032 !important; }
    .bg-warning { background-color: #f5d700 !important; color: #000; }
    .bg-info { background-color: #3ba7f0 !important; }
</style>
@endsection

@section('content')

<div class="wg-table table-all-user">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="width: 10%">Invoice</th>
                    <th>Total</th>
                    <th>Shipping</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Qty</th>
                    <th style="width: 5%">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($orders as $order)
                    @php
                        // Hitung total qty pada order
                        $qty = $order->items->sum('qty');

                        // Badge warna status
                        $statusClass = [
                            'pending' => 'bg-warning',
                            'paid' => 'bg-info',
                            'processing' => 'bg-info',
                            'delivered' => 'bg-success',
                            'cancelled' => 'bg-danger',
                        ][$order->status] ?? 'bg-warning';
                    @endphp

                    <tr>
                        <td class="text-center">{{ $order->invoice_number }}</td>

                        <td class="text-center">Rp {{ number_format($order->total,0,',','.') }}</td>

                        <td class="text-center">Rp {{ number_format($order->shipping,0,',','.') }}</td>

                        <td class="text-center">
                            <span class="badge {{ $statusClass }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>

                        <td class="text-center">{{ $order->created_at->format('Y-m-d H:i') }}</td>

                        <td class="text-center">{{ $qty }}</td>

                        <td class="text-center">
                            <a href="{{ route('account-order-detail', $order->id) }}">
                                <div class="list-icon-function view-icon">
                                    <div class="item eye">
                                        <i class="fa fa-eye"></i>
                                    </div>
                                </div>
                            </a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="8" class="text-center p-4">
                            <strong>Tidak ada pesanan.</strong>
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>
    </div>
</div>

<div class="divider"></div>

{{-- Pagination jika diperlukan --}}
@if(method_exists($orders, 'links'))
<div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
    {{ $orders->links() }}
</div>
@endif

@endsection
@section('script')
    <script src="{{ asset('build/assets/admin/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/plugins/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/plugins/countdown.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/theme.js') }}"></script>
@endsection