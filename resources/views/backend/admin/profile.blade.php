@extends('backend.master')
@section('title')
Admin :: User Profile
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
                            <div class="card-title"> <strong>{{ Auth::user()->name }}</strong>'s Personal Information
                                <h6>Account Created: {{ Auth::user()->created_at->format('d M Y') }}</h6>
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
                        <div class="card-body">
                            <p><strong>Email:</strong> {{ Auth::user()->email ?? 'Not Found!' }}</p>
                            <p><strong>Number:</strong> {{ Auth::user()->phone ?? 'Not Found!' }}</p>
                            <p><strong>Whatsapp:</strong> {{ Auth::user()->whatsapp ?? 'Not Found!' }}</p>
                            <p><strong>Organization:</strong> {{ Auth::user()->organization ?? 'Not Found!' }}</p>
                            <p><strong>Address:</strong> {{ Auth::user()->address ?? 'Not Found!' }}</p>
                            <p><strong>Password:</strong> {{ Auth::user()->pw_plain_text ?? 'Not Found!' }}</p>   
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
                        <form action="{{ route('update_user_photo') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <div class="card-body">
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
                        <form action="{{ route('update_user_password') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
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
                                        <strong> <mark>Current Password: {{ Auth::user()->pw_plain_text }}</mark></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-warning"> <i class="fa fa-check"></i> Change
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
                        <form action="{{ route('update_user_name') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
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
                                            <input type="text" class="form-control" name="name" id="exampleInputname" placeholder="Name" value="{{ Auth::user()->name }}">
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
                        <form action="{{ route('update_user_email') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
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
                                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email address" value="{{ Auth::user()->email }}">
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
                            <div class="card-title">Edit Number</div>
                        </div>
                        <form action="{{ route('update_user_phone') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
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
                                            <input type="number" class="form-control" id="exampleInputnumber" name="phone" placeholder="Contact number" value="{{ Auth::user()->phone }}">
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
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Organization</div>
                        </div>
                        <form action="{{ route('update_user_organization') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
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
                                            <input type="text" class="form-control" name="organization" id="exampleInputEmail1" placeholder="Organization" value="{{ Auth::user()->organization }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-lime"> <i class="fa fa-check"></i> Change
                                    Organization</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Address</div>
                        </div>
                        <form action="{{ route('update_user_address') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
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
                                            <textarea class="form-control mb-4" id="Address" name="address" placeholder="Address" rows="4">{{ Auth::user()->address }}</textarea>
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
                            <form action="{{ route('delete_admin', ['id' => Auth::user()->id]) }}" method="post">
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
