@extends('backend.master')
@section('title')
CMS :: Edit Package Info
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2>Edit<strong> Package Info</strong></h2>
            </div>
            <div class="card-body">
                <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                <form action="{{ route('update_package_info') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="package_info_id" value="{{$package_info->id}}">
                    <div class="row">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Package Info</h3>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="content" name="description">{{ isset($package_info->description) ? $package_info->description : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Package Info Image*</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center chat-image mb-2">
                                            <div class="mt-3">
                                                <img src="{{ asset($package_info->image) }}" alt="Not Found!">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Choose New Package Info Image*</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center chat-image mb-2">
                                            <div class="mt-3">
                                                <input type="file" class="dropify" name="image" accept="image/*">
                                            </div>
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