<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToList - Task Edit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">


    
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
    /* Tambahan untuk dark mode pada detail task */
body.dark-mode .card {
  background-color: #2e2e2e;
  color: #f1f1f1;
  box-shadow: 0 4px 12px rgba(255, 255, 255, 0.05);
}

body.dark-mode .card-header {
  background-color: #444;
  color: #ffbaba;
}

body.dark-mode .table {
  background-color: #2e2e2e;
  color: #f1f1f1;
}

body.dark-mode .table th {
  background-color: #444;
  color: #ffbaba;
}

body.dark-mode .table td {
  background-color: #333;
  color: #f1f1f1;
}

body.dark-mode .btn-warning {
  background-color: #ff6b6b;
  color: white;
}

body.dark-mode .btn-warning:hover {
  background-color: #d15a5a;
}

  </style>
</head>
<body>
@include('layouts.sidebar')


<div class="content">
    <h2 class="title">Edit Task</h2>

    <form action="{{ route('tasks.update', ['boardId' => $boardId, 'listId' => $listId, 'id' => $task->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Task</label>
            <input type="text" name="name" class="form-control" value="{{ $task->name }}" required>
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Prioritas</label>
            <select name="priority" class="form-control">
                <option value="Rendah" {{ $task->priority == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                <option value="Sedang" {{ $task->priority == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                <option value="Tinggi" {{ $task->priority == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="Belum Selesai" {{ $task->status == 'Belum Selesai' ? 'selected' : '' }}>Belum Selesai</option>
                <option value="On Progress" {{ $task->status == 'On Progress' ? 'selected' : '' }}>On Progress</option>
                <option value="Selesai" {{ $task->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control" value="{{ $task->start_date }}">
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">Tanggal Selesai</label>
            <input type="date" name="end_date" class="form-control" value="{{ $task->end_date }}">
        </div>

        <div class="mb-4">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4">{{ $task->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mb-2">Update Task</button>
        <a href="{{ route('tasks.index', ['boardId' => $boardId, 'listId' => $listId]) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
