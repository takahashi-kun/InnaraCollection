@extends('layouts.admin')
@section('title', 'Settings')
@section('content')
    <div class="main-content">

        <style>
            .text-danger {
                font-size: initial;
                line-height: 36px;
            }

            .alert {
                font-size: initial;
            }

            .form-control_gray {
                min-height: 50px !important;
                padding: 0.5rem 1rem !important;
                font-size: 1.1rem !important;
            }

            .wg-box {
                font-size: initial;
            }

            .head {
                font-size: 2rem;
                font-weight: bold;
            }

            .form-control {
                font-size: 1.7rem !important;
            }
        </style>

        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3 class="head">Settings</h3>
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
                            <div class="text-tiny">Settings</div>
                        </li>
                    </ul>

                </div>

                <div class="wg-box">
                    <div class="col-lg-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="page-content my-account__edit">
                            <div class="my-account__edit-form">
                                <form name="account_edit_form" action="{{ route('user-profile-information.update') }}"
                                    method="POST" class="needs-validation" novalidate="">
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
                                                <input class="form-control form-control_gray " name="name" required=""
                                                    autocomplete="name" autofocus="">
                                                <label for="name">Name *</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating my-3">
                                                <input id="no_tlp" type="text" class="form-control form-control_gray "
                                                    name="no_tlp" required="" autocomplete="no_tlp">
                                                <label for="no_tlp">No Telephon *</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating my-3">
                                                <input id="email" type="email" class="form-control form-control_gray "
                                                    name="email" required="" autocomplete="email">
                                                <label for="email">Email address *</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="my-3">
                                                <button type="submit" class="btn btn-primary tf-button w208">
                                                    Save Changes
                                                </button>
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
                                                <input id="current_password" type="password"
                                                    class="form-control form-control_gray form-control-lg"
                                                    placeholder="Old password" name="current_password" aria-required="true"
                                                    required>
                                                <label for="current_password">Password Lama <span
                                                        class="tf-color-1">*</span></label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating my-3">
                                                <input id="newPassword" type="password"
                                                    class="form-control form-control_gray form-control-lg"
                                                    placeholder="New password" name="password" aria-required="true" required
                                                    autocomplete="new-password">
                                                <label for="password">Password Baru <span
                                                        class="tf-color-1">*</span></label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating my-3">
                                                <input id="confirmPassword" type="password"
                                                    class="form-control form-control_gray form-control-lg"
                                                    placeholder="Confirm new password" name="password_confirmation"
                                                    aria-required="true" required autocomplete="new-password">
                                                <label for="password_confirmation">Confirm Password Baru <span
                                                        class="tf-color-1">*</span></label>
                                                <div class="invalid-feedback">Passwords Tidak Sama!</div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="my-3">
                                                <button type="submit" class="btn btn-primary tf-button w208">
                                                    Save Changes
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
    <script src="{{ asset('build/assets/admin/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin2/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin2/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('build/assets/admin2/js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('build/assets/admin2/js/main.js') }}"></script>
@endsection
