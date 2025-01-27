<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

require_once app_path('Helper/image.php');

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'district_id' => ['array'], 
            'organization' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'account_validity' => ['nullable', 'date', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'whatsapp' => ['nullable', 'string', 'max:255', 'unique:users'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'role' => ['nullable', 'string', 'max:255'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'profile_photo_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validation for image
        ])->validate();
    
        // Use the helper function to upload the profile picture
        $profilePhotoPath = isset($input['profile_photo_path']) && $input['profile_photo_path']->isValid()
            ? image_upload($input['profile_photo_path'])
            : null;
    
        return User::create([
            'name' => $input['name'],
            'district_id' => json_encode($input['district_id']),
            'organization' => $input['organization'] ?? null,
            'address' => $input['address'] ?? null,
            'account_validity' => $input['account_validity'] ?? null,
            'phone' => $input['phone'],
            'whatsapp' => $input['whatsapp'] ?? null,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'pw_plain_text' => $input['password'],
            'role' => $input['role'] ?? 0,
            'profile_photo_path' => $profilePhotoPath, // Save the uploaded image path
        ]);
    }
    
}
