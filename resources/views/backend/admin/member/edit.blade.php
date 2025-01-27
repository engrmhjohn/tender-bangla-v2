@extends('backend.master')
@section('title')
Member :: User Profile
@endsection
@section('content')
<!-- PAGE -->
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
                        <div class="card-header">
                            <div class="card-title"> <strong>{{ $member->name }}</strong>'s Personal Information
                                <h6>Account Created: {{ $member->created_at->format('d M Y') }}</h6>
                                <strong>Role: @if ($member->role == 3)
                                    Verfied Member
                                    @else
                                    Not Verified
                                    @endif
                                </strong>
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
                        <form action="{{ route('update_member_photo_by_admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $member->id }}">
                            <div class="card-body">
                                <div class="text-center chat-image mb-2">
                                    <div class="avatar avatar-xxl chat-profile mb-3 brround">
                                        @if ($member->profile_photo_path)
                                        <img src="{{ asset($member->profile_photo_path) }}" class="brround" style="width: 5rem; height: 5rem;" alt="Picture Not Found">
                                        @else
                                        <img alt="avatar" src="{{ asset('backendAssets') }}/images/avatar/avatar.png" class="brround">
                                        @endif
                                    </div>
                                    <div class="main-chat-msg-name">
                                        <h5 class="mb-1 text-dark fw-semibold">{{ $member->name }}</h5>
                                        @if ($member->role == '3')
                                        <p class="text-muted mt-0 mb-0 pt-0 fs-13">Verified Member</p>
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
                                <button type="submit" class="btn btn-secondary"> <i class="fa fa-check"></i> Change
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
                        <form action="{{ route('update_member_password_by_admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $member->id }}">
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
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-blue"> <i class="fa fa-check"></i> Change
                                    Password</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Name</div>
                        </div>
                        <form action="{{ route('update_member_name_by_admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $member->id }}">
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
                                            <input type="text" class="form-control" name="name" id="exampleInputname" placeholder="Name" value="{{ $member->name }}">
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
                            <div class="card-title">Edit Email</div>
                        </div>
                        <form action="{{ route('update_member_email_by_admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $member->id }}">
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
                                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email address" value="{{ $member->email }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Change
                                    Email</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Organization Name</div>
                        </div>
                        <form action="{{ route('update_member_organization_by_admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $member->id }}">
                            <div class="card-body">
                                @if ($errors->has('organization'))
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        <li>{{ $errors->first('organization') }}</li>
                                    </ul>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Organization Name</label>
                                            <input type="text" class="form-control" name="organization" id="exampleInputEmail1" placeholder="Organization Name" value="{{ $member->organization }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-orange"> <i class="fa fa-check"></i> Change
                                    Organization</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Phone Number</div>
                        </div>
                        <form action="{{ route('update_member_phone_by_admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $member->id }}">
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
                                            <input type="number" class="form-control" id="exampleInputnumber" name="phone" placeholder="Contact number" value="{{ $member->phone }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> Change
                                    Number</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit BMDC Number</div>
                        </div>
                        <form action="{{ route('update_user_bmdc') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $member->id }}">
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
                                            <label for="exampleInputnumber">BMDC Number</label>
                                            <input type="number" class="form-control" id="exampleInputnumber" name="bmdc_number" placeholder="BMDC Number" value="{{ $member->bmdc_number }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-cyan"> <i class="fa fa-check"></i> Change
                                    BMDC Number</button>
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
                            <form action="{{ route('delete_member_by_admin', ['id' => $member->id]) }}" method="post">
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
