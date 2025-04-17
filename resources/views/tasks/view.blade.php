<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ToList - Task Detail</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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

    .title {
      font-weight: 700;
      color: #ff7070;
      margin-bottom: 20px;
      text-align: center;
    }

    .table th {
      background-color: #f1f1f1;
      color: #ff6b6b;
    }

    .btn-warning {
      background-color: #ff7070;
      border: none;
      color: white;
      border-radius: 12px;
      padding: 12px 20px;
      width: 100%;
      font-weight: bold;
      transition: 0.3s;
    }

    .btn-warning:hover {
      background-color: #d15a5a;
      transform: scale(1.05);
    }

    .card {
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      border-radius: 16px;
    }

    .card-header {
      background-color: #ff8c8c;
      color: white;
      font-size: 22px;
      font-weight: 600;
      text-align: center;
      border-top-left-radius: 16px;
      border-top-right-radius: 16px;
      padding: 15px;
    }

    .card-body {
      padding: 25px;
    }

    .popup {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.3);
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    .popup-content {
      background-color: white;
      padding: 25px;
      border-radius: 16px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
      width: 350px;
    }

    .close-btn {
      float: right;
      font-size: 22px;
      cursor: pointer;
      color: #999;
    }

    .popup-content h5 {
      margin-bottom: 20px;
      color: #ff6b6b;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .content {
        margin-left: 0;
        padding: 20px;
      }

      .board-card {
        width: 100%;
      }

      .search-bar {
        width: 100%;
      }
    }
  </style>
</head>

<body>

  <div class="sidebar">
    <h4><i class="fas fa-check-circle me-2"></i>ToList ✨</h4>
    <a href="{{ route('home') }}"><i class="fas fa-home me-2"></i> Home</a>
    <a href="{{ route('board.index') }}" class="active"><i class="fas fa-columns me-2"></i> Board</a>
    <a href="{{ route('calendar.show') }}"><i class="fas fa-calendar-alt me-2"></i> Calendar</a>
  </div>

  <div class="content">
    <div class="card">
      <div class="card-header">
        <h3>Detail Task</h3>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <tr>
            <th>Nama Task</th>
            <td>{{ $tasks->name }}</td>
          </tr>
          <tr>
            <th>Status</th>
            <td>{{ $tasks->status }}</td>
          </tr>
          <tr>
            <th>Prioritas</th>
            <td>{{ $tasks->priority }}</td>
          </tr>
          <tr>
            <th>Tanggal Mulai</th>
            <td>{{ $tasks->start_date ? \Carbon\Carbon::parse($tasks->start_date)->format('d M Y') : '-' }}</td>
          </tr>
          <tr>
            <th>Tanggal Selesai</th>
            <td>{{ $tasks->end_date ? \Carbon\Carbon::parse($tasks->end_date)->format('d M Y') : '-' }}</td>
          </tr>
          <tr>
            <th>Deskripsi</th>
            <td>{{ $tasks->description }}</td>
          </tr>
        </table>
        <a href="{{ route('tasks.index', ['boardId' => $tasks->list->board_id, 'listId' => $tasks->list_id]) }}" class="btn btn-warning">Kembali</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
