<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/images/polikami.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/polikami.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/polikami.png') }}">
    <!-- END Icons -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Poppins" rel="stylesheet">
    <!-- END Fonts -->

    <style>
      .img-center {
        display: block !important;
        margin-left: auto;
        margin-right: auto;
        width: 30%;
        border-radius: 50%;
      }

      .img-placholder-center {
        display: block !important;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
      }
    </style>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/css/oneui.min.css') }}" id="css-main">

    <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">

    @stack('css')
    <script src="{{ asset('assets/custom/css/custom.css') }}"></script>
    <!-- END Stylesheets -->

  </head>

  <body>

    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
      @include('layouts.partials.sidebar')
      @include('layouts.partials.header')
      <main id="main-container">
        @yield('hero')
        <div class="content">
          @yield('content')
        </div>
      </main>
      @include('layouts.partials.footer')
    </div>

    <!-- Dashmix JS -->
    <script src="{{ asset('assets/src/js/oneui.app.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/custom/js/custom.js') }}"></script>

    <!-- Plugin JS -->
    <script src="{{ asset('assets/src/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.j') }}s"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('assets/src/js/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/src/js/pages/be_tables_datatables.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
      One.helpersOnLoad([
        'jq-select2',
        'jq-magnific-popup',
        'jq-datepicker',
        'js-flatpickr'
      ])
    </script>

    @include('sweetalert::alert')
    @stack('javascript')
    @include('layouts.components.alert')
  </body>
</html>