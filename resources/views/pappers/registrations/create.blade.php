@extends('layouts.app')
@section('title') {{ trans('page.registrations.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.registrations.title') }}</h1>
      <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item">
            <a href="{{ route('registrations.index') }}" class="btn btn-sm btn-block-option text-danger">
              <i class="fa fa-xs fa-chevron-left me-1"></i>
              {{ trans('page.button.back') }}
            </a>
          </li>
        </ol>
      </nav>
    </div>
  </div>
</div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.registrations.create') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <form action="{{ route('registrations.store') }}" method="POST">
      @csrf

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label class="form-label" for="title">{{ trans('Agenda Acara') }}</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" onkeypress="return hanyaHuruf(event)">
            @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="form-label" for="date_start">{{ trans('Tanggal Mulai') }}</label>
            <input type="date" name="date_start" id="date_start" value="{{ old('date_start') }}" class="form-control @error('date_start') is-invalid @enderror">
            @error('date_start')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="form-label" for="date_end">{{ trans('Tanggal Selesai') }}</label>
            <input type="date" name="date_end" id="date_end" value="{{ old('date_end') }}" class="form-control @error('date_end') is-invalid @enderror">
            @error('date_end')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <button type="submit" class="btn btn-primary w-100" data-toggle="click-ripple">
              <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
              {{ trans('page.create') }}
            </button>
          </div>

        </div>
      </div>

    </form>

  </div>
</div>
@endsection