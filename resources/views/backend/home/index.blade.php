@extends('backend.master')
@section('title')
Admin :: Home
@endsection
@section('content')
@php
$user = Auth::user();

//account validity check
use Carbon\Carbon;
$accountValidity = Carbon::parse($user->account_validity);
$accountValidity = Carbon::parse($user->account_validity);
$today = Carbon::today();

if ($accountValidity->greaterThanOrEqualTo($today)) {
// Calculate days remaining if the account validity date is today or in the future
$daysRemaining = $today->diffInDays($accountValidity);
} else {
// If the date is in the past, set $daysRemaining to -1 for expired
$daysRemaining = -1;
}

//total user (super admin and member)
$all_user = App\Models\User::get();
$all_user_count = $all_user->count();

//total super admin
$total_super_admin = App\Models\User::where('role', '2')->get();
$total_super_admin_count = $total_super_admin->count();

//total verified member
$total_verified_member = App\Models\User::where('role', '1')->get();
$total_verified_member_count = $total_verified_member->count();


//total pending member
$total_pending = App\Models\User::where('role', '0')->get();
$total_pending_count = $total_pending->count();
@endphp

<style>
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

    .border-animation {
        position: absolute;
        top: 0;
        left: 0;
        width: 6rem;
        height: 6rem;
        border: 0.55rem solid #fff;
        border-radius: 50%;
        animation: pulse-border 1.5s linear infinite;
        animation-delay: 0s;
    }

    .border-animation--border-2 {
        animation-delay: 1.5s;
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
        text-decoration: none;
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

    .sub-category-section .card-body .row .right_div {
        width: 80px;
    }

    .sub-category-section .card-body .row .left_div {
        width: calc(100% - 80px);
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

    .card-body .row .left_div {
        width: 65px;
    }

    .card-body .row .right_div {
        width: calc(100% - 65px);
    }

</style>

@if (Auth::user()->role == '2')
<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('manage_member') }}">
            <div class="card bg-primary img-card box-primary-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $all_user_count }}</h2>
                            <p class="text-white mb-0">All Users</p>
                        </div>
                        <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('super_admin_user') }}">
            <div class="card bg-secondary img-card box-secondary-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $total_super_admin_count }}</h2>
                            <p class="text-white mb-0">Super Admin</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-user-check text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('admin_user') }}">
            <div class="card bg-success img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $total_verified_member_count }}</h2>
                            <p class="text-white mb-0">Total Verified Member</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-users text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <a href="{{ route('pending_member') }}">
            <div class="card bg-info img-card box-info-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $total_pending_count }}</h2>
                            <p class="text-white mb-0">Pending Verified</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-loader text-white fs-30 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@elseif(Auth::user()->role == '1')
@if($daysRemaining > 7)
<!-- Tender Start -->
<section class="tender py-5">
    <div class="container-fluid">
        <div class="row d-flex">
            <div class="col-12 d-flex justify-content-end">
                <a href="{{ route('all_tender') }}" class="btn btn-sm btn-blue mb-3" title="Add New">
                    সব টেন্ডার দেখুন <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            @if($tenders->isEmpty())
            <div class="alert alert-info" role="alert">
                No tender found in <strong>{{ $districtNames->implode(', ') }}</strong>
            </div>
            @else
            <div class="col-lg-12 mb-3">
                <div class="alert alert-info" role="alert">
                    আপনি দেখছেন <strong>
                        @if($userDistrictIds == ['all'])
                            সব
                        @else
                            {{ $districtNames->implode(', ') }}
                        @endif
                        জেলার টেন্ডার।
                    </strong>
                </div>
            </div>
            @foreach($tenders as $tender)
            <div class="col-xl-4 col-lg-4 col-md-6 mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <h5>{{ $tender->subCategory->sub_category_name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="left_div">
                                <a class="tender_logo" href="{{ route('preview_tender', $tender->id) }}">
                                    <img src="{{ asset($tender->subCategory->logo) }}" alt="Logo">
                                </a>
                            </div>
                            <div class="right_div">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="{{ route('preview_tender', $tender->id) }}" class="card-link">{{ $tender->link_name }}
                                            @if($tender->tender_validity < now())
                                        <span class="text-dark fw-bold">(Expired)</span>
                                        @endif
                                            @if($tender->district)
                                           <strong class="text-danger fw-bold">({{ $tender->district->district_name }})</strong>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
<!-- Tender End -->
@elseif($daysRemaining >= 0 && $daysRemaining <= 7) <div class="alert alert-info">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
    <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="40" width="40" viewBox="0 0 24 24">
            <path fill="#70a9ee" d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z" />
            <circle cx="12" cy="17" r="1" fill="#1170e4" />
            <path fill="#1170e4" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z" /></svg></span>
    <strong>Account Validity Info</strong>
    <hr class="message-inner-separator">
    <p>Your account is about to expire in {{ $daysRemaining }} day(s).</p>
    </div>
    <div>
        <img class="img-fluid" src="{{ asset($package_info->image) }}" alt="Package Information">
    </div>
    <section class="tender py-5">
        <div class="container-fluid">
            <div class="row d-flex">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('all_tender') }}" class="btn btn-sm btn-blue mb-3" title="Add New">
                        সব টেন্ডার দেখুন <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="row justify-content-center">
                @if($tenders->isEmpty())
                <div class="alert alert-info" role="alert">
                    No tender found in <strong>{{ $districtNames->implode(', ') }}</strong>
                </div>
                @else
                <div class="col-lg-12 mb-3">
                    <div class="alert alert-info" role="alert">
                        আপনি দেখছেন <strong>{{ $districtNames->implode(', ') }} জেলার টেন্ডার।</strong>
                    </div>
                </div>
                @foreach($tenders as $tender)
                <div class="col-xl-4 col-lg-4 col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center">
                            <h5>{{ $tender->subCategory->sub_category_name }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="left_div">
                                    <a class="tender_logo" href="{{ route('preview_tender', $tender->id) }}">
                                        <img src="{{ asset($tender->subCategory->logo) }}" alt="Logo">
                                    </a>
                                </div>
                                <div class="right_div">
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="{{ route('preview_tender', $tender->id) }}" class="card-link">{{ $tender->link_name }}
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>
    @else
    <div class="alert alert-danger">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
        <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="40" width="40" viewBox="0 0 24 24">
                <path fill="#f07f8f" d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z" />
                <circle cx="12" cy="17" r="1" fill="#e62a45" />
                <path fill="#e62a45" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z" /></svg></span>
        <strong>Account Validity Expired</strong>
        <hr class="message-inner-separator">
        {!! $package_info->description !!} <br>
        <div>
            <img class="img-fluid" src="{{ asset($package_info->image) }}" alt="Package Information">
        </div>
    </div>
    @endif
    @else
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <p>Hii <strong>{{ Auth::user()->name }}, (Registered Phone: {{ Auth::user()->phone }}) </strong>Welcome to Tender Bangla. </p>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                        <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="40" width="40" viewBox="0 0 24 24">
                                <path fill="#f07f8f" d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z" />
                                <circle cx="12" cy="17" r="1" fill="#e62a45" />
                                <path fill="#e62a45" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z" /></svg></span>
                        <strong>To validate your account please choose our premium package.</strong>
                        <hr class="message-inner-separator">
                        {!! $package_info->description !!}
                    </div>
                </div>
                <div class="card-footer">
                    <img class="img-fluid" src="{{ asset($package_info->image) }}" alt="Package Information">
                </div>
            </div>
        </div>
    </div>
    @endif
    @endsection
