@extends('user.layouts.accounts')
@section('title', 'Order Detail')
@section('page_title', 'Order Details')
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

        .bg-success {
            background-color: #40c710 !important;
        }

        .bg-danger {
            background-color: #f44032 !important;
        }

        .bg-warning {
            background-color: #f5d700 !important;
            color: #000;
        }

        .bg-info {
            background-color: #3ba7f0 !important;
        }
    </style>
@endsection


@section('content')
    <div class="wg-box mt-5 mb-5">
        <div class="row">
            <div class="col-6">
                <h5>Order Details</h5>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-transaction">
                <tbody>
                    <tr>
                        <th>Invoice</th>
                        <td>{{ $order->invoice_number }}</td>

                        <th>Mobile</th>
                        <td>{{ $order->address->no_tlp ?? '-' }}</td>

                        <th>Postal Code</th>
                        <td>{{ $order->address->postal_code ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Order Date</th>
                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>

                        <th>Delivered Date</th>
                        <td>{{ $order->delivered_at ? $order->delivered_at->format('Y-m-d') : '-' }}</td>

                        <th>Canceled Date</th>
                        <td>{{ $order->canceled_at ? $order->canceled_at->format('Y-m-d') : '-' }}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td colspan="5">
                            @php
                                $statusClass =
                                    [
                                        'pending' => 'bg-warning',
                                        'paid' => 'bg-info',
                                        'processing' => 'bg-info',
                                        'delivered' => 'bg-success',
                                        'cancelled' => 'bg-danger',
                                    ][$order->status] ?? 'bg-warning';
                            @endphp

                            <span class="badge {{ $statusClass }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



    {{-- =============================
        ORDER ITEMS
============================= --}}
    <div class="wg-box wg-table table-all-user">
        <div class="row">
            <div class="col-6">
                <h5>Ordered Items</h5>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">SKU</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Brand</th>
                        <th class="text-center">Options</th>
                        <th class="text-center">Return Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="text-center">{{ $order->id }}</td>
                            <td class="text-center">{{ $order->user->name }}</td>
                            <td class="text-center">{{ $order->user->no_tlp ?? '-' }}</td>

                            <td class="text-center">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                            <td class="text-center">Rp {{ number_format($order->tax, 0, ',', '.') }}</td>
                            <td class="text-center">Rp {{ number_format($order->total, 0, ',', '.') }}</td>

                            <td class="text-center">
                                @if ($order->status == 'ordered')
                                    <span class="badge bg-warning">Ordered</span>
                                @elseif ($order->status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @elseif ($order->status == 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>

                            <td class="text-center">{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="text-center">{{ $order->items->sum('qty') }}</td>
                            <td></td>

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
                            <td colspan="11" class="text-center">Belum ada order.</td>
                        </tr>
                    @endforelse
                </tbody>


            </table>
        </div>
    </div>



    {{-- =============================
      SHIPPING ADDRESS
============================= --}}
    <div class="wg-box mt-5">
        <h5>Shipping Address</h5>

        <div class="my-account__address-item col-md-6">
            <div class="my-account__address-item__detail">

                <p>{{ $order->address->nama_penerima ?? '-' }}</p>
                <p>{{ $order->address->alamat_lengkap ?? '-' }}</p>

                <p>{{ $order->address->province_name }}, {{ $order->address->city_name }}</p>

                <p>{{ $order->address->subdistrict_name }}</p>

                <p>{{ $order->address->postal_code }}</p>

                <br>
                <p><strong>Mobile :</strong> {{ $order->address->no_tlp }}</p>

            </div>
        </div>
    </div>



    {{-- =============================
      TRANSACTIONS SUMMARY
============================= --}}
    <div class="wg-box mt-5">
        <h5>Transactions</h5>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-transaction">
                <tbody>
                    <tr>
                        <th>Subtotal</th>
                        <td>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>

                        <th>Shipping</th>
                        <td>Rp {{ number_format($order->shipping, 0, ',', '.') }}</td>

                        <th>Discount</th>
                        <td>Rp {{ number_format($order->discount ?? 0, 0, ',', '.') }}</td>
                    </tr>

                    <tr>
                        <th>Total</th>
                        <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>

                        <th>Payment Method</th>
                        <td>{{ strtoupper($order->payment_method) }}</td>

                        <th>Status</th>
                        <td>
                            <span class="badge {{ $statusClass }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('build/assets/admin/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/plugins/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/plugins/countdown.js') }}"></script>
    <script src="{{ asset('build/assets/admin/js/theme.js') }}"></script>
@endsection
