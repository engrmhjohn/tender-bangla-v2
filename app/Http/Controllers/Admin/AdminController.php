<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\PaymentVerification;
use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

require_once app_path('Helper/image.php');

class AdminController extends Controller
{
    public function manageAdmin()
    {
        return view('backend.admin.index', [
            'users' => User::get()
        ]);
    }
    public function editAdmin($id)
    {
        $user = User::find($id);

        // Decode the user's district_id JSON array
        $selectedDistricts = json_decode($user->district_id);

        // Get all available districts
        $districts = District::all();

        // Get all payments
        $payments = PaymentVerification::where('member_id', $user->id)
        ->orderBy('id', 'desc')
        ->get();

        return view('backend.admin.edit', [
            'user' => $user,
            'districts' => $districts,
            'payments' => $payments,
            'selectedDistricts' => $selectedDistricts, // Pass selected districts to the view
        ]);
    }

    public function role($id, $newRole)
    {
        $user = User::find($id);
        $user->role = $newRole;
        $user->save();
        return back();
    }

    public function adminProfile()
    {
        return view('backend.admin.profile');
    }

    public function memberProfile()
    {
        return view('backend.admin.member_profile');
    }

    public function deleteAdmin($id)
    {
        $admin = User::findOrFail($id);

        $admin->delete();

        return redirect()->back()->with('message', 'Successfully Deleted!');
    }

    public function pendingUser()
    {
        return view('backend.admin.pending_user', [
            'pending_user' => User::where('role', '0')->get()
        ]);
    }
    public function adminUser()
    {
        return view('backend.admin.admin_user', [
            'admin_user' => User::where('role', '1')->get()
        ]);
    }
    public function superAdminUser()
    {
        return view('backend.admin.super_admin_user', [
            'super_admin_user' => User::where('role', '2')->get()
        ]);
    }

    // Users information change by super admin 
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

    public function updateUserWhatsappByAdmin(Request $request)
    {
        $request->validate([
            'whatsapp' => 'required|string|unique:users,whatsapp',
        ]);

        $user_info               = User::find($request->id);
        $user_info->whatsapp = $request->whatsapp;
        $user_info->save();
        return redirect()->back()->with('message', 'User Whatsapp Successfully Updated!');
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

    public function updateUserPasswordByAdmin(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed', // Ensure password and password_confirmation match
        ]);

        $user_info = User::find($request->id);
        $user_info->password = Hash::make($request->password);
        $user_info->pw_plain_text = $request->password;
        $user_info->save();

        return redirect()->back()->with('message', 'Password successfully updated!');
    }

    public function updateUserAddressByAdmin(Request $request)
    {
        $user_info               = User::find($request->id);
        $user_info->address = $request->address;
        $user_info->save();
        return redirect()->back()->with('message', 'Address Successfully Updated!');
    }

    public function updateUserOrganizationByAdmin(Request $request)
    {
        $user_info               = User::find($request->id);
        $user_info->organization = $request->organization;
        $user_info->save();
        return redirect()->back()->with('message', 'Organization Successfully Updated!');
    }

    public function updateUserAccountValidityByAdmin(Request $request)
    {
        $user_info               = User::find($request->id);
        $user_info->account_validity = $request->account_validity;
        $user_info->save();
        return redirect()->back()->with('message', 'Account Validity Successfully Updated!');
    }

    public function updateUserTenderAreaByAdmin(Request $request)
    {
        // Find the user by the ID passed in the request
        $user_info = User::find($request->id);

        // Encode the district_id array as JSON and save it
        $user_info->district_id = json_encode($request->district_id);
        $user_info->save();

        // Redirect back with a success message
        return redirect()->back()->with('message', 'Tender Area Successfully Updated!');
    }


    public function deleteAdminByAdmin($id)
    {
        $admin = User::findOrFail($id);

        $admin->delete();

        return redirect()->back()->with('message', 'Successfully Deleted!');
    }

    // Own information change
    public function updateUserName(Request $request)
    {
        $user_info               = User::find($request->id);
        $user_info->name = $request->name;
        $user_info->save();
        return redirect(route('profile_admin'))->with('message', 'User Full Name Successfully Updated!');
    }
    public function updateUserPhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|unique:users,phone',
        ]);

        $user_info               = User::find($request->id);
        $user_info->phone = $request->phone;
        $user_info->save();
        return redirect(route('profile_admin'))->with('message', 'User Phone Successfully Updated!');
    }

    public function updateUserEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|string|unique:users,email',
        ]);

        $user_info               = User::find($request->id);
        $user_info->email = $request->email;
        $user_info->save();
        return redirect(route('profile_admin'))->with('message', 'User Email Successfully Updated!');
    }

    public function updateUserPhoto(Request $request)
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
        return redirect(route('profile_admin'))->with('message', 'Profile Photo Successfully Updated!');
    }

    public function updateUserPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed', // Ensure password and password_confirmation match
        ]);

        $user_info = User::find($request->id);
        $user_info->password = Hash::make($request->password);
        $user_info->pw_plain_text = $request->password;
        $user_info->save();

        return redirect(route('profile_admin'))->with('message', 'Password successfully updated!');
    }

    public function updateUserAddress(Request $request)
    {
        $user_info               = User::find($request->id);
        $user_info->address = $request->address;
        $user_info->save();
        return redirect()->back()->with('message', 'Address Successfully Updated!');
    }

    public function updateUserOrganization(Request $request)
    {
        $user_info               = User::find($request->id);
        $user_info->organization = $request->organization;
        $user_info->save();
        return redirect()->back()->with('message', 'Organization Successfully Updated!');
    }
}
