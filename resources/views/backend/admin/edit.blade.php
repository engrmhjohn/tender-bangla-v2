@extends('backend.master')
@section('title')
Admin :: User Profile
@endsection
@section('content')
<!-- PAGE -->
@php
$districts = \App\Models\District::orderBy('district_name', 'asc')->get();
@endphp
<div class="page">
    <div class="page-main">
        <!-- Theme-Layout -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"> <strong>{{ $user->name }}</strong>'s Personal Information
                                <h6>Account Created: {{ $user->created_at->format('d M Y') }}</h6>
                                <strong>Role: @if ($user->role == 2)
                                    Super Admin <i class="fa fa-check-circle"></i>
                                    @elseif($user->role == 1)
                                    Verified Member <i class="fa fa-check-circle"></i>
                                    @else
                                    Not Verified
                                    @endif
                                </strong>
                                <h6 class="text-muted">Account Validity Till: {{ \Carbon\Carbon::parse($user->account_validity)->format('d M Y') }}</h6>
                            </div>
                        </div>
                        <div class="card-body">
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
                                            <th>Action</th>
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
                                            <td name="bstable-actions">
                                                <div class="btn-list d-flex justify-content-center" style="gap: 10px;">
                                                    <a href="{{ route('edit_member_payment_info', $item->id) }}"><button class="btn btn-blue btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span>
                                                        </button></a>
                                                    <form action="{{ route('delete_member_payment_info') }}" method="post" id="delete">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" name="payment_info_id" value="{{ $item->id }}">
                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');" type="submit" data-bs-toggle="tooltip" data-bs-original-title="Delete"> <span class="fe fe-trash-2"> </span></button>
                                                    </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Profile Image</div>
                        </div>
                        <form action="{{ route('update_user_photo_by_admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="card-body">
                                <div class="text-center chat-image mb-2">
                                    <div class="avatar avatar-xxl chat-profile mb-3 brround">
                                        @if ($user->profile_photo_path)
                                        <img src="{{ asset($user->profile_photo_path) }}" class="brround" style="width: 5rem; height: 5rem;" alt="Picture Not Found">
                                        @else
                                        <img alt="avatar" src="{{ asset('backendAssets') }}/images/avatar/avatar.png" class="brround">
                                        @endif
                                    </div>
                                    <div class="main-chat-msg-name">
                                        <h5 class="mb-1 text-dark fw-semibold">{{ $user->name }}</h5>
                                        @if ($user->role == '2')
                                        <p class="text-muted mt-0 mb-0 pt-0 fs-13">Super Admin <i class="fa fa-check-circle"></i> </p>
                                        @elseif($user->role == '1')
                                        <p class="text-muted mt-0 mb-0 pt-0 fs-13">Verified Member <i class="fa fa-check-circle"></i> </p>
                                        @else
                                        <p class="text-muted mt-0 mb-0 pt-0 fs-13">Not Verified</p>
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        <input type="file" class="dropify" name="profile_photo_path" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> Change
                                    Photo</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Change Password</div>
                            @if ($errors->has('password'))
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    <li>{{ $errors->first('password') }}</li>
                                </ul>
                            </div>
                            @endif
                        </div>
                        <form action="{{ route('update_user_password_by_admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputnddame">New Password</label>
                                            <input type="text" class="form-control" name="password" id="exampleInputnddame">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInsasputname">Confirm New Password</label>
                                            <input type="text" class="form-control" name="password_confirmation" id="exampleInsasputname">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <strong> <mark>Current Password: {{ $user->pw_plain_text }}</mark></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-blue"> <i class="fa fa-check"></i> Change
                                    Password</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Tender Areas</div>
                        </div>
                        <form action="{{ route('update_user_tender_area_by_admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="card-body">
                                @if ($errors->has('district_id'))
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        <li>{{ $errors->first('district_id') }}</li>
                                    </ul>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Select Areas</label>
                                            <select class="form-control select2" data-placeholder="Choose Areas" name="district_id[]" multiple>
                                                @foreach ($districts as $district)
                                                <option value="{{ $district->id }}" @if (in_array($district->id, $selectedDistricts)) selected @endif>
                                                    {{ $district->district_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-green"> <i class="fa fa-check"></i> Change
                                        Areas</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Name</div>
                        </div>
                        <form action="{{ route('update_user_name_by_admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="card-body">
                                @if ($errors->has('name'))
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        <li>{{ $errors->first('name') }}</li>
                                    </ul>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputname">Name</label>
                                            <input type="text" class="form-control" name="name" id="exampleInputname" placeholder="Name" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-dark"> <i class="fa fa-check"></i> Change
                                    Name</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Number</div>
                        </div>
                        <form action="{{ route('update_user_phone_by_admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="card-body">
                                @if ($errors->has('phone'))
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        <li>{{ $errors->first('phone') }}</li>
                                    </ul>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputnumber">Contact Number</label>
                                            <input type="number" class="form-control" id="exampleInputnumber" name="phone" placeholder="Contact number" value="{{ $user->phone }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-cyan"> <i class="fa fa-check"></i> Change
                                    Number</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Whatsapp</div>
                        </div>
                        <form action="{{ route('update_user_whatsapp_by_admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="card-body">
                                @if ($errors->has('whatsapp'))
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        <li>{{ $errors->first('whatsapp') }}</li>
                                    </ul>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputnumber">Whatsapp Number</label>
                                            <input type="number" class="form-control" id="exampleInputnumber" name="whatsapp" placeholder="Whatsapp number" value="{{ $user->whatsapp }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-cyan"> <i class="fa fa-check"></i> Change
                                    Whatsapp</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Payment Record</div>
                        </div>
                        <form action="{{ route('save_payment_verification') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="member_id" value="{{ $user->id }}">
                            <div class="card-body">
                                @if ($errors->has('gateway_name'))
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        <li>{{ $errors->first('gateway_name') }}</li>
                                    </ul>
                                </div>
                                @endif
                                @if ($errors->has('account_validity'))
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        <li>{{ $errors->first('account_validity') }}</li>
                                    </ul>
                                </div>
                                @endif
                                @if ($errors->has('sender_number'))
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        <li>{{ $errors->first('sender_number') }}</li>
                                    </ul>
                                </div>
                                @endif
                                @if ($errors->has('transaction_number'))
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        <li>{{ $errors->first('transaction_number') }}</li>
                                    </ul>
                                </div>
                                @endif
                                @if ($errors->has('amount'))
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        <li>{{ $errors->first('amount') }}</li>
                                    </ul>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Payment Method*</label>
                                            <select class="form-control select2-show-search form-select" name="gateway_name" data-placeholder="Choose one" required>
                                                    <option label="Choose one"></option>
                                                    <option value="Bkash">Bkash</option>
                                                    <option value="Rocket">Rocket</option>
                                                    <option value="Nagad">Nagad</option>
                                                    <option value="Bank Account">Bank Account</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="account_validity">Account Validity</label>
                                            <input type="date" class="form-control" id="account_validity" name="account_validity">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sender_number" class="form-label">Mobile Number*</label>
                                            <input class="form-control" name="sender_number" id="sender_number" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="transaction_number" class="form-label">Transaction ID*</label>
                                            <input class="form-control" name="transaction_number" id="transaction_number" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="amount" class="form-label">Amount*</label>
                                            <input class="form-control" name="amount" id="amount" type="number" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-blue"> <i class="fa fa-check"></i> Change
                                    Payment Info</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Email</div>
                        </div>
                        <form action="{{ route('update_user_email_by_admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="card-body">
                                @if ($errors->has('email'))
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        <li>{{ $errors->first('email') }}</li>
                                    </ul>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email address" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-orange"> <i class="fa fa-check"></i> Change
                                    Email</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Organization</div>
                        </div>
                        <form action="{{ route('update_user_organization_by_admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="card-body">
                                @if ($errors->has('nid_number'))
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        <li>{{ $errors->first('nid_number') }}</li>
                                    </ul>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Organization</label>
                                            <input type="text" class="form-control" name="organization" id="exampleInputEmail1" placeholder="Organization" value="{{ $user->organization }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-blue"> <i class="fa fa-check"></i> Change
                                    Organization</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Address</div>
                        </div>
                        <form action="{{ route('update_user_address_by_admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="card-body">
                                @if ($errors->has('bmdc_number'))
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        <li>{{ $errors->first('bmdc_number') }}</li>
                                    </ul>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Address">Address</label>
                                            <textarea class="form-control mb-4" id="Address" name="address" placeholder="Address" rows="4">{{ $user->address }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-indigo"> <i class="fa fa-check"></i> Change
                                    Address</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Delete Account</div>
                        </div>
                        <div class="card-body">
                            <p>Please note, if you delete your account all of your data will be erased.</p>
                        </div>
                        <div class="card-footer text-end">
                            <form action="{{ route('delete_admin_by_admin', ['id' => $user->id]) }}" method="post">
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?');" type="submit"> <span class="fe fe-trash-2"> </span> Delete Account</button>
                                @csrf
                                @method('delete')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ROW-1 CLOSED -->
        </div>


    </div>
</div>
<!-- End PAGE -->
@endsection
