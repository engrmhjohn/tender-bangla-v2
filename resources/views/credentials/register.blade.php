<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register :: Tender Bangla</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Choices.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

    <style>
        /* Import Google font - Poppins */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            padding: 0 10px;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            background: linear-gradient(50deg, #9d595c, #f98e70, #f299d9, #5e37b7);
            animation: gradientBG 15s ease infinite;
            background-size: cover;
            background-position: center;
        }

        ::selection {
            color: #fff;
            background: #0D6EFD;
        }
        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .wrapper {
            width: 715px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .wrapper h2 {
            padding: 20px 30px;
            text-align: center;
            color: #fff;
        }

        .wrapper form {
            margin: 0px 35px 35px 20px;
        }

        .wrapper form.disabled {
            pointer-events: none;
            opacity: 0.7;
        }

        form .dbl-field {
            display: flex;
            margin-bottom: 25px;
            justify-content: space-between;
        }

        .dbl-field .field {
            height: 50px;
            display: flex;
            position: relative;
            width: calc(100% / 2 - 13px);
        }

        .wrapper form i {
            position: absolute;
            top: 50%;
            left: 18px;
            font-size: 17px;
            pointer-events: none;
            transform: translateY(-50%);
        }

        form .field input,
        form .message textarea {
            width: 100%;
            height: 100%;
            outline: none;
            padding: 0 18px 0 48px;
            font-size: 16px;
            border-radius: 5px;
            background: transparent;
            border: 1px solid #fff;
        }

        .field input::placeholder,
        .message textarea::placeholder {
            color: rgba(153, 16, 16, 0.3);
        }

        .field input:focus,
        .message textarea:focus {
            padding-left: 47px;
            border: 2px solid #0D6EFD;
        }

        .field input:focus~i,
        .message textarea:focus~i {
            color: #0D6EFD;
        }

        form .message textarea {
            min-height: 130px;
            max-height: 230px;
            max-width: 100%;
            min-width: 100%;
            padding: 15px 20px 0 48px;
        }

        form .message textarea::-webkit-scrollbar {
            width: 0px;
        }

        .message textarea:focus {
            padding-top: 14px;
        }


        .button-area button {
            position: relative;
            width: 100%;
            height: 40px;
            background: #00c2a7;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .4);
            font-size: 1em;
            color: #fff;
            font-weight: 500;
            cursor: pointer;
            border-radius: 5px;
            border: none;
            outline: none;
            transition: .5s;
            margin-top: 20px;
        }

        .button-area button:hover {
            background: #fff;
            color: #00c2a7;
        }

        .button-area span {
            font-size: 17px;
            margin-left: 30px;
            display: none;
        }

        .sign-link {
            font-size: .9em;
            text-align: center;
            margin: 25px 0;
        }

        .sign-link p {
            color: #fff;
        }

        .sign-link p a {
            color: #751717;
            text-decoration: none;
            font-weight: 600;
        }

        .sign-link p a:hover {
            text-decoration: underline;
        }


        .error-box {
            background: yellow;
            color: black;
            font-size: 0.9em;
            font-weight: 600;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .error-section {
            width: 100%;
            /* Full width */
            margin: 10px 0 20px;
            text-align: left;
            /* Align text to the left */
        }

        .error-section ul {
            list-style-position: inside;
            /* Ensure bullet points are inside the container */
            padding-left: 10px;
            /* Add padding for consistent spacing */
            margin: 0;
            /* Remove default margins */
        }

        .error-section ul li {
            font-size: 0.9em;
            /* Adjust font size if needed */
            color: black;
            font-weight: 600;
            line-height: 1.5;
            /* Improve spacing between lines */
        }

        @media (max-width: 600px) {
            .wrapper header {
                text-align: center;
            }

            .wrapper form {
                margin: 0px 35px 35px 20px;
            }

            form .dbl-field {
                flex-direction: column;
                margin-bottom: 0px;
            }

            form .dbl-field .field {
                width: 100%;
                height: 45px;
                margin-bottom: 20px;
            }

            form .message textarea {
                resize: none;
            }

            form .button-area {
                margin-top: 20px;
                flex-direction: column;
            }

            .button-area button {
                width: 100%;
                padding: 11px 0;
                font-size: 16px;
            }

            .button-area span {
                margin: 20px 0 0;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    @php
    $districts = \App\Models\District::orderBy('district_name', 'asc')->get();
    @endphp
    <div class="wrapper">
        @if ($errors->any())
        <div class="error-section">
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        <h2>Register in Tender Bangla</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="dbl-field">
                <div class="field">
                    <input type="text" name="name" placeholder="Full Name*" value="{{ old('name') }}" required>
                    <i class='fas fa-user'></i>
                </div>
                <div class="field">
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    <i class='fas fa-envelope'></i>
                </div>
            </div>
            <div class="dbl-field">
                <div class="field">
                    <input type="text" name="organization" placeholder="Organization" value="{{ old('organization') }}">
                    <i class="fas fa-warehouse"></i>
                </div>
                <div class="field">
                    <input type="text" name="address" placeholder="Your Address" value="{{ old('address') }}">
                    <i class="fas fa-map-marked"></i>
                </div>
            </div>
            <div class="dbl-field">
                <div class="field">
                    <input type="phone" name="phone" placeholder="Mobile Number*" value="{{ old('phone') }}" required>
                    <i class='fas fa-phone-alt'></i>
                </div>
                <div class="field">
                    <input type="phone" name="whatsapp" placeholder="Whatsapp Number" value="{{ old('whatsapp') }}">
                    <i class="fab fa-whatsapp"></i>
                </div>
            </div>
            <div class="dbl-field">
                <div class="field">
                    <input type="password" name="password" value="{{ old('password') }}"
                        placeholder="Password (min. 8)*" required>
                        <i class="fas fa-key"></i>
                </div>
                <div class="field">
                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                        placeholder="Confirm Password*" required>
                        <i class="fas fa-key"></i>
                </div>
            </div>
            <select id="district" name="district_id[]" multiple required>
                <option value="">Select areas</option>
                <option value="all" {{ old('district_id') == 'all' ? 'selected' : '' }}>All</option>
                @foreach ($districts as $district)
                <option value="{{ $district->id }}" {{ (collect(old('district_id'))->contains($district->id)) ?
                    'selected' : '' }}>
                    {{ $district->district_name }}
                </option>
                @endforeach
            </select>
            <div class="button-area">
                <button type="submit">Register</button>
            </div>
            <div class="sign-link">
                <p>Already Registered? <a href="{{ route('login') }}" class="register-link">Login</a></p>
            </div>
        </form>
    </div>

    <!-- Choices.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const districtSelect = new Choices('#district', {
                searchEnabled: true, // Allows search functionality in the dropdown
                itemSelectText: '', // Removes the 'Press to select' text
                shouldSort: false, // Disable sorting of choices by label
                removeItemButton: true
            });
        });

    </script>
</body>

</html>