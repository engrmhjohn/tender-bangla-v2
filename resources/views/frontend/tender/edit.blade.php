@extends('backend.master')
@section('title')
CMS :: Edit Tender
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2>Edit<strong> Tender</strong></h2>
            </div>
            <div class="card-body">
                <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                <a href="{{ route('manage_tender') }}" class="btn btn-sm btn-blue mb-3">
                    <i class="fa fa-mail-reply"></i> Back to Manage Tender
                </a>
                <form action="{{ route('update_tender') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tender_id" value="{{$tender->id}}">
                    <div class="row">
                        <!-- Select District -->
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label>District</label>
                                <select name="district_id" class="form-control form-select select2" data-bs-placeholder="Choose one">
                                    <option value="" disabled selected></option>
                                    @foreach ($districts as $item)
                                    <option value=" {{ $item->id }}" {{ isset($tender->district_id) ? ($tender->district_id == $item->id ? 'selected' : '') : '' }}>{{ $item->district_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Tender Title -->
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="tender_title">Tender Name*</label>
                                <input class="form-control" name="tender_title" type="text" required value="{{ isset($tender->tender_title) ? $tender->tender_title : '' }}">
                            </div>
                        </div>

                        <!-- Tender Link Name -->
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="link_name">Tender Link Name*</label>
                                <input class="form-control" name="link_name" type="text" required value="{{ isset($tender->link_name) ? $tender->link_name : '' }}">
                            </div>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Edit Logo Image</div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-2">
                                        <img src="{{ asset($tender->logo) }}" style="width: 10rem; height: auto;" alt="Logo Not Found">
                                        <div class="mt-3">
                                            <input type="file" class="dropify" name="logo" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Tender Image 01*</div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-2">
                                        <img src="{{ asset($tender->tender_image_one) }}" style="width: 10rem; height: auto;" alt="Tender Image 01 Not Found">
                                        <div class="mt-3">
                                            <input type="file" class="dropify" name="tender_image_one" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Tender Image 02</div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-2">
                                        <img src="{{ asset($tender->tender_image_two) }}" style="width: 10rem; height: auto;" alt="Tender Image 02 Not Found">
                                        <div class="mt-3">
                                            <input type="file" class="dropify" name="tender_image_two" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Tender Image 03</div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-2">
                                        <img src="{{ asset($tender->tender_image_three) }}" style="width: 10rem; height: auto;" alt="Tender Image 03 Not Found">
                                        <div class="mt-3">
                                            <input type="file" class="dropify" name="tender_image_three" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Tender Image 04</div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-2">
                                        <img src="{{ asset($tender->tender_image_four) }}" style="width: 10rem; height: auto;" alt="Tender Image 04 Not Found">
                                        <div class="mt-3">
                                            <input type="file" class="dropify" name="tender_image_four" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Tender Image 05</div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-2">
                                        <img src="{{ asset($tender->tender_image_five) }}" style="width: 10rem; height: auto;" alt="Tender Image 04 Not Found">
                                        <div class="mt-3">
                                            <input type="file" class="dropify" name="tender_image_five" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            Tender Type
                        </div>
                        <div class="col-md-9 mt-3">
                            <div class="form-group">
                                <div class="radio inlineblock m-r-20">
                                    <input type="radio" name="premium" id="premium_tender" class="with-gap" {{ isset($tender->premium) && $tender->premium == 1 ? 'checked' : '' }} checked value="1" required>
                                    <label for="premium_tender">Premium</label>
                                </div>
                                <div class="radio inlineblock">
                                    <input type="radio" name="premium" id="regular_tender" class="with-gap" {{ isset($tender->premium) && $tender->premium == 0 ? 'checked' : '' }} value="0" required>
                                    <label for="regular_tender">Regular</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            Status
                        </div>
                        <div class="col-md-9 mt-3">
                            <div class="form-group">
                                <div class="radio inlineblock m-r-20">
                                    <input type="radio" name="status" id="publish" class="with-gap" {{ isset($tender->status) && $tender->status == 1 ? 'checked' : '' }} checked value="1">
                                    <label for="publish">Publish</label>
                                </div>
                                <div class="radio inlineblock">
                                    <input type="radio" name="status" id="unpublish" class="with-gap" {{ isset($tender->status) && $tender->status == 0 ? 'checked' : '' }} value="0">
                                    <label for="unpublish">Unpublish</label>
                                </div>
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
