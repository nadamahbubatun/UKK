<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Task</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #ffe5e5, #ffd6d6);
            padding: 0;
            margin: 0;
        }

        .container {
            margin-top: 50px;
            background: white;
            border-radius: 15px;
            padding: 30px;
            max-width: 600px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #7A3E3E;
            font-weight: bold;
            font-size: 28px;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            color: #7A3E3E;
            margin-bottom: 6px;
        }

        .form-control {
            border-radius: 12px;
            background-color: #f3d3d3;
            color: #7A3E3E;
            border: none;
            transition: 0.3s;
        }

        .form-control:focus {
            box-shadow: 0 0 5px #ffbaba;
            outline: none;
        }

        .btn-custom {
            background: linear-gradient(to right, #ff9a9a, #ffbaba);
            color: white;
            border: none;
            border-radius: 12px;
            height: 45px;
            font-weight: 600;
            width: 100%;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: #ffc1c1;
            color: #7a3e3e;
        }

        .btn-back {
            background-color: #a44d4d;
            color: white;
            border: none;
            border-radius: 12px;
            height: 45px;
            font-weight: 600;
            margin-top: 15px;
            width: 100%;
        }

        .btn-back:hover {
            background-color: #813636;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Task</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('tasks.store', ['boardId' => $boardId, 'listId' => $listId]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Task:</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <input type="hidden" name="board_id" value="{{ $boardId }}">
            <input type="hidden" name="list_id" value="{{ $listId }}">

            <div class="mb-3">
    <label for="list_id" class="form-label">Pilih List:</label>
    <select name="list_id" class="form-control" required>
        @foreach($lists as $list)
            <option value="{{ $list->id }}" {{ $list->id == $listId ? 'selected' : '' }}>
                {{ $list->name }}
            </option>
        @endforeach
    </select>
</div>

            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select name="status" class="form-control">
                    <option value="Belum Selesai">Belum Selesai</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="priority" class="form-label">Prioritas:</label>
                <select name="priority" class="form-control">
                    <option value="Rendah">Rendah</option>
                    <option value="Sedang">Sedang</option>
                    <option value="Tinggi">Tinggi</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Tanggal Mulai:</label>
                <input type="date" class="form-control" name="start_date">
            </div>

            <div class="mb-3">
                <label for="end_date" class="form-label">Tanggal Selesai:</label>
                <input type="date" class="form-control" name="end_date">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi:</label>
                <textarea class="form-control" name="description"></textarea>
            </div>

            <button type="submit" class="btn btn-custom">Tambah Task</button>
        </form>

        <a href="{{ route('tasks.index', ['boardId' => $boardId, 'listId' => $listId]) }}" class="btn btn-back mt-3">Kembali</a>
    </div>
</body>
</html>
