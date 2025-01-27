@extends('frontend.master')
@section('title')
@endsection
@section('content')
<style>
    .sub-category-section h5{
        margin-bottom: 0px;
    }
    .tender-link {
        display: block;
    }

    .tender_logo {
        display: block;
        width: 60px;
        height: 60px;
        padding: 5px;
        border-radius: 3px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .35);
    }

    .tender_logo img {
        max-width: 50px;
        height: auto;
    }

    .category_name_row {
        background-color: #ecebfb;
        border-radius: 5px;
    }

    .border-animation--border-2 {
        animation-delay: 1.5s;
    }

    .card-body .row .right_div {
        width: 80px;
    }

    .card-body .row .left_div {
        width: calc(100% - 80px);
    }
    .header-margin{
        margin-top: 40px;
    }
    #home img{
        border-radius: 5px;
    }

    @media (max-width: 576px) {
        .header-margin {
            margin-top: 0px;
        }
        .intro-section.mt-5{
            margin-top: 0px !important;
        }
    }
    @media (min-width: 576px) and (max-width: 767px) {
        .header-margin {
            margin-top: 50px;
        }
    }

</style>
<!-- Header Start -->
<section id="home" class="intro-section mt-5">
    <div class="container">
        <div class="row justify-content-center align-items-center text-white">
                <div class="col-md-6 order-1 order-md-2 header-margin">
                    <img src="{{ asset($homepage_cms->header_banner_image) }}" alt="Banner Image" class="img-fluid">
                </div>
            
                <div class="col-md-6 intros text-start order-2 order-md-1 header-margin">
                    <h1 class="display-2">
                        {{ $homepage_cms->header_banner_text ?? '' }}
                    </h1>
                    <a type="button" href="{{ route('register') }}" class="rounded-pill2 btn-rounded2 mb-2">{{ $homepage_cms->header_btn_text ?? '' }}
                        <span><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
        </div>
    </div>
</section>
<!-- Header End -->

<!-- Tender Start -->
<section class="tender py-5">
    <div class="container">
        @foreach($categories as $category)
            @php
                // Filter subcategories with free tenders
                $freeSubCategories = $category->subCategories->filter(fn($subCategory) =>
                    $subCategory->tenders->where('tender_type', 0)->isNotEmpty()
                );
            @endphp

            @if($freeSubCategories->isNotEmpty())
                <div class="category-section mb-4">
                    <!-- Category Header -->
                    <div class="row category_name_row pt-3 pb-2 align-items-center mb-2">
                        <div class="col-lg-9 col-6">
                            <h4>{{ $category->category_name }}</h4>
                        </div>
                        <div class="col-lg-3 col-6 d-flex justify-content-end">
                            <a href="{{ route('category_wise_tender', $category->id) }}" class="rounded-pill2 btn-rounded2 btn-sm">
                                {{ $homepage_cms->category_btn_text ?? '' }}
                                <span><i class="fas fa-arrow-right"></i></span>
                            </a>
                        </div>
                    </div>

                    <!-- Subcategories -->
                    <div class="row">
                        @foreach($freeSubCategories as $subCategory)
                            <div class="col-xl-4 col-lg-4 col-md-6 mb-3">
                                <div class="card sub-category-section">
                                    <div class="card-header text-center">
                                        <h5>{{ $subCategory->sub_category_name }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="left_div">
                                                @foreach($subCategory->tenders->where('tender_type', 0) as $tender)
                                                    <a href="{{ route('preview_front_tender', $tender->id) }}" class="tender-link">
                                                        <i class="fas fa-caret-right"></i>
                                                        {{ $tender->link_name }} | {{ $tender->district->district_name ?? 'Not Found' }}
                                                        @if($tender->created_at >= now()->subDays(3))
                                                            <img src="{{ asset('frontendAssets') }}/images/new_flashing.gif" alt="New">
                                                        @endif
                                                    </a>
                                                @endforeach
                                            </div>
                                            <div class="right_div">
                                                <a class="tender_logo" href="{{ route('category_wise_tender', $category->id) }}">
                                                    <img src="{{ asset($subCategory->logo) }}" alt="Logo">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>

<!-- Tender End -->
<div class="marquee-container">
    <div class="marquee-content">
        @foreach ($notices as $index => $notice)
            <span class="marquee-item">
                <i class="fa fa-bell"></i> {{ $notice->notice_title }}
            </span>
        @endforeach
    </div>
</div>
@endsection
