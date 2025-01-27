@extends('backend.master')
@section('title')
CMS :: Edit Tender Notice
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2><strong> Tender Notice</strong></h2>
            </div>
            <div class="card-body">
                <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                <a href="{{ route('manage_important_notice') }}" class="btn btn-sm btn-blue mb-3">
                    <i class="fa fa-mail-reply"></i> Back to Manage Tender Notice
                </a>
                <form action="{{ route('update_important_notice') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="important_notice_id" value="{{$important_notice->id}}">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label for="notice_title">Tender Notice Title</label>
                                <input class="form-control" name="notice_title" type="text" required value="{{ isset($important_notice->notice_title) ? $important_notice->notice_title : '' }}">
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
                                    <input type="radio" name="status" id="publish" class="with-gap" {{ isset($important_notice->status) && $important_notice->status == 1 ? 'checked' : '' }} checked value="1">
                                    <label for="publish">Publish</label>
                                </div>
                                <div class="radio inlineblock">
                                    <input type="radio" name="status" id="unpublish" class="with-gap" {{ isset($important_notice->status) && $important_notice->status == 0 ? 'checked' : '' }} value="0">
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