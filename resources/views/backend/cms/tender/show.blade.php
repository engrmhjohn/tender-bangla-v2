@extends('backend.master')
@section('title')
CMS :: Tender
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2><strong>Tender</strong></h2>
            </div>
            <!-- Displaying validation errors -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card-body">
                <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                <a href="{{ route('manage_tender') }}" class="btn btn-sm btn-blue mb-3" title="Add New">
                    Manage Tender
                </a>
                <form action="{{ route('save_tender') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Select Category -->
                        <div class="col-lg-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Select Sub Category*</label>
                                <select class="form-control select2-show-search form-select" name="sub_category_id" data-placeholder="Choose one">
                                    <option label="Choose one"></option>
                                    @foreach ($sub_categories as $item)
                                    <option value="{{ $item->id }}" {{ old('sub_category_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->sub_category_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Select District -->
                        <div class="col-lg-2 mb-3">
                            <div class="form-group">
                                <label class="form-label">Select District*</label>
                                <select class="form-control select2-show-search form-select" name="district_id" data-placeholder="Choose one">
                                    <option label="Choose one"></option>
                                    @foreach ($districts as $item)
                                    <option value="{{ $item->id }}" {{ old('district_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->district_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Tender Link Name -->
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="link_name" class="form-label">Tender Link Name*</label>
                                <input class="form-control" name="link_name" type="text" value="{{ old('link_name') }}" required>
                            </div>
                        </div>


                        <!-- Tender Validity -->
                        <div class="col-lg-3 mb-3">
                            <div class="form-group">
                                <label for="tender_validity" class="form-label">Tender Validity*</label>
                                <input class="form-control" name="tender_validity" type="date" value="{{ old('tender_validity') }}" required>
                            </div>
                        </div>


                        <div class="col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Tender Image 01*</div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center chat-image mb-2">
                                        <div class="mt-3">
                                            <input type="file" class="dropify" name="tender_image_one" accept="image/*" required>
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
                                    <div class="text-center chat-image mb-2">
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
                                    <div class="text-center chat-image mb-2">
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
                                    <div class="text-center chat-image mb-2">
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
                                    <div class="text-center chat-image mb-2">
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
                                    <input type="radio" name="tender_type" id="paid" class="with-gap" checked value="1" required>
                                    <label for="paid">Paid</label>
                                </div>
                                <div class="radio inlineblock">
                                    <input type="radio" name="tender_type" id="free" class="with-gap" value="0" required>
                                    <label for="free">Free</label>
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
                                    <input type="radio" name="status" id="publish" class="with-gap" checked value="1" required>
                                    <label for="publish">Publish</label>
                                </div>
                                <div class="radio inlineblock">
                                    <input type="radio" name="status" id="unpublish" class="with-gap" value="0" required>
                                    <label for="unpublish">Unpublish</label>
                                </div>
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
