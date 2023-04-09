@extends('layouts.app')
@section('title', trans('Ubah Kata Sandi'))
@section('hero')
<!-- Hero -->
<div class="bg-image" style="background-image: url('{{ asset('assets/src/media/photos/photo10@2x.jpg') }}');">
  <div class="bg-primary-dark-op">
    <div class="content content-full text-center">
      <div class="my-3">
        <img class="img-avatar img-avatar-thumb" src="{{ $user->getAvatar() }}" alt="">
      </div>
      <h1 class="h2 text-white mb-0">{{ $user->name }}</h1>
      <h2 class="h4 fw-normal text-white-75">{{ $user->isRoleName() }}</h2>
      <a class="btn btn-alt-secondary" href="{{ route('home') }}">
        <i class="fa fa-fw fa-arrow-left text-danger"></i>
        {{ trans('Back to Dashboard') }}
      </a>
    </div>
  </div>
</div>
<!-- END Hero -->
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">{{ trans('page.users.show') }}</h3>
  </div>
  <div class="block-content">

    <form action="{{ url('settings/users/password') }}" method="POST">
      @csrf

      <div class="row push">
        <div class="col-lg-4">
          <p class="fs-sm text-muted">
            {{ trans('Mengubah kata sandi masuk Anda adalah cara mudah untuk menjaga keamanan akun Anda.') }}
            {{ trans('Secara default password anda adalah "password" tanpa tanda petik (jika anda belum mengubahnya).') }}
          </p>
        </div>
        <div class="col-lg-8 col-xl-5">
          
          <div class="mb-4">
            <label class="form-label" for="current_password">{{ trans('Kata Sandi Saat Ini') }}</label>
            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
            @error('current_password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="row mb-4">
            <div class="col-12">
              <label class="form-label" for="password">{{ trans('Kata Sandi Baru') }}</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-12">
              <label class="form-label" for="password_confirmation">{{ trans('Konfirmasi Kata Sandi Baru') }}</label>
              <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
              @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="my-4">
            <button type="submit" class="btn btn-primary w-100">
              <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
              {{ trans('page.edit') }}
            </button>
          </div>

        </div>
      </div>

    </form>

  </div>
</div>
@endsection