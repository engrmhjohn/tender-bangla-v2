@extends('backend.master')
@section('title')
CMS :: Edit Helpline Logo
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2>Helpline<strong> Logo</strong></h2>
            </div>
            <div class="card-body">
                <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                <a href="{{ route('manage_helpline') }}" class="btn btn-sm btn-blue mb-3">
                    <i class="fa fa-mail-reply"></i> Back to Manage Helpline Logo
                </a>
                <form action="{{ route('update_helpline') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="helpline_id" value="{{$helpline->id}}">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label for="helpline_name">Helpline Name</label>
                                <input type="text" class="form-control" name="helpline_name" required value="{{ isset($helpline->helpline_name) ? $helpline->helpline_name : '' }}">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label for="helpline_link">Helpline Logo Link</label>
                                <input class="form-control" name="helpline_link" type="text" required value="{{ isset($helpline->helpline_link) ? $helpline->helpline_link : '' }}">
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
                                    <input type="radio" name="status" id="publish" class="with-gap" {{ isset($helpline->status) && $helpline->status == 1 ? 'checked' : '' }} checked value="1">
                                    <label for="publish">Publish</label>
                                </div>
                                <div class="radio inlineblock">
                                    <input type="radio" name="status" id="unpublish" class="with-gap" {{ isset($helpline->status) && $helpline->status == 0 ? 'checked' : '' }} value="0">
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