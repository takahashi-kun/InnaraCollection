@extends('user.layouts.accounts')
@section('title', 'Orders')
@section('style')
    <style>
        .table> :not(caption)>tr>th {
            padding: 0.625rem 1.5rem .625rem !important;
            background-color: #6a6e51 !important;
        }

        .table>tr>td {
            padding: 0.625rem 1.5rem .625rem !important;
        }

        .table-bordered> :not(caption)>tr>th,
        .table-bordered> :not(caption)>tr>td {
            border-width: 1px 1px;
            border-color: #6a6e51;
        }

        .table> :not(caption)>tr>td {
            padding: .8rem 1rem !important;
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
    </style>
@endsection
@section('content')
    <div class="col-lg-10">
        <div class="wg-table table-all-user">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 80px">OrderNo</th>
                            <th>Name</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Subtotal</th>
                            <th class="text-center">Tax</th>
                            <th class="text-center">Total</th>

                            <th class="text-center">Status</th>
                            <th class="text-center">Order Date</th>
                            <th class="text-center">Items</th>
                            <th class="text-center">Delivered On</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">10001</td>
                            <td class="text-center">Sudhir Kumar</td>
                            <td class="text-center">1234567891</td>
                            <td class="text-center">$172.00</td>
                            <td class="text-center">$36.12</td>
                            <td class="text-center">$208.12</td>

                            <td class="text-center">
                                <span class="badge bg-danger">Canceled</span>
                            </td>
                            <td class="text-center">2024-07-11 00:54:14</td>
                            <td class="text-center">2</td>
                            <td>2024-07-07</td>
                            <td class="text-center">
                                <a href="{{ route('account-order-detail') }}">
                                    <div class="list-icon-function view-icon">
                                        <div class="item eye">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">10003</td>
                            <td class="text-center">Sudhir Kumar</td>
                            <td class="text-center">1234567891</td>
                            <td class="text-center">$154.80</td>
                            <td class="text-center">$32.51</td>
                            <td class="text-center">$187.31</td>

                            <td class="text-center">
                                <span class="badge bg-warning">Ordered</span>
                            </td>
                            <td class="text-center">2024-06-17 10:41:09</td>
                            <td class="text-center">2</td>
                            <td></td>
                            <td class="text-center">
                                <a href="{{ route('account-order-detail') }}">
                                    <div class="list-icon-function view-icon">
                                        <div class="item eye">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">10002</td>
                            <td class="text-center">Sudhir Kumar</td>
                            <td class="text-center">1234567891</td>
                            <td class="text-center">$71.00</td>
                            <td class="text-center">$14.91</td>
                            <td class="text-center">$85.91</td>

                            <td class="text-center">
                                <span class="badge bg-warning">Ordered</span>
                            </td>
                            <td class="text-center">2024-06-11 01:02:55</td>
                            <td class="text-center">1</td>
                            <td></td>
                            <td class="text-center">
                                <a href="{{ route('account-order-detail') }}">
                                    <div class="list-icon-function view-icon">
                                        <div class="item eye">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </div>
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

        </div>
    </div>
@endsection
