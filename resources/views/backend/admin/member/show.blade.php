@extends('backend.master')
@section('title')
CMS :: Member Add
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2>Add <strong>Member</strong></h2>
            </div>
            <div class="card-body">
                <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                <a href="{{ route('manage_member') }}" class="btn btn-sm btn-blue mb-3" title="Add New">
                    Manage Member
                </a>
                @if ($errors->any())
                <div class="alert alert-danger" role="alert" style="background: yellow;">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('save_member') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="row">
                        <div class="col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">User Image</div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center chat-image mb-2">
                                        <div class="mt-3">
                                            <input type="file" class="dropify" name="profile_photo_path" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="en_name" class="form-label">Full Name*</label>
                                <input class="form-control" name="name" value="{{ old('name') }}" required type="text">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="organization" class="form-label">Organization</label>
                                <input class="form-control" name="organization" value="{{ old('organization') }}" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone*</label>
                                <input class="form-control" name="phone" value="{{ old('phone') }}" required type="text">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="whatsapp" class="form-label">Whatsapp</label>
                                <input class="form-control" name="whatsapp" value="{{ old('whatsapp') }}" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control" name="email" value="{{ old('email') }}" type="email">
                            </div>
                        </div>
                        <!-- Select Area -->
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tender Preferred Area*</label>
                                <select class="form-control select2-show-search form-select" name="district_id[]" data-placeholder="Select Area" multiple>
                                    <option label="Select Area"></option>
                                    <option value="all" {{ old('district_id') == 'all' ? 'selected' : '' }}>All</option>
                                    @foreach ($districts as $item)
                                    <option value="{{ $item->id }}" {{ old('district_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->district_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="account_validity" class="form-label">Account Validity*</label>
                                <input class="form-control" name="account_validity" value="{{ old('account_validity') }}" required type="date">
                            </div>
                        </div>
                        <!-- Select Role -->
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label class="form-label">User Role*</label>
                                <select class="form-control select2-show-search form-select" name="role" data-placeholder="Select Role">
                                    <option label="Select Role"></option>
                                    <option value="0" {{ old('role') == 0 ? 'selected' : '' }}>
                                        Not Verified
                                    </option>
                                    <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>
                                        Verified Member
                                    </option>
                                    <option value="2" {{ old('role') == 2 ? 'selected' : '' }}>
                                        Super Admin
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="en_name" class="form-label">Password*</label>
                                <input class="form-control" type="password" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="en_name" class="form-label">Confirm Password*</label>
                                <input class="form-control" type="password" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" name="address" type="text">{{ old('address') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-indigo" type="submit" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
