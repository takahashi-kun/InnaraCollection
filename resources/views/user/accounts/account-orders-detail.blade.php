@extends('user.layouts.accounts')
@section('title','Order Detail')
@section('page_title', 'Order Details')
@section('style')
  <style>
    .pt-90 {
      padding-top: 90px !important;
    }

    .pr-6px {
      padding-right: 6px;
      text-transform: uppercase;
    }

    .my-account .page-title {
      font-size: 1.5rem;
      font-weight: 700;
      text-transform: uppercase;
      margin-bottom: 40px;
      border-bottom: 1px solid;
      padding-bottom: 13px;
    }

    .my-account .wg-box {
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      padding: 24px;
      flex-direction: column;
      gap: 24px;
      border-radius: 12px;
      background: var(--White);
      box-shadow: 0px 4px 24px 2px rgba(20, 25, 38, 0.05);
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

    .table-transaction>tbody>tr:nth-of-type(odd) {
      --bs-table-accent-bg: #fff !important;

    }

    .table-transaction th,
    .table-transaction td {
      padding: 0.625rem 1.5rem .25rem !important;
      color: #000 !important;
    }

    .table> :not(caption)>tr>th {
      padding: 0.625rem 1.5rem .25rem !important;
      background-color: #6a6e51 !important;
    }

    .table-bordered>:not(caption)>*>* {
      border-width: inherit;
      line-height: 32px;
      font-size: 14px;
      border: 1px solid #e1e1e1;
      vertical-align: middle;
    }

    .table-striped .image {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 50px;
      height: 50px;
      flex-shrink: 0;
      border-radius: 10px;
      overflow: hidden;
    }

    .table-striped td:nth-child(1) {
      min-width: 250px;
      padding-bottom: 7px;
    }

    .pname {
      display: flex;
      gap: 13px;
    }

    .table-bordered> :not(caption)>tr>th,
    .table-bordered> :not(caption)>tr>td {
      border-width: 1px 1px;
      border-color: #6a6e51;
    }
  </style>
@endsection
@section('content')

    <div class="wg-box mt-5 mb-5">
        <div class="row">
            <div class="col-6">
                <h5>Ordered Details</h5>
            </div>
            {{-- <div class="col-6 text-right">
                <a class="btn btn-sm btn-danger" href="http://localhost:8000/account-orders">Back</a>
            </div> --}}
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-transaction">
                <tbody>
                    <tr>
                        <th>Order No</th>
                        <td>10001</td>
                        <th>Mobile</th>
                        <td>1234567891</td>
                        <th>Pin/Zip Code</th>
                        <td>804401</td>
                    </tr>
                    <tr>
                        <th>Order Date</th>
                        <td>2024-07-11 00:54:14</td>
                        <th>Delivered Date</th>
                        <td>2024-07-07</td>
                        <th>Canceled Date</th>
                        <td>2024-07-07</td>
                    </tr>
                    <tr>
                        <th>Order Status</th>
                        <td colspan="5">
                            <span class="badge bg-danger">Canceled</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="wg-box wg-table table-all-user">
        <div class="row">
            <div class="col-6">
                <h5>Ordered Items</h5>
            </div>
            <div class="col-6 text-right">

            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">SKU</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Brand</th>
                        <th class="text-center">Options</th>
                        <th class="text-center">Return Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                        <td class="pname">
                            <div class="image">
                                <img src="http://localhost:8000/uploads/products/thumbnails/1718066538.jpg"
                                    alt="" class="image">
                            </div>
                            <div class="name">
                                <a href="http://localhost:8000/shop/product1" target="_blank"
                                    class="body-title-2">Product1</a>
                            </div>
                        </td>
                        <td class="text-center">$71.00</td>
                        <td class="text-center">1</td>
                        <td class="text-center">SHT01245</td>
                        <td class="text-center">Category1</td>
                        <td class="text-center">Brand1</td>
                        <td class="text-center"></td>
                        <td class="text-center">No</td>
                        <td class="text-center">
                            <a href="http://localhost:8000/shop/product1" target="_blank">
                                <div class="list-icon-function view-icon">
                                    <div class="item eye">
                                        <i class="fa fa-eye"></i>
                                    </div>
                                </div>
                            </a>
                        </td>
                    </tr>
                    <tr>

                        <td class="pname">
                            <div class="image">
                                <img src="http://localhost:8000/uploads/products/thumbnails/1718066673.jpg"
                                    alt="" class="image">
                            </div>
                            <div class="name">
                                <a href="http://localhost:8000/shop/product2" target="_blank"
                                    class="body-title-2">Product2</a>
                            </div>
                        </td>
                        <td class="text-center">$101.00</td>
                        <td class="text-center">1</td>
                        <td class="text-center">SHT99890</td>
                        <td class="text-center">Category2</td>
                        <td class="text-center">Brand1</td>
                        <td class="text-center"></td>
                        <td class="text-center">No</td>
                        <td class="text-center">
                            <a href="http://localhost:8000/shop/product2" target="_blank">
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

    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination"></div>

    <div class="wg-box mt-5">
        <h5>Shipping Address</h5>
        <div class="my-account__address-item col-md-6">
            <div class="my-account__address-item__detail">
                <p>Divyansh Kumar</p>
                <p>Flat No - 13, R. K. Wing - B</p>
                <p>ABC, DEF</p>
                <p>GHT, </p>
                <p>AAA</p>
                <p>000000</p>
                <br>
                <p>Mobile : 1234567891</p>
            </div>
        </div>
    </div>

    <div class="wg-box mt-5">
        <h5>Transactions</h5>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-transaction">
                <tbody>
                    <tr>
                        <th>Subtotal</th>
                        <td>$172.00</td>
                        <th>Tax</th>
                        <td>$36.12</td>
                        <th>Discount</th>
                        <td>$0.00</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>$208.12</td>
                        <th>Payment Mode</th>
                        <td>cod</td>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-success">Approved</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="wg-box mt-5 text-right">
        <form action="{{ route('account-orders') }}" method="POST">
            @csrf
            <input type="hidden" name="_token" value="3v611ELheIo6fqsgspMOk0eiSZjncEeubOwUa6YT" autocomplete="off">
            <input type="hidden" name="_method" value="PUT"> <input type="hidden" name="order_id" value="1">
            <button type="submit" class="btn btn-danger">Cancel Order</button>
        </form>
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
