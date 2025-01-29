@extends('frontend.master')
@section('title')
@endsection
@section('content')
<style>
    .tender-link {
        display: block;
    }

    .card-body small {
        display: block;
    }

    .tender_logo {
        display: block;
        width: 50px;
        height: 50px;
        padding: 3px;
        border-radius: 3px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .35);
    }

    .tender_logo img {
        max-width: 45px;
        height: auto;
    }
    .card-body .row .left_div{
        width: 65px;
    }
    .card-body .row .right_div{
        width: calc(100% - 65px);
    }
    @media(min-width: 576px){
        .pc_margin{
            margin-top: 100px;
        }
    }

</style>
<!-- Tender Start -->
<div class="container pc_margin">
    <div class="card mb-2 mt-2">
        <div class="card-body">
            <h3>আপনি দেখছেন {{ $category->category_name }} লিস্ট</h3>
        </div>
    </div>
    <button class="btn btn-dark btn-sm" onclick="history.back();"><i class="fas fa-reply"></i> Go Back</button>

    @foreach($category->subCategories as $subCategory)
        @if($subCategory->tenders->isNotEmpty())
        <h3 class="p-2 mt-3" style="background-color: #ecebfb; border-radius:5px;">{{ $subCategory->sub_category_name }}</h3> <!-- Subcategory name -->

        <div class="row">
            @foreach($subCategory->tenders as $tender)
            <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="left_div">
                                <a class="tender_logo" href="{{ route('preview_front_tender', $tender->id) }}">
                                    <img src="{{ asset($tender->subCategory->logo) }}" alt="Logo">
                                </a>
                            </div>
                            <div class="right_div">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="{{ route('preview_front_tender', $tender->id) }}" class="card-link">{{ $tender->link_name }}  
                                            @if($tender->tender_validity < now())
                                            <span class="text-danger fw-bold">(Expired)</span>
                                            @endif
                                        @if($tender->created_at >= now()->subDays(1))
                                            <img src="{{ asset('frontendAssets') }}/images/new_flashing.gif" alt="New">
                                        @endif
                                        </a>
                                    </div>
                                    <div class="col-12">
                                        <small><i class="fas fa-calendar-alt"></i> Posted on: <strong>{{ \Carbon\Carbon::parse($tender->created_at)->format('d F Y') }}</strong> </small>
                                    </div>
                                    <div class="col-12">
                                        <small><i class="fas fa-calendar-alt"></i> Deadline: <strong>{{ \Carbon\Carbon::parse($tender->tender_validity)->format('d F Y') }}</strong> </small>
                                    </div>
                                    <div class="col-12">
                                        <small><i class="fas fa-map-marker-alt"></i> District: <strong>{{ $tender->district->district_name ?? 'Not Found' }}</strong></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    @endforeach
</div>
@endsection
