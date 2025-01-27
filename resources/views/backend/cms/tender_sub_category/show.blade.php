@extends('backend.master')
@section('title')
CMS :: Tender Sub Category
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2>Tender<strong> Sub Category</strong></h2>
            </div>
            <div class="card-body">
                <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                <a href="{{ route('manage_tender_sub_category') }}" class="btn btn-sm btn-blue mb-3" title="Add New">
                    Manage Tender Sub Category
                </a>
                <form action="{{ route('save_tender_sub_category') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Select Category -->
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label class="form-label">Select Category*</label>
                                <select class="form-control select2-show-search form-select" name="category_id" data-placeholder="Choose one">
                                    <option label="Choose one"></option>
                                    @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->category_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-8 mb-3">
                            <div class="form-group">
                                <label for="sub_category_name" class="form-label">Sub Category Name</label>
                                <input class="form-control" name="sub_category_name" value="{{ old('sub_category_name') }}" type="text" required>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Logo Image*</div>
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
                    <div class="form-group">
                        <input class="btn btn-indigo" type="submit" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
