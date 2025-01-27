<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Reset Password :: Dental Door BD</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

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

        form {
            padding: 0 2.3rem 2.2rem 2.3rem;
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
            margin-top: 30px;
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

        .message {
            padding: 0 40px;
            color: rgb(247, 234, 214);
            text-align: justify;
            line-height: 18px;
            position: relative;
            z-index: 99;
        }

        .message2 {
            padding: 0 40px;
            color: rgb(233, 240, 30);
            text-align: justify;
            line-height: 18px;
            position: relative;
            z-index: 99;
            margin-top: 10px;
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

        .mt50 {
            margin-top: 50px;
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
    </style>
</head>

<body>
    <div class="container">
        <span class="big-circle"></span>
        <img src="{{ asset('frontendAssets/img') }}/shape.png" class="square" alt="john" />
        <div class="form">
            <div class="contact-info">
                <img class="img-fluid" src="{{ asset('frontendAssets/img/admin-login.png') }}" alt="">
            </div>

            <div class="contact-form">
                <h3 class="title">Reset Password</h3>
                <span class="circle one"></span>
                <span class="circle two"></span>
                    @if ($errors->any())
                    <div class="message2">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                            
                       
                    
                @endif
                @if (session('status'))
                    <div class="message2">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="" style="margin-top: 30px;">

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
            
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="input-container">
                            <input type="text" class="input" name="email" value="{{ $request->email }}" required autofocus
                            autocomplete="email" readonly />
                            <label for="">Email</label>
                            <span>Email</span>
                        </div>
                        <div class="input-container">
                            <input class="input" type="password"
                            id="password" name="password" required autocomplete="new-password"
                            />
                            <label for="">New Password</label>
                            <span>New Password</span>
                        </div>
                        <div class="input-container">
                            <input class="input" type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            />
                            <label for="">Confirm New Password</label>
                            <span>Confirm New Password</span>
                        </div>

                        <button type="submit" class="btn btn-primary form-control">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            const inputs = document.querySelectorAll(".input");

            function focusFunc() {
                let parent = this.parentNode;
                parent.classList.add("focus");
            }

            function blurFunc() {
                let parent = this.parentNode;
                if (this.value == "") {
                    parent.classList.remove("focus");
                }
            }

            inputs.forEach((input) => {
                input.addEventListener("focus", focusFunc);
                input.addEventListener("blur", blurFunc);
            });
        </script>
</body>

</html>
