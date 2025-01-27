@extends('backend.master')
@section('title')
CMS :: Edit Tender Sub Category
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
                <a href="{{ route('manage_tender_sub_category') }}" class="btn btn-sm btn-blue mb-3">
                    <i class="fa fa-mail-reply"></i> Back to Manage Tender Category
                </a>
                <form action="{{ route('update_tender_sub_category') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tender_sub_category_id" value="{{$tender_sub_category->id}}">
                    <div class="row">
                        <!-- Select Category -->
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-control form-select select2" data-bs-placeholder="Choose one">
                                    <option value="" disabled selected></option>
                                    @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" {{ isset($tender_sub_category->category_id) ? ($tender_sub_category->category_id == $item->id ? 'selected' : '') : '' }}>{{ $item->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-8 mb-3">
                            <div class="form-group">
                                <label for="sub_category_name" class="form-label">Tender Sub Category Name</label>
                                <input class="form-control" name="sub_category_name" type="text" required value="{{ isset($tender_sub_category->sub_category_name) ? $tender_sub_category->sub_category_name : '' }}">
                            </div>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Edit Logo Image</div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-2">
                                        <img src="{{ asset($tender_sub_category->logo) }}" style="width: 10rem; height: auto;" alt="Logo Not Found">
                                        <div class="mt-3">
                                            <input type="file" class="dropify" name="logo" accept="image/*">
                                        </div>
                                    </div>
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
