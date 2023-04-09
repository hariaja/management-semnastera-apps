@extends('layouts.app')
@section('title', trans('Profile Saya'))
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

    <form action="{{ route('users.update', $user->uuid) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('put')

      <div class="row push">
        <div class="col-lg-4">
          <p class="fs-sm text-muted">
            {{ trans('Info penting akun Anda. Email Anda akan terlihat oleh publik.') }}
          </p>
        </div>
        <div class="col-lg-8 col-xl-5">

          <div class="text-center">
            <p class="fs-sm text-muted">
              {{ trans('Informasi Pribadi') }}
            </p>
          </div>

          <div class="mb-4">
            <label for="first_title" class="form-label">{{ trans('Gelar Depan') }}</label>
            <input type="text" name="first_title" id="first_title" value="{{ old('first_title', $user->first_title) }}" class="form-control @error('first_title') is-invalid @enderror" placeholder="{{ trans('Input Gelar') }}" onkeypress="return hanyaHuruf(event)">
            @error('first_title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="last_title" class="form-label">{{ trans('Gelar Belakang') }}</label>
            <input type="text" name="last_title" id="last_title" value="{{ old('last_title', $user->last_title) }}" class="form-control @error('last_title') is-invalid @enderror" placeholder="{{ trans('Input Gelar') }}" onkeypress="return hanyaHuruf(event)">
            @error('last_title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <span class="fs-sm text-muted">Boleh dikosongkan jika tidak memiliki gelar</span>
          </div>

          <div class="mb-4">
            <label for="first_name" class="form-label">{{ trans('Nama Depan') }}</label>
            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" class="form-control @error('first_name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
            @error('first_name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="last_name" class="form-label">{{ trans('Nama Belakang') }}</label>
            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" class="form-control @error('last_name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
            @error('last_name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="gender" class="form-label">{{ trans('Jenis Kelamin') }}</label>
            <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
              <option disabled selected>{{ trans('Pilih Jenis Kelamin') }}</option>
              <option value="{{ Constant::MALE }}" {{ old('gender', $user->gender) === Constant::MALE ? 'selected' : '' }}>{{ Constant::MALE }}</option>
              <option value="{{ Constant::FEMALE }}" {{ old('gender', $user->gender) === Constant::FEMALE ? 'selected' : '' }}>{{ Constant::FEMALE }}</option>
            </select>
            @error('gender')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="text-center">
            <p class="fs-sm text-muted">
              {{ trans('Informasi Kontak') }}
            </p>
          </div>

          <div class="mb-4">
            <label for="email" class="form-label">{{ trans('Email') }}</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('Input Email Pembimbing') }}" readonly>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="phone" class="form-label">{{ trans('Nomor Telepon') }}</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ trans('Input Nomor Telepon') }}" onkeypress="return hanyaAngka(event)">
            @error('phone')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <div class="block block-rounded">
              <div class="block-header block-header-default">
                <label class="form-label">{{ trans('page.image') }}</label>
              </div>
              <div class="block-content">
                <div class="push">
                  @isset($user->avatar)
                    <img class="img-prev img-center" src="{{ $user->getAvatar() }}" alt="">
                  @else
                    <img class="img-prev img-center" src="{{ asset('assets/images/default.png') }}" alt="">
                  @endisset
                </div>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <input type="hidden" name="old_avatar" value="{{ $user->avatar }}">
          </div>

          <div class="mb-4">
            <label class="form-label" for="image">{{ trans('Upload Avatar') }}</label>
            <input class="form-control @error('avatar') is-invalid @enderror" type="file" accept="image/*" id="image" name="avatar" onchange="return previewImage()">
            @error('avatar')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="institution" class="form-label">{{ trans('Institusi') }}</label>
            <input type="text" name="institution" id="institution" value="{{ old('institution', $user->institution) }}" class="form-control @error('institution') is-invalid @enderror" placeholder="{{ trans('Input Institusi') }}">
            @error('institution')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="address" class="form-label">{{ trans('Alamat') }}</label>
            <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" cols="30" rows="5" placeholder="Input Alamat Lengkap">{{ old('address', $user->address) }}</textarea>
            @error('address')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
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