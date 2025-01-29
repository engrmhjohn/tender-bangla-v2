@extends('backend.master')
@section('title')
CMS :: Tender
@endsection
@section('content')
<style>
    /*** Tender ***/
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


    .tender_search {
        position: relative;
    }

    a[type='button'] {
        position: absolute;
        top: 9px;
        right: 27px;
    }

    /* Apply scroll for dropdown menu when items are too many */
    .dropdown-menu {
        max-height: 300px;
        /* Adjust the height as needed */
        overflow-y: auto;
        /* Enable vertical scrolling */
        overflow-x: hidden;
        /* Hide horizontal scrolling */
    }

    /* Custom scrollbar for Chrome, Safari, and Edge */
    .dropdown-menu::-webkit-scrollbar {
        width: 6px;
    }

    .dropdown-menu::-webkit-scrollbar-thumb {
        background-color: #888;
        /* Customize scrollbar color */
        border-radius: 10px;
    }

    .dropdown-menu::-webkit-scrollbar-thumb:hover {
        background-color: #555;
        /* Darker color on hover */
    }

    /* Custom scrollbar for Firefox */
    .dropdown-menu {
        scrollbar-width: thin;
        /* Set the width of the scrollbar */
        scrollbar-color: #888 #f5f5f5;
        /* Thumb color and track color */
    }

    /* Firefox only: Customize hover effect */
    .dropdown-menu:hover {
        scrollbar-color: #555 #f5f5f5;
        /* Darker thumb color on hover */
    }

</style>
<button class="btn btn-dark btn-sm mb-2" onclick="history.back();"><i class="fa fa-reply"></i> Go Back</button>
<div class="row">
    <div class="col-lg-4 col-md-5 col-sm-8 col-12 event_search_panel">
        <div class="input_field">
            <input list="subCategory" type="text" name="tender_search" id="search_input" class="form-control tender_search" placeholder="{{ __('Search Tender...') }}" aria-label="Username">
            <a type="button" id="search_tender_button">
                <i class="fa fa-search"></i>
            </a>
            <datalist id="subCategory">
                @foreach($categories as $category)
                @foreach($category->subCategories as $subCategory)
                <option value="{{ $subCategory->sub_category_name }}"></option>
                @endforeach
                @endforeach
            </datalist>
        </div>
    </div>
    <div class="col-lg-8 col-md-7 col-sm-4 col-12 d-flex justify-content-end">
        <a class="btn btn-info sort_btn float_end text-white" role="button" href="#" data-bs-toggle="dropdown">
            <span id="districtTenderLabel">জেলা ভিত্তিক টেন্ডার <i class="fa fa-flask"></i></span>
        </a>
        <ul class="dropdown-menu">
            @foreach ($districts as $district)
            <li><a class="dropdown-item" href="javascript:void(0);" onclick="getTenderByLocation('{{ $district->district_name }}', '{{ route('ajax.sort_tender', $district->id) }}')">{{ $district->district_name }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="container-fluid mt-2">
    @foreach($categories as $category)
    @php
    // Filter subcategories that have paid tenders
    $paidSubCategories = $category->subCategories->filter(function($subCategory) {
    return $subCategory->tenders->where('tender_type', 1)->isNotEmpty();
    });
    @endphp

    @if($paidSubCategories->isNotEmpty())
    <!-- Check if there are subcategories with paid tenders -->
    <div class="category-section tender_result mb-2">
        <div class="row category_name_row pt-3 pb-2 align-items-center mb-2">
            <div class="col-lg-9 col-12">
                <h4>{{ $category->category_name }}</h4> <!-- Category name -->
            </div>
        </div>
        <div class="row">
            @foreach($paidSubCategories as $subCategory)
            <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                <div class="card sub-category-section">
                    <div class="card-header d-flex justify-content-center">
                        <div class="row">
                            <div class="col-lg-8">
                                <h5>{{ $subCategory->sub_category_name }}</h5> <!-- Subcategory name -->
                            </div>
                            <div class="col-lg-4">
                                <a class="tender_logo" href="{{ route('category_wise_tender', $category->id) }}">
                                    <img src="{{ asset($subCategory->logo) }}" alt="Logo">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="left_div">
                                @foreach($subCategory->tenders->where('tender_type', 1) as $tender)
                                <!-- Only show paid tenders -->
                                <a href="{{ route('preview_tender', $tender->id) }}" class="tender-link">
                                    {{ $loop->iteration }}. {{ $tender->link_name }} @if($tender->tender_validity < now()) <span class="text-dark fw-bold">(Expired)</span>
                                    @endif | <strong class="text-danger fw-bold">{{ $tender->district->district_name ?? 'Not Found' }} </strong>
                                    @if($tender->created_at >= now()->subDays(1))
                                    <img src="{{ asset('frontendAssets') }}/images/new_flashing.gif" alt="New">
                                    @endif
                                </a>
                                @endforeach
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
<!-- Modal for displaying search results -->
<div class="modal fade" id="searchTenderModal" tabindex="-1" role="dialog" aria-labelledby="searchTenderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchTenderModalLabel">সার্চ রেজাল্ট দেখছেন</h5>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- AJAX Search Results will be injected here -->
            <div class="modal-body">
                <div class="row justify-content-center" id="tenderSearchResults">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal for displaying sorted/filter results -->
<div class="modal fade" id="filterTenderModal" tabindex="-1" role="dialog" aria-labelledby="filterTenderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterTenderModalLabel">নির্দিষ্ট জেলার টেন্ডার দেখছেন</h5>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- Results will be injected here -->
                <div class="row justify-content-center" id="filterTenderResults">

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha512-k2WPPrSgRFI6cTaHHhJdc8kAXaRM4JBFEDo1pPGGlYiOyv4vnA0Pp0G5XMYYxgAPmtmv/IIaQA6n5fLAyJaFMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#search_tender_button').on('click', function() {
            var searchString = $('#search_input').val();

            if (searchString) {
                $.ajax({
                    url: '{{ route("ajax.search_tender_route") }}'
                    , method: 'GET'
                    , data: {
                        search_string: searchString
                    }
                    , success: function(response) {
                        if (response.status !== 'nothing found') {
                            // Inject the result into the modal's body
                            $('#tenderSearchResults').html(response);
                            // Open the modal
                            $('#searchTenderModal').modal('show');
                        } else {
                            $('#tenderSearchResults').html('<p>কোনো টেন্ডার পাওয়া যায়নি</p>');
                            $('#searchTenderModal').modal('show');
                        }
                    }
                    , error: function() {
                        $('#tenderSearchResults').html('<p>টেন্ডার খুঁজে পেতে সমস্যা হচ্ছে</p>');
                        $('#searchTenderModal').modal('show');
                    }
                });
            } else {
                alert('যেকোনো ক্যাটাগরির নাম দিয়ে টেন্ডার সার্চ করুন');
            }
        });
    });


    function getTenderByLocation(districtName, url) {
        $.ajax({
            url: url, // Use the passed route URL
            method: 'GET'
            , success: function(response) {
                if (response.status !== 'nothing found') {
                    // Inject the result into the modal's body
                    $('#filterTenderResults').html(response);
                    // Open the modal
                    $('#filterTenderModal').modal('show');
                } else {
                    $('#filterTenderResults').html('<p>কোনো টেন্ডার পাওয়া যায়নি</p>');
                    $('#filterTenderModal').modal('show');
                }
            }
            , error: function() {
                $('#filterTenderResults').html('<p>টেন্ডার খুঁজে পেতে সমস্যা হচ্ছে.</p>');
                $('#filterTenderModal').modal('show');
            }
        });
    }

</script>
@endsection
