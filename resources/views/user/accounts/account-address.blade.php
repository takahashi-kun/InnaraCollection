@extends('user.layouts.accounts')
@section('title', 'Address')
@section('page_title', 'Addresses')
@section('content')
<div class="page-content my-account__address">
    <div class="row mb-3">
        <div class="col-6">
            <p class="notice">The following addresses will be used on the checkout page by default.</p>
        </div>
        <div class="col-6 text-right">
            <a href="{{ route('account-add-address') }}" class="btn btn-sm btn-info">Tambah Alamat Baru</a>
        </div>
    </div>

    <div class="my-account__address-list row">
        <h5>Shipping Address</h5>

        @forelse($addresses as $address)
            <div class="my-account__address-item col-md-6 mb-4">
                <div class="my-account__address-item__title d-flex justify-content-between align-items-center">
                    <h5>{{ $address->nama_penerima }} <i class="fa fa-check-circle text-success"></i></h5>
                    <a href="#">Edit</a>
                </div>

                <div class="my-account__address-item__detail">
                    <p>{{ $address->alamat_lengkap }}</p>
                    <p>
                        {{ $address->subdistrict->name ?? '-' }},
                        {{ $address->city->name ?? '-' }},
                        {{ $address->province->name ?? '-' }}
                    </p>
                    <p>Nama Alamat: {{ $address->nama_alamat }}</p>
                    <p>No Telepon: {{ $address->no_tlp }}</p>
                </div>
            </div>
            <hr class="w-100">
        @empty
            <div class="col-12">
                <p class="text-muted">Belum ada alamat yang ditambahkan.</p>
            </div>
        @endforelse
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