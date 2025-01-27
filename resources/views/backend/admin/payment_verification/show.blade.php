@extends('backend.master')
@section('title')
CMS :: Payment Verification
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2>Give<strong> transaction information to get validate</strong></h2>
            </div>
            <div class="card-body">
                <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                <form action="{{ route('save_payment_verification') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 mb-5">
                            <div class="form-group">
                                <label class="form-label">Select Member*</label>
                                <select class="form-control select2-show-search form-select" name="member_id" data-placeholder="Choose one" required>
                                        <option label="Choose one"></option>
                                        @foreach ($members as $item)
                                        <option value="{{ $item->id }}" {{ old('member_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }} - {{ $item->phone }}
                                        </option>
                                        @endforeach

                                    </select>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-5">
                            <div class="form-group">
                                <label class="form-label">Payment Method*</label>
                                <select class="form-control select2-show-search form-select" name="gateway_name" data-placeholder="Choose one" required>
                                        <option label="Choose one"></option>
                                        <option value="Bkash">Bkash</option>
                                        <option value="Rocket">Rocket</option>
                                        <option value="Nagad">Nagad</option>
                                        <option value="Bank Account">Bank Account</option>
                                        <option value="Others">Others</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="account_validity" class="form-label">Account Validity*</label>
                                <input class="form-control" name="account_validity" id="account_validity" type="date" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="sender_number" class="form-label">Mobile Number*</label>
                                <input class="form-control" name="sender_number" id="sender_number" type="text" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="transaction_number" class="form-label">Transaction ID*</label>
                                <input class="form-control" name="transaction_number" id="transaction_number" type="text" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="amount" class="form-label">Amount*</label>
                                <input class="form-control" name="amount" id="amount" type="number" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-indigo" type="submit" value="Verify Payment">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection