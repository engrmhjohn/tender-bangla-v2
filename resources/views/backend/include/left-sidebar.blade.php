<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ url('dashboard') }}">
                <img src="{{ asset('backendAssets') }}/static_images/logo.png" class="header-brand-img desktop-logo" alt="logo" style="height: auto; max-width: 165px;">
                <img src="{{ asset('backendAssets') }}/static_images/logo.png" class="header-brand-img light-logo1" alt="logo" style="height: auto; max-width: 165px;">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category text-center bg-primary-gradient" style="padding-bottom: 8px;">
                    <h3 class="fw-bold text-white">Main</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ url('/dashboard') }}"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
                </li>
                <li>
                    <a class="side-menu__item has-link" href="{{ url('/') }}" target="_blank"><i class="side-menu__icon fe fe-zap"></i><span class="side-menu__label"> Website </span><span class="badge bg-green br-5 side-badge blink-text pb-1">Home Page</span></a>
                </li>
                <li class="sub-category text-center bg-secondary-gradient" style="padding-bottom: 8px;">
                    <h3 class="text-white fw-bold">Admin</h3>
                </li>
                @if (Auth::user()->role != '2')
                <li>
                    <a class="side-menu__item has-link" href="{{ route('profile_member') }}"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label"> My Profile </span></a>
                </li>
                @endif
                @if (Auth::user()->role == '2')
                <li>
                    <a class="side-menu__item has-link" href="{{ route('profile_admin') }}"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label"> My Profile </span></a>
                </li>
                <li class="sub-category text-center bg-danger-gradient" style="padding-bottom: 8px;">
                    <h3 class="text-white fw-bold">Member</h3>
                </li>
                <li>
                    <a class="side-menu__item has-link" href="{{ route('add_member') }}"><i class="side-menu__icon fa fa-plus"></i><span class="side-menu__label"> Add Member </span></a>
                </li>
                <li>
                    <a class="side-menu__item has-link" href="{{ route('pending_member') }}"><i class="side-menu__icon fa fa-exclamation-triangle"></i><span class="side-menu__label"> Pending Member </span></a>
                </li>
                <li>
                    <a class="side-menu__item has-link" href="{{ route('verified_member') }}"><i class="side-menu__icon fa fa-check-circle"></i><span class="side-menu__label"> Verified Member </span></a>
                </li>
                <li>
                    <a class="side-menu__item has-link" href="{{ route('manage_member') }}"><i class="side-menu__icon fa fa-users"></i><span class="side-menu__label"> All Member </span></a>
                </li>
                <li>
                    <a class="side-menu__item has-link" href="{{ route('show_payment_verification') }}"><i class="side-menu__icon fa fa-dollar"></i><span class="side-menu__label"> Add Payment Record </span></a>
                </li>
                <li>
                    <a class="side-menu__item has-link" href="{{ route('manage_payment_verification') }}"><i class="side-menu__icon fa fa-dollar"></i><span class="side-menu__label"> Manage Payment Record </span></a>
                </li>

                <li class="sub-category text-center bg-warning-gradient" style="padding-bottom: 8px;">
                    <h3 class="text-white fw-bold">Content Manage</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-copy"></i><span class="side-menu__label">Tender Category</span><i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="panel sidetab-menu">
                            <div class="panel-body tabs-menu-body p-0 border-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="side21">
                                        <ul class="sidemenu-list">
                                            <li><a href="{{ route('add_tender_category') }}" class="slide-item"> Add Category</a></li>
                                            <li><a href="{{ route('manage_tender_category') }}" class="slide-item">
                                                    All Category</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-copy"></i><span class="side-menu__label">Tender Sub Category</span><i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="panel sidetab-menu">
                            <div class="panel-body tabs-menu-body p-0 border-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="side21">
                                        <ul class="sidemenu-list">
                                            <li><a href="{{ route('add_tender_sub_category') }}" class="slide-item"> Add Sub Category</a></li>
                                            <li><a href="{{ route('manage_tender_sub_category') }}" class="slide-item">
                                                    All Sub Category</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-copy"></i><span class="side-menu__label">Tenders</span><i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="panel sidetab-menu">
                            <div class="panel-body tabs-menu-body p-0 border-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="side21">
                                        <ul class="sidemenu-list">
                                            <li><a href="{{ route('add_tender') }}" class="slide-item"> Add Tender</a></li>
                                            <li><a href="{{ route('manage_tender') }}" class="slide-item">
                                                    All Tender</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="side-menu__item has-link" href="{{ route('manage_homepage_content') }}"><i class="side-menu__icon fa fa-paint-brush"></i><span class="side-menu__label"> Home Page Content </span></a>
                </li>
                <li>
                    <a class="side-menu__item has-link" href="{{ route('manage_package_info') }}"><i class="side-menu__icon fa fa-paint-brush"></i><span class="side-menu__label"> Package Info Content </span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-heartbeat"></i><span class="side-menu__label">Helpline Link</span><i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="panel sidetab-menu">
                            <div class="panel-body tabs-menu-body p-0 border-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="side21">
                                        <ul class="sidemenu-list">
                                            <li><a href="{{ route('add_helpline') }}" class="slide-item"> Add Helpline</a></li>
                                            <li><a href="{{ route('manage_helpline') }}" class="slide-item">
                                                    All Helpline</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-heartbeat"></i><span class="side-menu__label">Important Notice</span><i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="panel sidetab-menu">
                            <div class="panel-body tabs-menu-body p-0 border-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="side21">
                                        <ul class="sidemenu-list">
                                            <li><a href="{{ route('add_important_notice') }}" class="slide-item"> Add Notice</a></li>
                                            <li><a href="{{ route('manage_important_notice') }}" class="slide-item">
                                                    All Notice</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                @endif
                <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                    </svg></div>
        </div>
    </div>
</div>
