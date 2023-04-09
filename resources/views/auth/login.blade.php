@extends('layouts.guest')
@section('title', 'Login Page')
@section('content')
  <!-- Page Content -->
  <div class="hero-static d-flex align-items-center">
    <div class="w-100">
      <!-- Sign In Section -->
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
                  {{ trans('Masuk ke Akun') }}
                </h1>
                <p class="fw-medium text-muted mb-3">
                  {{ trans('Masukkan email & kata sandi Anda untuk login') }}
                </p>
              </div>
              <!-- END Header -->

              <!-- Sign In Form -->
              <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="py-3">
                  <div class="mb-4">
                    <input type="text" class="form-control form-control-lg form-control-alt @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-4">
                    <input type="password" class="form-control form-control-lg form-control-alt" id="password" name="password" required autocomplete="current-password" placeholder="Kata Sandi">
                  </div>
                  <div class="mb-4">
                    <div class="d-md-flex align-items-md-center justify-content-md-between">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">{{ trans('Ingat Saya') }}</label>
                      </div>
                      <div class="py-2">
                        @if (Route::has('password.request'))
                          <a class="fs-sm fw-medium" href="{{ route('password.request') }}">{{ trans('Lupa Kata Sandi?') }}</a>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="mb-4">
                  <div class="row justify-content-center">
                    <div class="col-lg-6 col-xxl-5">
                      <button type="submit" class="btn w-100 btn-alt-primary">
                        <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i>
                        {{ trans('Masuk') }}
                      </button>
                    </div>
                  </div>
                </div>

                <div class="fs-sm text-center text-muted py-3">
                  <span>{{ trans('Belum memliki akun?') }}</span>
                  <a href="{{ route('register') }}"><strong>{{ trans('Buat Akun Baru Disini') }}</strong></a>
                </div>

              </form>
              <!-- END Sign In Form -->
            </div>
          </div>
        </div>
      </div>
      <!-- END Sign In Section -->

      <!-- Footer -->
      <div class="fs-sm text-center text-muted py-3">
        <strong>{{ config('app.name') }}</strong> &copy; <span data-toggle="year-copy"></span>
      </div>
      <!-- END Footer -->
    </div>
  </div>
  <!-- END Page Content -->
@endsection