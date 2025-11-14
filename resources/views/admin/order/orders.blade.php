@extends('layouts.admin')
@section('title', 'Orders')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3 style="font-size: 2rem; font-weight: bold;">Orders</h3>
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
                            <div class="text-tiny">Orders</div>
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
                    </div>
                    <div class="wg-table table-all-user">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:70px">OrderNo</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Order Date</th>
                                        <th class="text-center">Total Items</th>
                                        <th class="text-center">Delivered On</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center">{{ $order->id }}</td>
                                            <td class="text-center">{{ $order->user->name }}</td>
                                            <td class="text-center">{{ $order->user->no_tlp }}</td>
                                            <td class="text-center">Rp{{ number_format($order->subtotal) }}</td>
                                            <td class="text-center">Rp{{ number_format($order->total) }}</td>

                                            <td class="text-center">
                                                <span class="badge bg-info" style="font-size: 16px">{{ $order->status }}</span>
                                            </td>

                                            <td class="text-center">{{ $order->created_at }}</td>
                                            <td class="text-center">{{ $order->items->sum('qty') }}</td>
                                            <td class="text-center">{{ $order->delivered_at ?? '-' }}</td>

                                            <td class="text-center flex flex-col gap-2">

                                                {{-- VIEW --}}
                                                <a href="{{ route('admin.order.show', $order->id) }}"
                                                    class="btn btn-XL btn-primary" style="font-size: 16px">
                                                    <i class="icon-eye"></i> View
                                                </a>

                                                {{-- VERIFIKASI hanya jika pending --}}
                                                @if ($order->status == 'pending')
                                                    <form method="POST"
                                                        action="{{ route('admin.order.verify', $order->id) }}">
                                                        @csrf
                                                        <button class="btn btn-XL btn-success" style="font-size: 16px">Verify</button>
                                                    </form>
                                                @endif

                                                {{-- UPDATE STATUS --}}
                                                <form method="POST"
                                                    action="{{ route('admin.order.updateStatus', $order->id) }}">
                                                    @csrf
                                                    <select name="status" class="form-control form-select-XL" style="font-size: 16px"
                                                        onchange="this.form.submit()">
                                                        <option value="pending"
                                                            {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>
                                                            Paid</option>
                                                        <option value="processing"
                                                            {{ $order->status == 'processing' ? 'selected' : '' }}>Processing
                                                        </option>
                                                        <option value="delivered"
                                                            {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered
                                                        </option>
                                                        <option value="cancelled"
                                                            {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                                        </option>
                                                    </select>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                    </div>
                </div>
            </div>
        </div>


        <div class="bottom-page">
            <div class="body-text">Copyright © 2025 Innara Collection</div>
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
