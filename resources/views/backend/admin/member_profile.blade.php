@extends('backend.master')
@section('title')
Admin :: User Profile
@endsection
@section('content')
<!-- PAGE -->
@php
        $payments = \App\Models\PaymentVerification::where('member_id', Auth::user()->id)
        ->orderBy('id', 'desc')
        ->get();
@endphp
<div class="page">
    <div class="page-main">
        <!-- Theme-Layout -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header justify-content-center">
                            <div class="text-center chat-image mb-2">
                                <div class="avatar avatar-xxl chat-profile mb-3 brround">
                                    @if (Auth::user()->profile_photo_path)
                                    <img src="{{ asset(Auth::user()->profile_photo_path) }}" class="brround" style="width: 5rem; height: 5rem;" alt="Picture Not Found">
                                    @else
                                    <img alt="avatar" src="{{ asset('backendAssets') }}/images/avatar/avatar.png" class="brround">
                                    @endif
                                </div>
                                <div class="main-chat-msg-name">
                                    <h5 class="mb-1 text-dark fw-semibold">{{ Auth::user()->name }}</h5>
                                    @if (Auth::user()->role == '2')
                                    <p class="text-muted mt-0 mb-0 pt-0 fs-13">Super Admin <i class="fa fa-check-circle"></i> </p>
                                    @elseif(Auth::user()->role == '1')
                                    <p class="text-muted mt-0 mb-0 pt-0 fs-13">Verified Member <i class="fa fa-check-circle"></i> </p>
                                    @else
                                    <p class="text-muted mt-0 mb-0 pt-0 fs-13">Not Verified</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-title"> <strong>{{ Auth::user()->name }}</strong>'s Personal Information
                                <h6><strong>Account Created:</strong> {{ Auth::user()->created_at->format('d M Y') }}</h6>
                                <h6><strong>Account Validity:</strong> {{ \Carbon\Carbon::parse(Auth::user()->account_validity)->format('d M Y') }}</h6>                                
                                <strong>Role: @if (Auth::user()->role == 2)
                                    Super Admin <i class="fa fa-check-circle"></i>
                                    @elseif(Auth::user()->role == 1)
                                    Verified Member <i class="fa fa-check-circle"></i>
                                    @else
                                    Not Verified
                                    @endif
                                </strong>
                            </div>
                        </div>
                        <div class="card-footer">
                            <p><strong>Email:</strong> {{ Auth::user()->email ?? 'Not Found!' }}</p>
                            <p><strong>Number:</strong> {{ Auth::user()->phone ?? 'Not Found!' }}</p>
                            <p><strong>Whatsapp:</strong> {{ Auth::user()->whatsapp ?? 'Not Found!' }}</p>
                            <p><strong>Organization:</strong> {{ Auth::user()->organization ?? 'Not Found!' }}</p>
                            <p><strong>Address:</strong> {{ Auth::user()->address ?? 'Not Found!' }}</p>
                            <p><strong>Password:</strong> {{ Auth::user()->pw_plain_text ?? 'Not Found!' }}</p>                            
                            {{-- <h6>Tender Preferred Area: {{ implode(', ', json_decode(Auth::user()->district_id)) }} </h6> --}}
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap key-buttons border-bottom">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Payment Method</th>
                                            <th>Account Validity</th>
                                            <th>Sender Number</th>
                                            <th>Transaction ID</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->gateway_name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->account_validity)->format('d M Y') }}</td>
                                                <td>{{ $item->sender_number }}</td>
                                                <td>{{ $item->transaction_number }}</td>
                                                <td>{{ $item->amount }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- End PAGE -->
@endsection
