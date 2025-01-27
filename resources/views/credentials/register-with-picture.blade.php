<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Register :: Tender Bangla</title>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <!-- Choices.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f9;
        }

        .registration-form-wrapper {
            display: flex;
            max-width: 900px;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .profile-pic-section {
            width: 300px;
            margin: 0 auto;
            border-radius: 10px;
            background-color: #f0f0f5;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        #upload-container {
            margin-top: 10px;
        }

        .image-card {
            text-align: center;
            border: 2px dashed #cccccc;
            padding: 20px;
            border-radius: 15px;
            background: #ffffff;
            width: 90%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        #preview-container {
            position: relative;
        }

        #preview-image {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        #remove-image {
            background: #ff4d4d;
            color: #ffffff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .upload-label {
            display: block;
            font-weight: bold;
            color: #555555;
            margin-bottom: 10px;
            cursor: pointer;
        }

        #profile_photo_path {
            display: none;
        }

        .form-section {
            flex: 1.5;
            padding: 40px 30px;
            background-color: #ffffff;
        }

        .form-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 0px;
            color: #333333;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="number"],
        .form-group {
            padding: 10px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            font-size: 16px;
            width: 93%;
            outline: none;
            margin-bottom: 5px;
            margin-top: 5px;
        }

        .form-group input[type="checkbox"] {
            margin-right: 10px;
        }

        .register-btn {
            background: #ff5722;
            color: #ffffff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .register-btn:hover {
            background: #e64a19;
        }

    </style>
</head>

<body>
    @php
    $districts = \App\Models\District::orderBy('district_name', 'asc')->get();
    @endphp
    <div class="registration-form-wrapper">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="registration-form">
            @csrf
            <!-- Left Section: Image Upload -->
            <h2 class="form-title">REGISTRATION FORM</h2>
            <div class="profile-pic-section">
                <div class="image-card">
                    <div id="preview-container" style="display: none;">
                        <img id="preview-image" src="#" alt="Profile Preview" />
                        <button type="button" id="remove-image">Remove</button>
                    </div>
                    <div id="upload-container">
                        <label for="profile_photo_path" class="upload-label">Select Your Profile Pic</label>
                        <input type="file" id="profile_photo_path" name="profile_photo_path" accept="image/*" />
                    </div>
                </div>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger" role="alert" style="background: yellow;">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Right Section: Form -->
            <div class="form-section">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Full Name" required />
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required />
                </div>
                <div class="form-group">
                    <input type="text" name="organization" placeholder="Organization" />
                    <input type="text" name="address" placeholder="Your Address" />
                </div>
                <div class="form-group">
                    <input type="number" name="phone" placeholder="Phone" required />
                    <input type="number" name="whatsapp" placeholder="Whatsapp (if have)" />
                </div>
                <div class="form-group">
                    <label for="district">Preferred Tender Area</label>
                    <select id="district" name="district_id[]" multiple required>
                        <option value="">Select areas</option>
                        @foreach ($districts as $district)
                        <option value="{{ $district->id }}" {{ (collect(old('district_id'))->contains($district->id)) ? 'selected' : '' }}>
                            {{ $district->district_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password (min. 8)" required />
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
                </div>
                <button type="submit" class="register-btn">REGISTER NOW</button> <br>
                <a href="{{ route('login') }}">Already Registered? Login Instead</a>
            </div>
        </form>
    </div>
    <!-- Choices.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const districtSelect = new Choices('#district', {
                searchEnabled: true, // Allows search functionality in the dropdown
                itemSelectText: '', // Removes the 'Press to select' text
                shouldSort: false, // Disable sorting of choices by label
                removeItemButton: true
            });
        });

    </script>

    <script>
        document.getElementById('profile_photo_path').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('remove-image').addEventListener('click', function() {
            const previewContainer = document.getElementById('preview-container');
            const fileInput = document.getElementById('profile_photo_path');
            previewContainer.style.display = 'none';
            fileInput.value = ''; // Clear file input
        });

    </script>

</body>

</html>
