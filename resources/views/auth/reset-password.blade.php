@extends('layouts.auth')

@section('title', 'Reset Password')
@section('page-title', 'Set New Password')

@section('content')
    <div class="tab-pane fade show active" id="tab-item-register" role="tabpanel" aria-labelledby="register-tab">
      <div class="register-form">

        <form class="form" action="{{ route('password.update') }}" method="POST">
          @csrf
          <input type="hidden" name="token" value="{{ $request->route('token') }}">
          <input type="hidden" name="email" value="{{ $request->email }}">

          <div class="form-floating mb-3">
            <input id="newPassword" type="password" class="form-control form-control_gray" name="password" required
              autocomplete="new-password">
            <label for="newPassword">New Password</label>
            {{-- <i class="fa fa-eye-slash toggle-password"></i> --}}
          </div>

          <div class="form-floating mb-3">
            <input id="confirmPassword" type="password" class="form-control form-control_gray" name="password_confirmation" required
              autocomplete="new-password">
            <label for="confirmPassword">Confirm New Password</label>
            {{-- <i class="fa fa-eye-slash toggle-password"></i> --}}
          </div>

          <button type="submit" class="btn btn-primary btn-sign-in w-100 text-uppercase">Reset Password</button>
        </form>
      </div>
    </div>

@endsection

@section('scripts')
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