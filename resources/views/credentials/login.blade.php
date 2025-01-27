<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login :: Tender Bangla</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(50deg, #9d595c, #f98e70, #f299d9, #5e37b7);
            animation: gradientBG 15s ease infinite;
            background-size: cover;
            background-position: center;
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
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            max-width: 350px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        h2 {
            /* color: black; */
            text-align: center;
        }

        .input-group {
            position: relative;
            max-width: 320px;
            margin: 30px 0;
        }

        .input-group input {
            width: 100%;
            height: 40px;
            font-size: 1em;
            padding: 0 10px 0 35px;
            background: transparent;
            border: 1px solid #fff;
            outline: none;
            border-radius: 5px;
        }

        .input-group input::placeholder {
            color: rgba(153, 16, 16, 0.3);
        }

        .input-group .icon {
            position: absolute;
            display: block;
            left: 10px;
            font-size: 1.2em;
            line-height: 45px;
        }

        .forgot-pass {
            margin: -15px 0 15px;
        }

        .forgot-pass a {
            color: #fff;
            font-size: .9em;
            text-decoration: none;
        }

        .forgot-pass a:hover {
            text-decoration: underline;
        }

        .btn {
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
        }

        .btn:hover {
            background: #fff;
            color: #00c2a7;
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

    </style>
</head>

<body>
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
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <h2>Tender Bangla Login</h2>
            <div class="input-group">
                <span class="icon">
                    <ion-icon name="person"></ion-icon>
                </span>
                <input type="text" name="loginname" value="{{ old('loginname') }}" id="loginname" placeholder="Phone/Email" required>
            </div>
            <div class="input-group">
                <span class="icon">
                    <ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="password" name="password" id="password" value="{{ old('password') }}" placeholder="Password" required>
            </div>
            <div class="forgot-pass">
                <a href="{{ route('password.request') }}">Forgot Password?</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="sign-link">
                <p>Don't have an account? <a href="{{ route('register') }}" class="register-link">Register</a></p>
            </div>
        </form>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
