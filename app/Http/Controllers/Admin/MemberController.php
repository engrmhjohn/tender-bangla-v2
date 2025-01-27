<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Package;
use App\Models\PaymentVerification;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

require_once app_path('Helper/image.php');

class MemberController extends Controller
{
    public function addMember()
    {
        return view('backend.admin.member.show', [
            'districts' => District::orderby('district_name', 'asc')->get(),
        ]);
    }

    public function saveMember(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'district_id' => 'required|array', // Accept district_id as an array
            'organization' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|unique:users',
            'role' => 'required|integer',
            'account_validity' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email ?? null,
            'password' => Hash::make($request->password),
            'pw_plain_text' => $request->password,
            'district_id' => json_encode($request->district_id), // Convert to JSON
            'organization' => $request->organization ?? null,
            'address' => $request->address ?? null,
            'whatsapp' => $request->whatsapp ?? null,
            'role' => $request->role ?? 0,
            'account_validity' => $request->account_validity ?? null,
        ]);

        return redirect()->route('manage_member')->with('message', 'Member created successfully.');
    }



    public function manageMember()
    {
        return view('backend.admin.member.index', [
            'members' => User::orderBy('id', 'desc')->get()
        ]);
    }
    public function pendingMember()
    {
        return view('backend.admin.member.pending', [
            'members' => User::where('role', 0)->orderBy('id', 'desc')->get()
        ]);
    }
    public function verifiedMember()
    {
        return view('backend.admin.member.verified', [
            'members' => User::where('role', 1)->orderBy('id', 'desc')->get()
        ]);
    }
    public function editMember($id)
    {
        $member = User::find($id);
        return view('backend.admin.member.edit', [
            'member' => $member,
        ]);
    }
    // Members information change by super admin 
    public function updateUserNameByAdmin(Request $request)
    {
        $user_info               = User::find($request->id);
        $user_info->name = $request->name;
        $user_info->save();
        return redirect()->back()->with('message', 'User Name Successfully Updated!');
    }

    public function updateUserPhoneByAdmin(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|unique:users,phone',
        ]);

        $user_info               = User::find($request->id);
        $user_info->phone = $request->phone;
        $user_info->save();
        return redirect()->back()->with('message', 'User Phone Successfully Updated!');
    }

    public function updateUserEmailByAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|unique:users,email',
        ]);

        $user_info               = User::find($request->id);
        $user_info->email = $request->email;
        $user_info->save();
        return redirect()->back()->with('message', 'User Email Successfully Updated!');
    }


    public function updateUserPhotoByAdmin(Request $request)
    {
        $user_info               = User::find($request->id);
        if ($request->file('profile_photo_path')) {
            if (isset($user_info)) {
                delete_image($user_info->profile_photo_path);
                $user_info->delete();
            }
            $user_info->profile_photo_path = image_upload($request->profile_photo_path);
        }
        $user_info->save();
        return redirect()->back()->with('message', 'Profile Photo Successfully Updated!');
    }
    public function updateUserAddressByAdmin(Request $request)
    {
        $user_info               = User::find($request->id);
        $user_info->address = $request->address;
        $user_info->save();
        return redirect(route('profile_admin'))->with('message', 'Address Successfully Updated!');
    }
    public function updateUserWhatsappByAdmin(Request $request)
    {
        $user_info               = User::find($request->id);
        $user_info->whatsapp = $request->whatsapp;
        $user_info->save();
        return redirect(route('profile_admin'))->with('message', 'Whatsapp Number Successfully Updated!');
    }
    public function updateUserOrganizationByAdmin(Request $request)
    {
        $user_info               = User::find($request->id);
        $user_info->organization = $request->organization;
        $user_info->save();
        return redirect(route('profile_admin'))->with('message', 'Organization Successfully Updated!');
    }

    public function updateUserPasswordByAdmin(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed', // Ensure password and password_confirmation match
        ]);

        $user_info = User::find($request->id);
        $user_info->password = Hash::make($request->password);
        $user_info->save();

        return redirect()->back()->with('message', 'Password successfully updated!');
    }
    public function role($id, $newRole)
    {
        $user = User::find($id);
        $user->role = $newRole;
        $user->save();
        return back();
    }
    public function deleteMemberByAdmin($id)
    {
        $member = User::findOrFail($id);

        $member->delete();

        return redirect()->route('manage_member')->with('message', 'Successfully Deleted!');
    }

    public function showPaymentVerification()
    {
        $members = User::orderBy('name', 'asc')->get();
        return view('backend.admin.payment_verification.show', compact('members'));
    }

    public function savePaymentVerification(Request $request)
    {
        // Validate the request
        $request->validate([
            'member_id' => 'required|exists:users,id', // Ensure member exists in the Users table
            'gateway_name' => 'required|string',
            'sender_number' => 'required|string',
            'transaction_number' => 'required|string',
            'amount' => 'required|numeric',
            'account_validity' => 'required|date',
        ]);

        // Insert the PaymentVerification record
        $paymentVerification = PaymentVerification::create([
            'member_id' => $request->member_id,
            'gateway_name' => $request->gateway_name,
            'sender_number' => $request->sender_number,
            'transaction_number' => $request->transaction_number,
            'amount' => $request->amount,
            'account_validity' => $request->account_validity,
        ]);

        // Update the User's account_validity
        $user = User::find($paymentVerification->member_id);
        if ($user) {
            $user->account_validity = $paymentVerification->account_validity;
            $user->save();
        }

        // Redirect with success message
        return redirect()->back()->with('message', 'Payment verification saved and account validity updated successfully.');
    }

    public function managePaymentVerification()
    {
        return view('backend.admin.payment_verification.index', [
            'paymentVerification' => PaymentVerification::with('user')->orderBy('id', 'desc')->get()
        ]);
    }

    public function editPaymentVerification($id)
    {
        $members = User::orderBy('name', 'asc')->get();
        $paymentVerification = PaymentVerification::find($id);
        return view('backend.admin.payment_verification.edit', [
            'paymentVerification' => $paymentVerification,
            'members' => $members,
        ]);
    }

    public function updatePaymentVerification(Request $request)
    {
        // Validate the request
        $request->validate([
            'member_id' => 'required|exists:users,id', // Ensure member exists in the Users table
            'gateway_name' => 'required|string',
            'sender_number' => 'required|string',
            'transaction_number' => 'required|string',
            'amount' => 'required|numeric',
            'account_validity' => 'required|date',
        ]);

        // Find the existing PaymentVerification record by id
        $paymentVerification               = PaymentVerification::find($request->payment_verification_id);

        if (!$paymentVerification) {
            // If the record doesn't exist, redirect with an error
            return redirect()->back()->with('error', 'Payment verification not found.');
        }

        // Update the PaymentVerification record with new data
        $paymentVerification->update([
            'member_id' => $request->member_id,
            'gateway_name' => $request->gateway_name,
            'sender_number' => $request->sender_number,
            'transaction_number' => $request->transaction_number,
            'amount' => $request->amount,
            'account_validity' => $request->account_validity,
        ]);

        // Update the User's account_validity if necessary
        $user = User::find($paymentVerification->member_id);
        if ($user) {
            $user->account_validity = $paymentVerification->account_validity;
            $user->save();
        }

        // Redirect with success message
        return redirect(route('manage_payment_verification'))->with('message', 'Payment verification and account validity updated successfully.');
    }

    public function deletePaymentVerification(Request $request)
    {
        $paymentVerification = PaymentVerification::find($request->payment_verification_id);

        $paymentVerification->delete();

        return redirect(route('manage_payment_verification'))->with('message', 'Payment info deleted successfully.');
    }

    public function editMemberPaymentInfo($id)
    {
        $payment = PaymentVerification::findOrFail($id);
        return view('backend.admin.payment_verification.edit-member-payment-info', compact('payment'));
    }

    public function updateMemberPaymentInfo(Request $request)
    {
        $request->validate([
            'gateway_name' => 'required|string|max:255',
            'account_validity' => 'required|date',
            'sender_number' => 'required|string|max:20',
            'transaction_number' => 'required|string|max:50',
            'amount' => 'required|numeric|min:0',
        ]);

        // Find the existing PaymentVerification record by id
        $payment               = PaymentVerification::find($request->payment_info_id);

        if (!$payment) {
            // If the record doesn't exist, redirect with an error
            return redirect()->back()->with('error', 'Payment Info not found.');
        }

        // Update the PaymentVerification record with new data
        $payment->update([
            'member_id' => $request->member_id,
            'gateway_name' => $request->gateway_name,
            'sender_number' => $request->sender_number,
            'transaction_number' => $request->transaction_number,
            'amount' => $request->amount,
            'account_validity' => $request->account_validity,
        ]);

        // Update the User's account_validity if necessary
        $user = User::find($payment->member_id);
        if ($user) {
            $user->account_validity = $payment->account_validity;
            $user->save();
        }

        $payment->update([
            'gateway_name' => $request->gateway_name,
            'account_validity' => $request->account_validity,
            'sender_number' => $request->sender_number,
            'transaction_number' => $request->transaction_number,
            'amount' => $request->amount,
        ]);

        return redirect()->route('edit_admin', $payment->member_id)->with('message', 'Payment verification and account validity updated successfully.');
    }

    public function deleteMemberPaymentInfo(Request $request)
    {
        $payment = PaymentVerification::findOrFail($request->payment_info_id);
        $payment->delete();

        return redirect()->back()->with('message', 'Payment information deleted successfully.');
    }
}
