
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/app.css">

  <style>
    * {
      font-family: 'Poppins', sans-serif;
    }

    body {
      margin: 0;
      background: linear-gradient(135deg, #f9e7e7, #fdf7f7);
      min-height: 100vh;
      display: flex;
    }

    .sidebar {
      width: 260px;
      background: linear-gradient(135deg, #ff8c8c, #ffbaba);
      padding: 30px 20px;
      height: 100vh;
      position: fixed;
      box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
      border-top-right-radius: 30px;
      border-bottom-right-radius: 30px;
    }

    .sidebar h4 {
      color: white;
      font-weight: 700;
      margin-bottom: 40px;
    }

    .sidebar a {
      display: block;
      color: white;
      text-decoration: none;
      font-weight: 500;
      padding: 12px 15px;
      margin-bottom: 15px;
      border-radius: 12px;
      transition: 0.3s;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background: rgba(255, 255, 255, 0.2);
    }

    .content {
      margin-left: 270px;
      padding: 40px;
      width: 100%;
    }

    .content h2 {
      font-weight: 700;
      color: #ff7070;
      margin-bottom: 30px;
    }

    .dashboard-card {
      background: white;
      border-radius: 20px;
      padding: 25px;
      box-shadow: 0 10px 30px rgba(255, 137, 137, 0.2);
      transition: all 0.3s ease-in-out;
      cursor: pointer;
    }

    .dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(255, 137, 137, 0.3);
    }

    .dashboard-icon {
      font-size: 40px;
      color: #ff6b6b;
      margin-bottom: 15px;
    }

    .dashboard-title {
      font-weight: 600;
      font-size: 18px;
      color: #333;
    }

    .dashboard-number {
      font-size: 32px;
      font-weight: 700;
      color: #111;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .content {
        margin-left: 0;
        padding: 20px;
      }
    }
  </style>
</head>
<body>
@include('layouts.sidebar')
<div class="content">
    <h2>Profil Saya 👤</h2>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="dashboard-card">
                <h5><strong>Nama:</strong></h5>
                <p>{{ $user->name }}</p>
                <h5><strong>Email:</strong></h5>
                <p>{{ $user->email }}</p>
            </div>
        </div>
    </div>

    <h3 class="mb-3">Board Saya:</h3>
    @if($boards->isEmpty())
        <p>Belum ada board.</p>
    @else
    <div class="row g-4">
    @foreach($boards as $board)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('board.show', $board->id) }}" class="text-decoration-none">
                <div class="dashboard-card text-center">
                    <div class="dashboard-icon"><i class="fas fa-folder-open"></i></div>
                    <div class="dashboard-title">{{ $board->name }}</div>
                </div>
            </a>
        </div>
    @endforeach
</div>

    @endif
</div>

</body>
</html>
