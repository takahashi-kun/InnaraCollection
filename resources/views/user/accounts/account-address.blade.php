@extends('user.layouts.accounts')
@section('title', 'Address')
@section('page_title', 'Addresses')
@section('content')
    <div class="page-content my-account__address">
        <div class="row">
            <div class="col-6">
                <p class="notice">The following addresses will be used on the checkout page by default.</p>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('account-add-address') }}" class="btn btn-sm btn-info">Add New</a>
            </div>
        </div>
        <div class="my-account__address-list row">
            <h5>Shipping Address</h5>

            <div class="my-account__address-item col-md-6">
                <div class="my-account__address-item__title">
                    <h5>Sudhir Kumar <i class="fa fa-check-circle text-success"></i></h5>
                    <a href="#">Edit</a>
                </div>
                <div class="my-account__address-item__detail">
                    <p>Flat No - 13, R. K. Wing - B</p>
                    <p>ABC, DEF</p>
                    <p>GHJ, </p>
                    <p>Near Sun Temple</p>
                    <p>000000</p>
                    <br>
                    <p>Mobile : 1234567891</p>
                </div>
            </div>
            <hr>
        </div>
    </div>
    
@endsection

@section('script')
    <script src="{{ asset('build/assets/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/countdown.js') }}"></script>
    <script src="{{ asset('build/assets/js/theme.js') }}"></script>
@endsection