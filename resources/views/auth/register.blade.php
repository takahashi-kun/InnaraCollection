@extends('layouts.auth')
@section('title', 'Register')

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

            <form name="register-form" class="needs-validation" action="{{ route('register') }}" method="POST" novalidate="">
                @csrf
              <div class="form-floating mb-3">
                <input class="form-control form-control_gray " name="name"  required="" autocomplete="name"
                  autofocus="">
                <label for="name">Name *</label>
              </div>
              <div class="pb-3"></div>
              <div class="form-floating mb-3">
                <input id="email" type="email" class="form-control form-control_gray " name="email" required=""
                  autocomplete="email">
                <label for="email">Email address *</label>
              </div>

              <div class="pb-3"></div>
              <div class="form-floating mb-3">
                <input id="no_tlp" type="text" class="form-control form-control_gray " name="no_tlp" required=""
                  autocomplete="no_tlp">
                <label for="no_tlp">No Telephon *</label>
              </div>

              <div class="pb-3"></div>

              <div class="form-floating mb-3">
                <input id="password" type="password" class="form-control form-control_gray " name="password" required=""
                  autocomplete="new-password">
                <label for="password">Password *</label>
              </div>
              <div class="form-floating mb-3">
                <input id="password_confirmation" type="password" class="form-control form-control_gray " name="password_confirmation" required=""
                  autocomplete="new-password">
                <label for="password_confirmation">Confirm Password *</label>
              </div>

              <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                    <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                    <div class="invalid-feedback">You must agree before submitting.</div>
                    </div>
                </div>
                <input type="hidden" name="role" value="customer">

              <button class="btn btn-primary w-100 text-uppercase" type="submit">Register</button>

              <div class="customer-option mt-4 text-center">
                <span class="text-secondary">Sudah Punya Akun ?</span>
                <a href="{{ route('login') }}" class="btn-text js-show-register">Login ke akun kamu</a>
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
