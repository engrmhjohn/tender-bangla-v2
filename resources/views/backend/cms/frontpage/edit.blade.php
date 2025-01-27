@extends('backend.master')
@section('title')
CMS :: Home Page Content Update
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Home Page Content Update
            </div>
            <div class="card-body">
                <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                @if ($errors->any())
                <div class="alert alert-danger" role="alert" style="background: yellow;">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('update_homepage_content') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="homepage_cms_id" value="{{$homepage_cms->id}}">
                    <div class="row">
                        <div class="col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Tender Bangla Logo*</div>
                                </div>
                                <div class="card-body bg-info">
                                    <div class="text-center chat-image mb-2">
                                        <div class="mt-3">
                                            <img src="{{ asset($homepage_cms->logo) }}" alt="Logo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Choose New Logo*</div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center chat-image mb-2">
                                        <div class="mt-3">
                                            <input type="file" class="dropify" name="logo" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="login_register_btn_text">Login / Register Button Text*</label>
                                <input class="form-control" name="login_register_btn_text" value="{{ $homepage_cms->login_register_btn_text }}" type="text" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="header_banner_text">Header Banner Text*</label>
                                <input class="form-control" name="header_banner_text" value="{{ $homepage_cms->header_banner_text }}" type="text" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="header_btn_text">Header Button Text*</label>
                                <input class="form-control" name="header_btn_text" value="{{ $homepage_cms->header_btn_text }}" type="text" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Header Banner Image*</div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center chat-image mb-2">
                                        <div class="mt-3">
                                            <img src="{{ asset($homepage_cms->header_banner_image) }}" alt="Header Banner">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Choose New Image*</div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center chat-image mb-2">
                                        <div class="mt-3">
                                            <input type="file" class="dropify" name="header_banner_image" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="category_btn_text">Category Button Text*</label>
                                <input class="form-control" name="category_btn_text" value="{{ $homepage_cms->category_btn_text }}" type="text" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="contact_header_text">Contact Header Text*</label>
                                <input class="form-control" name="contact_header_text" value="{{ $homepage_cms->contact_header_text }}" type="text" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="office_address">Office Address*</label>
                                <input class="form-control" name="office_address" value="{{ $homepage_cms->office_address }}" type="text" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="contact_email_one">Contact Email 01*</label>
                                <input class="form-control" name="contact_email_one" value="{{ $homepage_cms->contact_email_one }}" type="email" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="contact_email_two">Contact Email 02</label>
                                <input class="form-control" name="contact_email_two" value="{{ $homepage_cms->contact_email_two }}" type="email">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="contact_phone_one">Contact Phone 01*</label>
                                <input class="form-control" name="contact_phone_one" value="{{ $homepage_cms->contact_phone_one }}" type="number" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="contact_phone_two">Contact Phone 02</label>
                                <input class="form-control" name="contact_phone_two" value="{{ $homepage_cms->contact_phone_two }}" type="number">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="facebook_link">Facebook Link</label>
                                <input class="form-control" name="facebook_link" value="{{ $homepage_cms->facebook_link }}" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="youtube_link">Youtube Link</label>
                                <input class="form-control" name="youtube_link" value="{{ $homepage_cms->youtube_link }}" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="whatsapp_number">Whatsapp Number</label>
                                <input class="form-control" name="whatsapp_number" value="{{ $homepage_cms->whatsapp_number }}" type="number">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-indigo" type="submit" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
