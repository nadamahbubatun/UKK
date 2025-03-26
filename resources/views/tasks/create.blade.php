<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Task</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Task</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name">Nama Task:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <input type="hidden" name="board_id" value="{{ $boardId }}">
            <input type="hidden" name="list_id" value="{{ $listId }}">
            <div class="mb-3">
                <label for="list_id">Pilih List:</label>
                <select name="list_id" class="form-control" required>
                    @foreach($lists as $list)
                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="status">Status:</label>
                <select name="status" class="form-control">
                    <option value="Belum Selesai">Belum Selesai</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="priority">Prioritas:</label>
                <select name="priority" class="form-control">
                    <option value="Rendah">Rendah</option>
                    <option value="Sedang">Sedang</option>
                    <option value="Tinggi">Tinggi</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="start_date">Tanggal Mulai:</label>
                <input type="date" class="form-control" name="start_date">
            </div>

            <div class="mb-3">
                <label for="end_date">Tanggal Selesai:</label>
                <input type="date" class="form-control" name="end_date">
            </div>

            <div class="mb-3">
                <label for="description">Deskripsi:</label>
                <textarea class="form-control" name="description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Task</button>
        </form>

        <a href="{{ route('tasks.index', ['boardId' => $boardId, 'listId' => $listId]) }}" class="btn btn-secondary mt-3">kembali</a>

        
    </div>
</body>
</html>
