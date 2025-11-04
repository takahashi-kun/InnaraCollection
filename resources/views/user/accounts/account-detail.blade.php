@extends('user.layouts.accounts')
@section('title', 'Account Detail')
@section('content')

    <div class="page-content my-account__edit">
        <div class="my-account__edit-form">
            <form name="account_edit_form" action="{{ route('user-profile-information.update') }}" method="POST"
                class="needs-validation" novalidate="">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="my-3">
                            <h5 class="text-uppercase mb-0">Information</h5>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating my-3">
                            {{-- <input type="text" class="form-control" placeholder="Nama Lengkap" name="name"
                                    value="" required>
                                <label for="name">Nama</label> --}}
                            <input class="form-control form-control_gray " name="name" required="" autocomplete="name"
                                autofocus="">
                            <label for="name">Name *</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating my-3">
                            {{-- <input type="text" class="form-control" placeholder="Nomor Telepon" name="no_tlp"
                                value="" required="">
                            <label for="no_tlp">Nomor Telepon</label> --}}
                            <input id="no_tlp" type="text" class="form-control form-control_gray " name="no_tlp"
                                required="" autocomplete="no_tlp">
                            <label for="no_tlp">No Telephon *</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating my-3">
                            {{-- <input type="email" class="form-control" placeholder="Email " name="Email" value=""
                                required="">
                            <label for="Email">Email</label> --}}
                            <input id="email" type="email" class="form-control form-control_gray " name="email"
                                required="" autocomplete="email">
                            <label for="email">Email address *</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="my-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
            <form name="account_edit_form" action="{{ route('user-password.update') }}" method="POST"
                class="needs-validation" novalidate="">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="my-3">
                            <h5 class="text-uppercase mb-0">Ubah Password</h5>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating my-3">
                            <input type="password" class="form-control" id="current_password" name="current_password"
                                placeholder="Password Lama" required="">
                            <label for="current_password">Password Lama</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating my-3">
                            <input id="newPassword" type="password" class="form-control form-control_gray" name="password"
                                required autocomplete="new-password">
                            <label for="password">Password Baru</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating my-3">
                            <input id="confirmPassword" type="password" class="form-control form-control_gray"
                                name="password_confirmation" required autocomplete="new-password">
                            <label for="password_confirmation">Confirm Password Baru</label>
                            <div class="invalid-feedback">Passwords Tidak Sama!</div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="my-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    </section>

@endsection

@section('script')
    <script src="{{ asset('build/assets/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugins/countdown.js') }}"></script>
    <script src="{{ asset('build/assets/js/theme.js') }}"></script>
@endsection
