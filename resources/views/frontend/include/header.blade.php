@php
$categories = App\Models\TenderCategory::with(['subcategories.tenders'])->get();
@endphp
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-dark menu shadow fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('/') }}">
            <img class="logo" src="{{ asset($homepage_cms->logo) }}" alt="logo image">
        </a>
        <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
            <img class="menu_icon" src="{{ asset('frontendAssets') }}/images/menu-bar.png" alt="">
        </a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @foreach($categories as $category)
                @php
                // Check if any of the subcategories have tenders with tender_type = 0 means free tender
                $hasTendersWithTypeZero = $category->subcategories->contains(function ($subcategory) {
                return $subcategory->tenders->contains(function ($tender) {
                return $tender->tender_type == 0 && $tender->status == 1; // Check for tender_type = 0
                });
                });
                @endphp

                @if($hasTendersWithTypeZero)
                <!-- Only display category if subcategory has tenders with tender_type = 0 means free tender-->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category_wise_tender', $category->id) }}">
                        {{ $category->category_name }}
                    </a>
                </li>
                @endif
                @endforeach
            </ul>
            @if (Auth::check())
            <a type="button" href="{{ route('dashboard') }}" class="rounded-pill btn-rounded">
                ড্যাশবোর্ডে ফিরে যান
                <span>
                    <i class="fas fa-user"></i>
                </span>
            </a>
            @else
            <a type="button" href="{{ route('login') }}" class="rounded-pill btn-rounded">
                {{ $homepage_cms->login_register_btn_text ?? '' }}
                <span>
                    <i class="fas fa-user"></i>
                </span>
            </a>
            @endif
        </div>
    </div>
</nav>
<!-- Navbar End -->

<!-- Mobile Menu Login Register Start -->
<div class="container mobile_credentials_btn">
    <div class="row">
        <div class="col-lg-12">
            <div class="button_container d-flex justify-content-center" style="gap: 20px; margin-bottom: 2px;">
                @if (Auth::check())
                <a class="btn btn-warning form-control" href="{{ route('dashboard') }}">ড্যাশবোর্ডে ফিরে যান</a>
                @else
                <a class="btn btn-primary" href="{{ route('login') }}">লগইন করুন</a>
                <a class="btn btn-success" href="{{ route('register') }}">রেজিস্টার করুন</a>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Mobile Menu Login Register End -->

<!-- Mobile Menu Start -->

<div class="offcanvas custom_offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" aria-modal="true" role="dialog">
    <div class="offcanvas-header">
        @if (Auth::check())
        <a type="button" href="{{ route('dashboard') }}" class="rounded-pill btn-rounded">
            ড্যাশবোর্ডে ফিরে যান
            <span>
                <i class="fas fa-user"></i>
            </span>
        </a>
        @else
        <a type="button" href="{{ route('login') }}" class="rounded-pill2 btn-rounded2">
            {{ $homepage_cms->login_register_btn_text ?? '' }}
            <span>
                <i class="fas fa-user"></i>
            </span>
        </a>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="mobile_menu_header align-items-center">
            <a href="{{ route('/') }}">
                <img class="logo" src="{{ asset($homepage_cms->logo) }}" alt="Logo">
            </a>
        </div>
        <nav class="mobile_nav">
            <ul class="mobile_side_menu_section">
                <li>
                    <a href="{{ route('/') }}">হোম</a>
                </li>
            </ul>

            @foreach($categories as $category)
            @php
            // Check if any of the subcategories have tenders with tender_type = 0 means free tender
            $hasTendersWithTypeZero = $category->subcategories->contains(function ($subcategory) {
            return $subcategory->tenders->contains(function ($tender) {
            return $tender->tender_type == 0 && $tender->status == 1; // Check for tender_type = 0
            });
            });
            @endphp

            @if($hasTendersWithTypeZero)
            <!-- Only display category if subcategory has tenders with tender_type = 0 means free tender-->
            <ul class="mobile_side_menu_section">
                <li>
                    <a href="{{ route('category_wise_tender', $category->id) }}">{{ $category->category_name }}</a>
                </li>
            </ul>
            @endif
            @endforeach
        </nav>

    </div>
</div>
<!-- Mobile Menu End -->
