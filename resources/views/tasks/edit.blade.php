<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToList - Task Edit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            background-color: #B85C5C;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100vh;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }
        .sidebar a.active, .sidebar a:hover {
            background-color: #A46C6C;
            border-radius: 5px;
        }
        .content {
            margin-left: 270px;
            padding: 30px;
            width: 100%;
        }
        .form-label {
            color: #7A3E3E;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #B85C5C;
            border: none;
        }
        .btn-primary:hover {
            background-color: #A46C6C;
        }
        .btn-secondary {
            background-color: #6c757d;
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