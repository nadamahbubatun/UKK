<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToList - Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #ffe5e5, #ffd6d6);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-custom {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .title-pink {
            background: linear-gradient(to right, #ff8c8c, #ffbaba);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 32px;
            font-weight: 600;
        }

        .form-label {
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 6px;
            color: #7a3e3e;
        }

        .input-custom {
            background-color: #f3d3d3;
            border: none;
            border-radius: 12px;
            height: 45px;
            text-align: center;
            color: #7a3e3e;
            transition: 0.3s;
        }

        .input-custom::placeholder {
            color: #a97a7a;
        }

        .input-custom:focus {
            outline: none;
            box-shadow: 0 0 5px #ffbaba;
        }

        .btn-custom {
            background: linear-gradient(to right, #ff9a9a, #ffbaba);
            color: white;
            border: none;
            border-radius: 12px;
            height: 45px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: #ffc1c1;
            color: #7a3e3e;
        }

        .text-link {
            color: #7a3e3e;
            font-size: 14px;
            text-decoration: none;
            transition: 0.2s;
        }

        .text-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="card-custom text-center">
        <h2 class="mb-4 title-pink">ToList</h2>

        <form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="mb-3 text-start">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control input-custom" placeholder="Masukkan username" id="username" name="username" required>
    </div>
    <div class="mb-3 text-start">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control input-custom" placeholder="Masukkan password" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-custom w-100 mt-2">Sign In</button>
</form>


        <p class="mt-4">
            <a href="{{ route('register') }}" class="text-link">Create Account</a>
        </p>
    </div>
</body>
</html>
