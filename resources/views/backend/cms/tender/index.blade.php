@extends('backend.master')
@section('title')
CMS :: Manage Tender
@endsection
@section('content')
<style>
    .mySlides {
        display: none
    }

</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Tender Manage
            </div>
            <div class="card-body">
                <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                <a href="{{ route('add_tender') }}" class="btn btn-blue btn-sm mb-3" title="Add New">
                    <i class="zmdi zmdi-plus" aria-hidden="true"></i> Add New
                </a>
                <div class="table-responsive">
                    <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>District</th>
                                <th>Type</th>
                                <th>Validity</th>
                                <th>Status</th>
                                <th class="bg-warning text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tender as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->link_name }}</td>
                                <td>{{ $item->subCategory->category->category_name ?? 'Not Found!'}}</td>
                                <td>{{ $item->subCategory->sub_category_name ?? 'Not Found!'}}</td>
                                <td>{{ $item->district->district_name ?? 'Not Found!'}}</td>
                                <td>{{ $item->tender_type == 0 ? 'Free' : 'Paid' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tender_validity)->format('d F Y') }}</td>
                                <td>{{ $item->status == 0 ? 'Unpublished' : 'Published' }}</td>
                                <td name="bstable-actions">
                                    <div class="btn-list d-flex justify-content-center" style="gap: 10px;">
                                        <a href="{{ route('preview_tender', $item->id) }}"><button class="btn btn-blue btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Tender Details"><span class="fe fe-eye fs-14"></span>
                                            </button></a>
                                        <a href="{{ route('edit_tender', $item->id) }}"><button class="btn btn-cyan btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span>
                                            </button></a>
                                        <form action="{{ route('delete_tender') }}" method="post" id="delete">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="tender_id" value="{{ $item->id }}">
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');" type="submit" data-bs-toggle="tooltip" data-bs-original-title="Delete"> <span class="fe fe-trash-2"> </span></button>
                                        </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection