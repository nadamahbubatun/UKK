<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToList - Board</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #ffe5e5, #ffd6d6);
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(to bottom, #ff8c8c, #ffbaba);
            color: white;
            padding: 20px;
            position: fixed;
            height: 100vh;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 12px;
            margin-bottom: 10px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .sidebar a.active, .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .content {
            margin-left: 270px;
            padding: 30px;
            width: 100%;
        }

        .title {
            color: #7A3E3E;
            font-weight: 600;
            font-size: 30px;
            text-align: center;
            margin-bottom: 25px;
        }

        .add-task {
            background: linear-gradient(to right, #ff9a9a, #ffbaba);
            color: white;
            font-weight: 600;
            border: none;
            padding: 10px 18px;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .add-task:hover {
            background: #ffc2c2;
            color: #7A3E3E;
        }

        table {
            background-color: white;
            color: #7A3E3E;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #ff9a9a !important;
            color: white !important;
        }

        td {
            vertical-align: middle;
        }

        .btn-sm {
            margin: 2px;
        }

        .btn-view {
            background-color: #f7bdbd;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-view:hover {
            background-color: #f0a0a0;
        }

        .btn-edit {
            background-color: #c88787;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-edit:hover {
            background-color: #b86c6c;
        }

        .btn-delete {
            background-color: #e05d5d;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-delete:hover {
            background-color: #c14444;
        }

        .btn-group a, .btn-group form {
            margin-right: 5px;
        }

    </style>
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete this task?')) {
                event.target.closest('form').submit();
            }
        }
    </script>
</head>
<body>
    <div class="sidebar">
        <h4 class="mb-4">ToList</h4>
        <a href="{{ route('home') }}"><i class="fas fa-home me-2"></i>Home</a>
        <a href="{{ route('board.index') }}" class="active"><i class="fas fa-box me-2"></i>Board</a>
        <a href="{{ route('calendar.show') }}"><i class="fas fa-calendar-alt me-2"></i>Calendar</a>
    </div>

    <div class="content">
        <h2 class="title">Daftar Task</h2>

        <form action="{{ route('tasks.create', ['boardId' => $boards->id, 'listId' => $lists->id]) }}" method="GET">
            <button type="submit" class="btn add-task">+ add task</button>
        </form>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Prioritas</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $task->name }}</td>
                    <td>
                        <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $task->status == 'Selesai' ? 'btn-success' : 'btn-secondary' }}">
                                {{ $task->status }}
                            </button>
                        </form>
                    </td>
                    <td>{{ $task->priority }}</td>
                    <td>{{ $task->start_date }}</td>
                    <td>{{ $task->end_date }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('tasks.edit', ['boardId' => $boards->id, 'listId' => $lists->id, 'id' => $task->id]) }}" class="btn btn-edit">Edit</a>
                            <a href="{{ route('tasks.view', $task->id) }}" class="btn btn-view">View</a>
                            <form action="{{ route('tasks.destroy', ['boardId' => $boards->id, 'listId' => $lists->id, 'id' => $task->id]) }}" method="POST" onsubmit="confirmDelete(event)" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
