<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToList - Board</title>
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

        .add-task {
            background-color: rgb(198, 129, 129);
            color: white;
            font-weight: bold;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .add-task:hover {
            background-color: #c8c8c8;
        }

        table {
            background-color: #f8f9fa;
            color: #7A3E3E;
        }

        th {
            background-color: rgb(174, 110, 110) !important;
            color: white !important;
        }

        td {
            vertical-align: middle;
        }

        .btn-sm {
            margin: 2px;
        }
        .btn-view{
            background-color:rgb(188, 143, 143);
        }
        .btn-delete{
            background-color:rgb(168, 55, 55);
        }
        .btn-edit{
            background-color:rgb(127, 80, 80);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4>ToList</h4>
        <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
        <a href="#" class="active"><i class="fas fa-box"></i> Board</a>
        <a href="#"><i class="fas fa-calendar-alt"></i> Calendar</a>
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
                @foreach($tasks as $index => $row)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $row->name }}</td>
                        <td>
                            <form action="{{ route('tasks.updateStatus', $row->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $row->status == 'Selesai' ? 'btn-success' : 'btn-secondary' }}">
                                    {{ $row->status }}
                                </button>
                            </form>
                        </td>
                        <td>{{ $row->priority }}</td>
                        <td>{{ $row->start_date }}</td>
                        <td>{{ $row->end_date }}</td>
                        <td>
                            <a href="{{ route('tasks.edit', ['boardId' => $boards->id, 'listId' => $lists->id, 'id' => $row->id]) }}" class="btn btn-edit">Edit</a>
                            <a href="{{ route('tasks.view', $row->id) }}" class="btn btn-view">View</a>
                            <form action="{{ route('tasks.destroy', $row->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus task ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>