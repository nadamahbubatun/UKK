<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToList - Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Posisi tengah */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f8f8; /* Latar belakang abu-abu terang */
        }

        /* Style untuk card utama */
        .card-custom {
            background-color: #eee; /* Warna latar card */
            border-radius: 15px;
            padding: 30px;
            width: 350px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Style untuk judul "ToList" */
        .title-pink {
            color:  #813636; /* Warna pink */
            font-weight: bold;
        }

        /* Style untuk label */
        .form-label {
            font-weight: bold;
            color: black;
            font-size: 14px;
            margin-bottom: 5px;
            text-align: left;
            display: block;
        }

        /* Style untuk input */
        .input-custom {
            background-color: #c99595; /* Warna input pink soft */
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

        /* Style tombol */
        .btn-custom {
            background-color: #a44d4d; /* Warna tombol merah soft */
            color: white;
            border: none;
            border-radius: 10px;
            height: 45px;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #813636; /* Warna lebih gelap saat hover */
        }

        /* Style untuk link */
        .text-link {
            color: black;
            font-size: 14px;
            text-decoration: none;
        }
        .text-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card-custom text-center">
            <h2 class="mb-4 title-pink">ToList</h2> <!-- Warna pink -->
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3 text-start">
                    <class for="username" class="form-class">Username</class>
                    <input type="text" class="form-control input-custom" placeholder="" id="" name="" required>
                </div>
                <div class="mb-3 text-start">
                    <class for="password" class="form-class">Password</class>
                    <input type="password" class="form-control input-custom" placeholder="" id="" name="" required>
                </div>
                <button type="submit" class="btn btn-custom w-100">Sign In</button>
              
            </form>
            <p class="mt-3">
                <a href="{{ route('register') }}" class="text-link">Create Account</a>
            </p>
        </div>
    </div>
</body>
</html>
