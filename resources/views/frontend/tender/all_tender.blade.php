@extends('backend.master')
@section('title')
CMS :: Tender
@endsection
@section('content')
<style>
        /*** Tender ***/

        .tender_card {
        border: 1px solid #ddd;
        padding: 15px;
        transition: box-shadow 0.3s ease-in-out;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
    }

    .tender_card:hover {
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .card-link {
        font-size: 14px;
        color: #007bff;
        text-decoration: underline;
    }

    .card-link:hover {
        text-decoration: none;
    }

    .logo-img {
        width: 50px;
        /* Adjust size as needed */
        height: 50px;
        /* Ensure it's a square */
        border-radius: 8px;
        /* Rounded corners */
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        /* Box shadow similar to the image */
        background-color: white;
        /* Add a white background if needed */
        padding: 5px;
        /* Add some padding around the logo inside the shadow box */
    }
</style>
<div class="row">
    <div class="col-lg-4 col-md-5 col-sm-8 col-12 event_search_panel wow fadeInLeft">
        <div class="input_field">
            <input list="districts" type="search" name="tender_search" id="tender_search" class="form-control" placeholder="{{ __('Search Tender...') }}" aria-label="Username" data-url="{{ route('ajax.search_tender') }}">
            <datalist id="districts">
                @foreach ($districts as $district)
                    <option value="{{ $district->district_name }}">
                @endforeach
            </datalist>
        </div>
    </div>
    <div class="col-lg-8 col-md-7 col-sm-4 col-12 wow fadeInRight">
        <a class="btn btn-info sort_btn float_end text-white" role="button" href="#" data-bs-toggle="dropdown">
            <span>{{ __('Sort By') }}</span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="javascript:void(0);" onclick="getTenderByLocation(this, '{{ route('ajax.sort_tender', 'all') }}')">
                    {{ __('All') }} </a>
            </li>
            @foreach ($districts as $district)
            <li><a class="dropdown-item" href="javascript:void(0);" onclick="getTenderByLocation(this, '{{ route('ajax.sort_tender', $district->id) }}')">{{ $district->district_name }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="row tender_result justify-content-center">
    @foreach ($tender as $item)
    <div class="col-md-4 col-sm-6 col-12 mt-3 wow fadeInUp" data-wow-delay="0.3s">
        <div class="card tender_card h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">{{ $item->tender_title }}</h5>
                    <a href="{{ route('preview_tender', $item->id) }}" class="card-link">{{ $item->link_name }}</a>
                </div>
                <a href="{{ route('preview_tender', $item->id) }}">
                    <img src="{{ asset($item->logo) }}" alt="Logo" class="img-fluid logo-img">
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
