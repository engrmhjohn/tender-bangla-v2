@extends('backend.master')
@section('title')
CMS :: Tender Category
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2>Tender<strong> Category</strong></h2>
            </div>
            <div class="card-body">
                <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                <a href="{{ route('manage_tender_category') }}" class="btn btn-sm btn-blue mb-3" title="Add New">
                    Manage Tender Category
                </a>
                <form action="{{ route('save_tender_category') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="category_name">Category Name</label>
                                <input class="form-control" name="category_name" value="{{ old('category_name') }}" type="text" required>
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