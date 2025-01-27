@extends('backend.master')
@section('title')
CMS :: Payment Verification
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2>Edit<strong> transaction information to get validate</strong></h2>
            </div>
            <div class="card-body">
                <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                <form action="{{ route('update_member_payment_info') }}" method="post">
                    @csrf
                    <input type="hidden" name="payment_info_id" value="{{$payment->id}}">
                    <input type="hidden" name="member_id" value="{{ $payment->member_id }}">
                    <div class="row">
                        <div class="col-lg-4 mb-5">
                            <div class="form-group">
                                <label class="form-label">Payment Method*</label>
                                <select class="form-control select2-show-search form-select" name="gateway_name" data-placeholder="Choose one" required>
                                    <option label="Choose one"></option>
                                    <option value="Bkash" {{ (isset($payment) && $payment->gateway_name == 'Bkash') ? 'selected' : '' }}>Bkash</option>
                                    <option value="Rocket" {{ (isset($payment) && $payment->gateway_name == 'Rocket') ? 'selected' : '' }}>Rocket</option>
                                    <option value="Nagad" {{ (isset($payment) && $payment->gateway_name == 'Nagad') ? 'selected' : '' }}>Nagad</option>
                                    <option value="Bank Account" {{ (isset($payment) && $payment->gateway_name == 'Bank Account') ? 'selected' : '' }}>Bank Account</option>
                                    <option value="Others" {{ (isset($payment) && $payment->gateway_name == 'Others') ? 'selected' : '' }}>Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="account_validity" class="form-label">Account Validity*</label>
                                <input class="form-control" name="account_validity" id="account_validity" value="{{ isset($payment->account_validity) ? $payment->account_validity : '' }}" type="date" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="sender_number" class="form-label">Mobile Number*</label>
                                <input class="form-control" name="sender_number" id="sender_number" value="{{ isset($payment->sender_number) ? $payment->sender_number : '' }}" type="text" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="transaction_number" class="form-label">Transaction ID*</label>
                                <input class="form-control" name="transaction_number" id="transaction_number" value="{{ isset($payment->transaction_number) ? $payment->transaction_number : '' }}" type="text" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="amount" class="form-label">Amount*</label>
                                <input class="form-control" name="amount" id="amount" value="{{ isset($payment->amount) ? $payment->amount : '' }}" type="number" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-indigo" type="submit" value="Update Payment Info">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
