@extends('layouts.auth')
@section('title', 'Login')
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
        <div class="tab-pane fade show active" id="tab-item-login" role="tabpanel" aria-labelledby="login-tab">
          <div class="login-form">

            <form method="POST" action="{{route('login')  }}" name="login-form" class="needs-validation" novalidate="">
              @csrf
              <div class="form-floating mb-3">
                <input class="form-control form-control_gray " name="email" required="" autocomplete="email"
                  autofocus="">
                <label for="email">Email address </label>
              </div>

              <div class="pb-3"></div>

              <div class="form-floating mb-3">
                <input id="password" type="password" class="form-control form-control_gray " name="password" required=""
                  autocomplete="current-password">
                <label for="customerPasswodInput">Password </label>
                {{-- <i class="fa fa-eye-slash toggle-password" id="togglePassword"></i> --}}
              </div>

              <button class="btn btn-primary w-100 text-uppercase" type="submit">Log In</button>

              <div class="customer-option mt-4 text-center">
                <span class="text-secondary">No account yet?</span>
                <a class="forgot-password" href="{{ route('password.request') }}">
                Forgot Password?
                </a>
                <a href="{{ route('register') }}" class="btn-text js-show-register">Create Account</a>
              </div>
            </form>

          </div>
        </div>

@endsection
@section('script')
  <script src="{{ asset ('build/assets/js/plugins/jquery.min.js') }}"></script>
  <script src="{{ asset ('build/assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset ('build/assets/js/plugins/bootstrap-slider.min.js') }}"></script>
  <script src="{{ asset ('build/assets/js/plugins/swiper.min.js') }}"></script>
  <script src="{{ asset ('build/assets/js/plugins/countdown.js') }}"></script>
  <script src="{{ asset ('build/assets/js/theme.js') }}"></script>
  <script>
        document.querySelectorAll('.toggle-password').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
  @endsection
