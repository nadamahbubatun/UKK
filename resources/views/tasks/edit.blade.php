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
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #ffe5e5, #ffd6d6);
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #B85C5C;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100vh;
            border-radius: 0 15px 15px 0;
        }
        .sidebar h4 {
            color: #fff;
            font-size: 28px;
            font-weight: bold;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            border-radius: 10px;
        }
        .sidebar a.active, .sidebar a:hover {
            background-color: #A46C6C;
            transform: scale(1.05);
        }
        .content {
            margin-left: 270px;
            padding: 30px;
            width: 100%;
        }
        .title {
            color: #7A3E3E;
            font-weight: bold;
            font-size: 32px;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-label {
            color: #7A3E3E;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #B85C5C;
            border: none;
            width: 100%;
            padding: 12px;
            font-weight: bold;
            border-radius: 12px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #A46C6C;
            transform: scale(1.05);
        }
        .btn-secondary {
            background-color: #6c757d;
            width: 100%;
            padding: 12px;
            font-weight: bold;
            border-radius: 12px;
            text-align: center;
            transition: 0.3s;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4>ToList</h4>
    <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
    <a href="{{ route('board.index') }}" class="active"><i class="fas fa-box"></i> Board</a>
    <a href="#"><i class="fas fa-calendar-alt"></i> Calendar</a>
</div>

<div class="content">
    <h2 class="text-center mb-4">Edit Task</h2>

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

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4">{{ $task->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
        <a href="{{ route('tasks.index', ['boardId' => $boardId, 'listId' => $listId]) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
