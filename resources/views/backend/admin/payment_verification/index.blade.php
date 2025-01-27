@extends('backend.master')
@section('title')
Admin :: Payment Info Management
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Payment Info Management</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                <a href="{{ route('show_payment_verification') }}" class="btn btn-blue btn-sm mb-3" title="Add New">
                    <i class="zmdi zmdi-plus" aria-hidden="true"></i> Add New
                </a>
                <div class="table-responsive">
                    <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Payment Method</th>
                                <th>Account Validity</th>
                                <th>Sender Number</th>
                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paymentVerification as $item)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user ? $item->user->name : 'No user assigned' }}</td>
                                <td>{{ $item->gateway_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->account_validity)->format('d M Y') }}</td>
                                <td>{{ $item->sender_number }}</td>
                                <td>{{ $item->transaction_number }}</td>
                                <td>{{ $item->amount }}</td>
                                <td name="bstable-actions">
                                    <div class="btn-list d-flex justify-content-center" style="gap: 10px;">
                                        <a href="{{ route('edit_payment_verification', $item->id) }}"><button class="btn btn-blue btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span>
                                            </button></a>
                                        <form action="{{ route('delete_payment_verification') }}" method="post" id="delete">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="payment_verification_id" value="{{ $item->id }}">
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
