<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToList - Register</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      height: 100vh;
      background-color: #fef6f6;
      display: flex;
    }

    .left-panel {
      flex: 1;
      background: #ffd6d6;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 60px;
      text-align: center;
    }

    .left-panel img {
      width: 300px;
      margin-bottom: 30px;
      border-radius: 20px;
    }

    .left-panel h3 {
      font-size: 20px;
      color: #3d534e;
      margin-bottom: 10px;
    }

    .left-panel p {
      font-size: 14px;
      color: #516c66;
    }

    .right-panel {
      flex: 1;
      background: white;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px;
    }

    .register-box {
      width: 100%;
      max-width: 380px;
    }

    .register-box h2 {
      font-weight: 600;
      margin-bottom: 30px;
      color: #3d3d3d;
      text-align: center;
    }

    .form-label {
      font-weight: 500;
      color: #5c5c5c;
    }

    .form-control {
      border-radius: 12px;
      background-color: #f3f3f3;
      border: none;
    }

    .form-control:focus {
      box-shadow: 0 0 5px #ffd1d1;
    }

    .btn-custom {
      background: #ff8f8f;
      color: white;
      border: none;
      border-radius: 12px;
      width: 100%;
      height: 45px;
      font-weight: 600;
    }

    .btn-custom:hover {
      background: #ffa0a0;
    }

    .text-link {
      font-size: 14px;
      color: #7a3e3e;
      text-decoration: none;
    }

    .text-link:hover {
      text-decoration: underline;
    }

    .alert {
      font-size: 14px;
    }

  </style>
</head>
<body>

  <!-- Panel Ilustrasi -->
  <div class="left-panel">
    <img src="{{ asset('assets/todo3.png') }}" alt="To-do Illustration">
    <h3>List it, do it!</h3>
    <p>Buat daftar, selesaikan, dan tetap produktif setiap hari 💪</p>
  </div>

  <!-- Panel Form Register -->
  <div class="right-panel">
    <div class="register-box">
      <h2>Create Account</h2>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
          <label for="name" class="form-label">Username</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-custom">Sign Up</button>
      </form>

      <p class="mt-4 text-center">
        <a href="{{ route('login') }}" class="text-link">Sudah punya akun? Login</a>
      </p>
    </div>
  </div>

</body>
</html>
