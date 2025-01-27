@extends('backend.master')
@section('title')
    CMS :: Showing Package Info
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Showing Package info
                </div>
                <div class="card-body">
                    <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                    {!! $package_info->description !!} <br>

                    <img src="{{ asset($package_info->image) }}" alt="Package Info Image">
                </div>
                <div class="card-footer">
                    <a href="{{ route('edit_package_info', $package_info->id) }}"><button
                        class="btn btn-primary btn-sm" data-bs-toggle="tooltip"
                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span>
                        Edit Package Info</button></a>
                </div>
            </div>
        </div>

    </div>
@endsection
