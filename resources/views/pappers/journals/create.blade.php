@extends('layouts.app')
@section('title') {{ trans('page.journals.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.journals.title') }}</h1>
      <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item">
            <a href="{{ route('journals.index') }}" class="btn btn-sm btn-block-option text-danger">
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
        {{ trans('page.journals.create') }}
      </h3>
    </div>
    <div class="block-content block-content-full">

      <form action="{{ route('journals.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row justify-content-center">
          <div class="col-md-6">

            <div class="mb-3">
              <label for="title" class="form-label">Judul</label>
              <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Judul/Topik Makalah">
              @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="category" class="form-label">Kategori</label>
              <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}" placeholder="Kategori Makalah">
              @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="abstract" class="form-label">Abstrak</label>
              <textarea name="abstract" class="editor form-control @error('abstract') is-invalid @enderror" id="abstract" cols="30" rows="5">{{ old('abstract') }}</textarea>
              @error('abstract')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="upload_year" class="form-label">Tahun Upload</label>
              <input type="text" name="upload_year" id="upload_year" class="form-control @error('upload_year') is-invalid @enderror" value="{{ date('Y') }}" readonly>
              @error('upload_year')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="file" class="form-label">{{ __('Upload File Makalah') }}</label>
              <input type="file" accept="application/pdf" name="file" id="file" class="form-control @error('file') is-invalid @enderror">
              <small class="text-muted">{{ trans('Hanya boleh memasukkan file dengan format .pdf') }}</small>
              @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <button type="submit" class="btn btn-hero btn-primary w-100">
                <i class="fa fa-circle-check fa-fw opacity-50 me-2"></i>
                {{ trans('Submit Makalah') }}
              </button>
            </div>

          </div>
        </div>
      
      </form>

    </div>
  </div>
@endsection