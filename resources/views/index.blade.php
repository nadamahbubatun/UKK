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
      height: 100vh;
      background-color: #fef6f6;
      display: flex;
    }

    .left-panel {
      flex: 1;
      background: #c5e2da;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 60px;
      text-align: center;
    }

    .left-panel img {
      width: 250px;
      margin-bottom: 30px;
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

    .login-box {
      width: 100%;
      max-width: 380px;
    }

    .login-box h2 {
      font-weight: 600;
      margin-bottom: 30px;
      color: #3d3d3d;
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

    .left-panel {
  flex: 1;
  background: #ffd6d6; /* Warna pink soft */
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 10px;
  text-align: center;
}
.left-panel img.todo-img {
  width: 300px; /* Lebih besar dari sebelumnya */
  max-width: 100%;
  margin-bottom: 50px;
  border-radius: 20px; /* opsional: biar lebih halus ujungnya */
}

  </style>
</head>
<body>

  <!-- Panel Ilustrasi Kiri -->
  <div class="left-panel">
  <img src="{{ asset('assets/todo3.png') }}" alt="To-do Illustration" class="todo-img">
  <h3>List it, do it!</h3>
  <p>Organisir tugasmu dengan rapi. Buat harimu lebih produktif 💪</p>
</div>


  <!-- Panel Form Login -->
  <div class="right-panel">
    <div class="login-box">
      <h2>Welcome Back to ToList!</h2>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="btn btn-custom">Sign In</button>
      </form>
      <p class="mt-4 text-center">
        <a href="{{ route('register') }}" class="text-link">Belum punya akun? Daftar sekarang</a>
      </p>
    </div>
  </div>

</body>
</html>
