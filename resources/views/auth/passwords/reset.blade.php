@extends('layouts.guest')
@section('title', 'Reset Kata Sandi')
@section('content')
<div class="hero-static d-flex align-items-center">
  <div class="w-100">
    <!-- Reminder Section -->
    <div class="bg-body-extra-light">
      <div class="content content-full">
        <div class="row g-0 justify-content-center">
          <div class="col-md-8 col-lg-6 col-xl-4 py-4 px-4 px-lg-5">
            <!-- Header -->
            <div class="text-center">
              <p class="mb-2">
                <img class="img-avatar" src="{{ asset('assets/images/polikami.png') }}" alt="">
              </p>
              <h1 class="h4 mb-1">
                {{ trans('Reset Kata Sandi') }}
              </h1>
              <p class="fw-medium text-muted mb-4">
                {{ trans('Silahkan buat kata sandi baru anda, mohon berikan kata sandi unik dan mudah anda ingat.') }}
              </p>
            </div>
            <!-- END Header -->

            <!-- Reminder Form -->
            <form method="POST" action="{{ route('password.update') }}">
              @csrf

              <input type="hidden" name="token" value="{{ $token }}">

              <div class="mb-4">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus readonly>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-4">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-4">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
              </div>
  
              <div class="mb-0">
                <button type="submit" class="btn btn-primary btn-hero w-100">{{ __('Reset Password') }}</button>
              </div>
            </form>
            <!-- END Reminder Form -->

          </div>
        </div>
      </div>
    </div>
    <!-- END Reminder Section -->

    <!-- Footer -->
    <div class="fs-sm text-center text-muted py-3">
      <strong>{{ config('app.name') }}</strong> &copy; <span data-toggle="year-copy"></span>
    </div>
    <!-- END Footer -->

  </div>
</div>
@endsection
