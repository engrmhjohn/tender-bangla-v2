@extends('backend.master')
@section('title')
CMS :: Package Info
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2>Package<strong>Info</strong></h2>
            </div>
            <div class="card-body">
                <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                <a href="{{ route('manage_package_info') }}" class="btn btn-sm btn-blue mb-3" title="Add New">
                    Manage Package
                </a>
                <form action="{{ route('save_package_info') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Package Info</h3>
                                </div>
                                <div class="card-body">
                                    <textarea class="content" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Package Information*</div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center chat-image mb-2">
                                        <div class="mt-3">
                                            <input type="file" class="dropify" name="image" accept="image/*" required>
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