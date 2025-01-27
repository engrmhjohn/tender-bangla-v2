@extends('backend.master')
@section('title')
CMS :: Front Page
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2>Front Page<strong> Content</strong></h2>
            </div>
            <div class="card-body">
                <button class="btn btn-sm btn-blue mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                <form action="{{ route('save_homepage_content') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Tender Bangla Logo*</div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center chat-image mb-2">
                                        <div class="mt-3">
                                            <input type="file" class="dropify" name="logo" accept="image/*" required>
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
                                <input class="form-control" name="login_register_btn_text" value="{{ old('login_register_btn_text') }}" type="text" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="header_banner_text">Header Banner Text*</label>
                                <input class="form-control" name="header_banner_text" value="{{ old('header_banner_text') }}" type="text" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="header_btn_text">Header Button Text*</label>
                                <input class="form-control" name="header_btn_text" value="{{ old('header_btn_text') }}" type="text" required>
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
                                            <input type="file" class="dropify" name="header_banner_image" accept="image/*" required>
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
                                <input class="form-control" name="category_btn_text" value="{{ old('category_btn_text') }}" type="text" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="contact_header_text">Contact Header Text*</label>
                                <input class="form-control" name="contact_header_text" value="{{ old('contact_header_text') }}" type="text" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="office_address">Office Address*</label>
                                <input class="form-control" name="office_address" value="{{ old('office_address') }}" type="text" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="contact_email_one">Contact Email 01*</label>
                                <input class="form-control" name="contact_email_one" value="{{ old('contact_email_one') }}" type="email" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="contact_email_two">Contact Email 02</label>
                                <input class="form-control" name="contact_email_two" value="{{ old('contact_email_two') }}" type="email">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="contact_phone_one">Contact Phone 01*</label>
                                <input class="form-control" name="contact_phone_one" value="{{ old('contact_phone_one') }}" type="number" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="contact_phone_two">Contact Phone 02</label>
                                <input class="form-control" name="contact_phone_two" value="{{ old('contact_phone_two') }}" type="number">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="facebook_link">Facebook Link</label>
                                <input class="form-control" name="facebook_link" value="{{ old('facebook_link') }}" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="youtube_link">Youtube Link</label>
                                <input class="form-control" name="youtube_link" value="{{ old('youtube_link') }}" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="whatsapp_number">Whatsapp Number</label>
                                <input class="form-control" name="whatsapp_number" value="{{ old('whatsapp_number') }}" type="number">
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