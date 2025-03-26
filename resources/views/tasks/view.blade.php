<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToList - Task Detail</title>
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
        .title {
            color: #7A3E3E;
            font-weight: bold;
            font-size: 32px;
            text-align: center;
            margin-bottom: 20px;
        }
        .table th {
            background-color: #f1f1f1;
            color: #7A3E3E;
        }
        .btn-warning {
            background-color: #A46C6C;
            border: none;
            color: white;
        }
        .btn-warning:hover {
            background-color: #8B5C5C;
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
    <div class="content-body">
        <div class="card-header">
            <h3 class="text-center" style="color: #041E60; font-weight: bold;">Detail Task</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-9">
                <div class="card">
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
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>