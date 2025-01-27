<div class="app-header header sticky">
    <div class="container-fluid main-container">
        <div class="d-flex">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>
            <!-- sidebar-toggle-->
            <a class="logo-horizontal" href="{{ url('dashboard') }}">
                <img src="{{ asset('backendAssets') }}/static_images/logo.png" class="header-brand-img desktop-logo" alt="logo" style="height: auto; max-width: 165px;">
                <img src="{{ asset('backendAssets') }}/static_images/logo.png" class="header-brand-img light-logo1" alt="Color logo" style="height: auto; max-width: 165px;">
            </a>
            <!-- LOGO -->

            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <!-- SEARCH -->
                <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                </button>
                <div class="navbar navbar-collapse responsive-navbar p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex order-lg-2">

                            <div class="d-flex">
                                <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                    <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                    <span class="light-layout"><i class="fe fe-sun"></i></span>
                                </a>
                            </div>
                            <!-- Theme-Layout -->
                            <div class="dropdown d-flex">
                                <a class="nav-link icon full-screen-link nav-link-bg">
                                    <i class="fe fe-minimize fullscreen-button"></i>
                                </a>
                            </div>
                            <!-- FULL-SCREEN -->
                            <!-- SIDE-MENU -->
                            <div class="dropdown d-flex profile-1">
                                <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                    @if (Auth::user()->profile_photo_path)
                                    <img src="{{ asset( Auth::user()->profile_photo_path) }}" alt="profile-user" class="avatar profile-user brround cover-image">
                                    @else
                                    <img alt="avatar" src="{{ asset('backendAssets') }}/images/avatar/avatar.png" class="avatar profile-user brround cover-image">
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading">
                                        <div class="text-center">
                                            <h5 class="text-dark mb-0 fs-14 fw-semibold">{{ Auth::user()->name ?? ''}}</h5>
                                            @if (Auth::user()->role == '2')
                                            <small class="text-muted">Super Admin <i class="fa fa-check-circle"></i> </small>
                                            @elseif(Auth::user()->role == '1')
                                            <small class="text-muted">Verfied Member <i class="fa fa-check-circle"></i> </small>
                                            @else
                                            <small class="text-muted">Not Verified</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    @if (Auth::user()->role != '2')
                                        <a class="dropdown-item" href="{{ route('profile_member') }}">
                                            <i class="dropdown-icon fe fe-user"></i> Profile
                                        </a>
                                    @endif
                                    @if (Auth::user()->role == '2')
                                        <a class="dropdown-item" href="{{ route('profile_admin') }}">
                                            <i class="dropdown-icon fe fe-user"></i> Profile
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout').submit()"><i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                        <form action="{{ route('logout') }}" method="post" id="logout">
                                            @csrf
                                        </form>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
