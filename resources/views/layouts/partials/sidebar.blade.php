<nav id="sidebar" aria-label="Main Navigation">
  <!-- Side Header -->
  <div class="content-header">
    <!-- Logo -->
    <a class="fw-semibold text-dual" href="index.html">
      <span class="smini-visible">
        <i class="fa fa-circle-notch text-primary"></i>
      </span>
      <span class="smini-hide fs-5 tracking-wider">Politeknik <span class="fw-normal">SMI</span></span>
    </a>
    <!-- END Logo -->

    <!-- Extra -->
    <div>
      <!-- Dark Mode -->
      <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
      <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="dark_mode_toggle">
        <i class="far fa-moon"></i>
      </button>
      <!-- END Dark Mode -->

      <!-- Close Sidebar, Visible only on mobile screens -->
      <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
      <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
        <i class="fa fa-fw fa-times"></i>
      </a>
      <!-- END Close Sidebar -->
    </div>
    <!-- END Extra -->
  </div>
  <!-- END Side Header -->

  <!-- Sidebar Scrolling -->
  <div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side">
      <ul class="nav-main">

        <li class="nav-main-item">
          <a class="nav-main-link {{ Request::is('home*') ? 'active' : '' }}" href="{{ route('home') }}">
            <i class="nav-main-link-icon si si-speedometer"></i>
            <span class="nav-main-link-name">{{ trans('Dashboard') }}</span>
          </a>
        </li>

        @canany(['registrations.index', 'transactions.index'])
          <li class="nav-main-heading">{{ trans('Papper') }}</li>
          <li class="nav-main-item {{ request()->is('pappers*') ? 'open' : '' }}">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="{{ request()->is('pappers*') ? 'true' : 'false' }}" href="#">
              <i class="nav-main-link-icon fa fa-file"></i>
              <span class="nav-main-link-name">{{ trans('Papper') }}</span>
            </a>
            <ul class="nav-main-submenu">
              @can('transactions.index')
                <li class="nav-main-item">
                  <a class="nav-main-link {{ request()->is('pappers/transactions*') ? 'active' : '' }}" href="{{ route('transactions.index') }}">
                    <span class="nav-main-link-name">{{ trans('Pembayaran') }}</span>
                  </a>
                </li>
              @endcan
              @can('registrations.index')
                <li class="nav-main-item">
                  <a class="nav-main-link {{ request()->is('pappers/registrations*') ? 'active' : '' }}" href="{{ route('registrations.index') }}">
                    <span class="nav-main-link-name">{{ trans('Jadwal Submit') }}</span>
                  </a>
                </li>
              @endcan
            </ul>
          </li>
        @endcan

        @canany(['roles.index', 'users.index'])
          <li class="nav-main-heading">{{ trans('Management') }}</li>
          <li class="nav-main-item {{ Request::is('settings*') ? 'open' : '' }}">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="{{ Request::is('settings*') ? 'true' : 'false' }}" href="#">
              <i class="nav-main-link-icon fa fa-cog"></i>
              <span class="nav-main-link-name">{{ trans('Settings') }}</span>
            </a>
            <ul class="nav-main-submenu">
              @can('users.index')
                <li class="nav-main-item">
                  <a class="nav-main-link {{ Request::is('settings/users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <span class="nav-main-link-name">{{ trans('Pengguna') }}</span>
                  </a>
                </li>
              @endcan
              @can('roles.index')
                <li class="nav-main-item">
                  <a class="nav-main-link {{ Request::is('settings/roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                    <span class="nav-main-link-name">{{ trans('Role & Permission') }}</span>
                  </a>
                </li>
              @endcan
            </ul>
          </li>
        @endcan
        
      </ul>
    </div>
    <!-- END Side Navigation -->
  </div>
  <!-- END Sidebar Scrolling -->
</nav>