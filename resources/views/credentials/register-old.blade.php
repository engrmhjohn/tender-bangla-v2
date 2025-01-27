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
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        input,
        textarea {
            font-family: "Poppins", sans-serif;
        }

        .container {
            position: relative;
            width: 100%;
            min-height: 100vh;
            padding: 2rem;
            background-color: #fafafa;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-container ::placeholder {
            color: white;
            opacity: 1;
            /* Firefox */
        }

        .input-container ::-ms-input-placeholder {
            /* Edge 12 -18 */
            color: white;
        }

        .form {
            width: 100%;
            max-width: 820px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            overflow: hidden;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .contact-form {
            background-color: #1abc9c;
            position: relative;
        }

        .circle {
            border-radius: 50%;
            background: linear-gradient(135deg, transparent 20%, #149279);
            position: absolute;
        }

        .circle.one {
            width: 130px;
            height: 130px;
            top: 130px;
            right: -40px;
        }

        .circle.two {
            width: 80px;
            height: 80px;
            top: 10px;
            right: 30px;
        }

        .contact-form:before {
            content: "";
            position: absolute;
            width: 26px;
            height: 26px;
            background-color: #1abc9c;
            transform: rotate(45deg);
            top: 50px;
            left: -13px;
        }

        .img-fluid {
            height: auto;
            width: 100%;
        }

        .text-start,
        .text-start a {
            margin-top: 20px;
        }

        form {
            padding: 1.3rem 2.2rem;
            z-index: 10;
            overflow: hidden;
            position: relative;
        }

        .title {
            color: #fff;
            font-weight: 500;
            font-size: 1.5rem;
            line-height: 1;
            margin-bottom: 0.7rem;
            text-align: center;
        }

        .input-container {
            position: relative;
            margin: 1rem 0;
        }

        .input {
            width: 100%;
            outline: none;
            border: 2px solid #fafafa;
            background: none;
            padding: 0.6rem 1.2rem;
            color: #fff;
            font-weight: 500;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            border-radius: 25px;
            transition: 0.3s;
        }

        .input-container label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            padding: 0 0.4rem;
            color: #fafafa;
            font-size: 0.9rem;
            font-weight: 400;
            pointer-events: none;
            z-index: 1000;
            transition: 0.5s;
        }

        .input-container.textarea label {
            top: 1rem;
            transform: translateY(0);
        }

        .btn {
            padding: 0.6rem 1.3rem;
            background-color: #fff;
            border: 2px solid #fafafa;
            font-size: 0.95rem;
            color: #1abc9c;
            line-height: 1;
            border-radius: 25px;
            outline: none;
            cursor: pointer;
            transition: 0.3s;
            margin: 0;
        }

        .btn:hover {
            background-color: transparent;
            color: #fff;
        }

        .input-container span {
            position: absolute;
            top: 0;
            left: 25px;
            transform: translateY(-50%);
            font-size: 0.8rem;
            padding: 0 0.4rem;
            color: transparent;
            pointer-events: none;
            z-index: 500;
        }

        .input-container span:before,
        .input-container span:after {
            content: "";
            position: absolute;
            width: 10%;
            opacity: 0;
            transition: 0.3s;
            height: 5px;
            background-color: #1abc9c;
            top: 50%;
            transform: translateY(-50%);
        }

        .input-container span:before {
            left: 50%;
        }

        .input-container span:after {
            right: 50%;
        }

        .input-container.focus label {
            top: 0;
            transform: translateY(-50%);
            left: 25px;
            font-size: 0.8rem;
        }

        .input-container.focus span:before,
        .input-container.focus span:after {
            width: 50%;
            opacity: 1;
        }

        .contact-info {
            padding: 2.3rem 2.2rem;
            position: relative;
        }

        .contact-info .title {
            color: #1abc9c;
        }

        .icon {
            width: 28px;
            margin-right: 0.7rem;
        }

        .contact-info:before {
            content: "";
            position: absolute;
            width: 110px;
            height: 100px;
            border: 22px solid #1abc9c;
            border-radius: 50%;
            bottom: -77px;
            right: 50px;
            opacity: 0.3;
        }

        .big-circle {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: linear-gradient(to bottom, #1cd4af, #159b80);
            bottom: 50%;
            right: 50%;
            transform: translate(-40%, 38%);
        }

        .big-circle:after {
            content: "";
            position: absolute;
            width: 360px;
            height: 360px;
            background-color: #fafafa;
            border-radius: 50%;
            top: calc(50% - 180px);
            left: calc(50% - 180px);
        }

        .square {
            position: absolute;
            height: 400px;
            top: 50%;
            left: 50%;
            transform: translate(181%, 11%);
            opacity: 0.2;
        }

        @media (max-width: 850px) {
            .form {
                grid-template-columns: 1fr;
            }

            .contact-info:before {
                bottom: initial;
                top: -75px;
                right: 65px;
                transform: scale(0.95);
            }

            .contact-form:before {
                top: -13px;
                left: initial;
                right: 70px;
            }

            .square {
                transform: translate(140%, 43%);
                height: 350px;
            }

            .big-circle {
                bottom: 75%;
                transform: scale(0.9) translate(-40%, 30%);
                right: 50%;
            }

            .text {
                margin: 1rem 0 1.5rem 0;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 1.5rem;
            }

            .contact-info:before {
                display: none;
            }

            .square,
            .big-circle {
                display: none;
            }

            form,
            .contact-info {
                padding: 1.7rem 1.6rem;
            }

            .text,
            .social-media p {
                font-size: 0.8rem;
            }

            .title {
                font-size: 1.15rem;
            }

            .input {
                padding: 0.45rem 1.2rem;
            }

            .btn {
                padding: 0.45rem 1.2rem;
            }
        }

        :root {
            --arrow-bg: rgba(255, 255, 255, 0.3);
            --arrow-icon: url(https://upload.wikimedia.org/wikipedia/commons/9/9d/Caret_down_font_awesome_whitevariation.svg);
            --option-bg: white;
            --select-bg: #1abc9c;
        }

        /* <select> styles */
        select {
            /* Reset */
            appearance: none;
            border: 0;
            outline: 0;
            font: inherit;
            /* Personalize */
            border: 2px solid #fafafa;
            width: 100%;
            padding: 0.6rem 4rem 0.6rem 1rem;
            background: var(--arrow-icon) no-repeat right 0.8em center / 1.4em,
                #1abc9c;
            color: white;
            border-radius: 2.25em;
            cursor: pointer;

            /* Remove IE arrow */
            &::-ms-expand {
                display: none;
            }

            /* Remove focus outline */
            &:focus {
                outline: none;
            }

            /* <option> colors */
            option {
                color: inherit;
                background-color: #1abc9c;
            }
        }

    </style>
</head>

<body>
    @php
    $districts = \App\Models\District::orderBy('district_name', 'asc')->get();
    @endphp
    <div class="container">
        <span class="big-circle"></span>
        <img src="{{ asset('frontendAssets/img') }}/shape.png" class="square" alt="john" />
        <div class="form">
            <div class="contact-info">
                <h3 class="title">User Register</h3>
                @if ($errors->any())
                <div class="alert alert-danger" role="alert" style="background: yellow;">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <img class="img-fluid" src="{{ asset('frontendAssets/img/admin-login.png') }}" alt="">
                <div class="text-start pt-4">
                    Already Registered?
                    <a class="text-primary ms-1" href="{{ route('login') }}">
                        Login Now
                    </a>
                </div>
            </div>

            <div class="contact-form">
                <span class="circle one"></span>
                <span class="circle two"></span>

                <form id="uploadForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="input-container">
                        <input type="file" id="profile_photo_path" name="profile_photo_path" accept="image/*" class="input" />
                    </div>
                    <div id="preview-container" style="display: none;">
                        <img id="preview-image" src="#" alt="Preview" style="max-width: 200px; margin-top: 10px;" />
                        <button type="button" id="remove-image" style="margin-top: 10px;">Remove</button>
                    </div>
                    <div class="input-container">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="input" placeholder="Full Name" />
                    </div>
                    <div class="input-container">
                        <input type="text" id="organization" name="organization" value="{{ old('organization') }}" autofocus autocomplete="organization" class="input" placeholder="Organization" />
                    </div>
                    <div class="input-container">
                        <input type="text" id="address" name="address" value="{{ old('address') }}" autofocus autocomplete="address" class="input" placeholder="Address" />
                    </div>
                    <div class="input-container">
                        <input type="number" name="phone" value="{{ old('phone') }}" required autofocus autocomplete="phone" class="input" placeholder="Phone" />
                    </div>
                    <div class="input-container">
                        <input type="number" name="whatsapp" value="{{ old('whatsapp') }}" autofocus autocomplete="whatsapp" class="input" placeholder="Whatsapp (if have)" />
                    </div>
                    <div class="input-container">
                        <input type="email" name="email" value="{{ old('email') }}" autocomplete="email" class="input" placeholder="Email" />
                    </div>
                    <div>
                        <label for="district" style="color: white">Preferred Tender Area</label>
                        <select id="district" name="district_id[]" class="choices-select" multiple required>
                            <option value="">Select areas</option>
                            @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{ (collect(old('district_id'))->contains($district->id)) ? 'selected' : '' }}>
                                {{ $district->district_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-container">
                        <input class="input" type="password" id="password" name="password" required autocomplete="new-password" placeholder="Password (min. 8)" />
                    </div>
                    <div class="input-container">
                        <input class="input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
                    </div>
                    <input type="submit" value="Register" class="btn" />
                </form>
            </div>
        </div>
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
        document.addEventListener("DOMContentLoaded", () => {
    const fileInput = document.getElementById("profile_photo_path");
    const previewContainer = document.getElementById("preview-container");
    const previewImage = document.getElementById("preview-image");
    const removeButton = document.getElementById("remove-image");

    // Event listener for file input change
    fileInput.addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();

            // Load the image preview
            reader.onload = (e) => {
                previewImage.src = e.target.result;
                previewContainer.style.display = "block";
            };

            reader.readAsDataURL(file);
        }
    });

    // Event listener for removing the image
    removeButton.addEventListener("click", () => {
        fileInput.value = ""; // Clear the file input
        previewImage.src = "#"; // Reset the preview image
        previewContainer.style.display = "none"; // Hide the preview container
    });
});

    </script>
</body>

</html>
