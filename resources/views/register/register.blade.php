<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToList - Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f8f8;
        }
        .card-custom {
            background-color: #eee;
            border-radius: 15px;
            padding: 30px;
            width: 350px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .title-pink {
            color:  #813636;
            font-weight: bold;
        }
        .form-label {
            font-weight: bold;
            color: black;
            font-size: 14px;
            margin-bottom: 5px;
            text-align: left;
            display: block;
        }
        .input-custom {
            background-color: #c99595;
            border: none;
            border-radius: 10px;
            height: 45px;
            color: white;
            text-align: center;
        }
        .input-custom::placeholder {
            color: white;
            opacity: 0.7;
        }
        .btn-custom {
            background-color: #a44d4d;
            color: white;
            border: none;
            border-radius: 10px;
            height: 45px;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #813636;
        }
        .text-link {
            color: black;
            font-size: 14px;
            text-decoration: none;
        }
        .text-link:hover {
            text-decoration: underline;
        }
        .text-link-login {
            color: #813636;
            font-size: 14px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card-custom text-center">
            <h2 class="mb-4 title-pink">ToList</h2>

            <!-- Menampilkan pesan error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3 text-start">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control input-custom" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3 text-start">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" class="form-control input-custom" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control input-custom" name="password" required>
                </div>
                <button type="submit" class="btn btn-custom w-100">Sign up</button>
            </form>
            <p class="mt-3">
                <a href="{{ route('login') }}" class="text-link">Have an account?</a>
                <a href="{{ route('login') }}" class="text-link-login">Login</a>
            </p>
        </div>
    </div>
</body>
</html>
