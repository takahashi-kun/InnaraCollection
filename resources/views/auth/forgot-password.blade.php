@extends('layouts.auth')
@section('title', 'Forget Password')
@section('style')
  <style>
    #header {
      padding-top: 8px;
      padding-bottom: 8px;
    }

    .logo__image {
      max-width: 220px;
    }
  </style>
@endsection
@section('content')

        <div class="tab-pane fade show active" id="tab-item-register" role="tabpanel" aria-labelledby="register-tab">
          <div class="register-form">
            <form class="form" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-3 f-email">
                    <label for="InputEmail" class="form-label form-label-email">Email</label>
                    <input type="email" name="email" class="form-control form-email @error('email') is-invalid @enderror"
                        id="InputEmail" value="{{ old('email') }}" required>
                </div>
                <button type="submit" class="btn btn-primary btn-sign-in w-100 text-uppercase">Send Reset Link</button>
                <div class="mt-3 text-center">
                    <span class="register">Remember your password? <a href="{{ route('login') }}">Login</a></span>
                </div>
            </form>
          </div>
        </div>

@endsection
@section('script')
  <script src="{{ asset ('build/assets/admin/js/plugins/jquery.min.js') }}"></script>
  <script src="{{ asset ('build/assets/admin/js/plugins/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset ('build/assets/admin/js/plugins/bootstrap-slider.min.js') }}"></script>
  <script src="{{ asset ('build/assets/admin/js/plugins/swiper.min.js') }}"></script>
  <script src="{{ asset ('build/assets/admin/js/plugins/countdown.js') }}"></script>
  <script src="{{ asset ('build/assets/admin/js/theme.js') }}"></script>
  @endsection
