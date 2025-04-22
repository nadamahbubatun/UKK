<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToList - Board</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

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
        .search-bar {
  position: relative;
  width: 250px;
  margin-bottom: 20px;
}

.search-bar input {
  width: 100%;
  padding: 10px 40px 10px 15px;
  border-radius: 999px;
  border: none;
  background-color: white;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
  font-size: 14px;
  color: #333;
}

.search-bar input::placeholder {
  color: #aaa;
}

.search-icon {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #666;
  pointer-events: none;
}

.task-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    margin-bottom: 1rem;
}

.search-form {
    display: flex;
    align-items: center;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 0 0.5rem;
    background-color: #fff;
}

.search-form input {
    border: none;
    outline: none;
    padding: 0.5rem;
    width: 200px;
}

.search-btn {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.5rem;
    color: #555;
}

.search-btn:hover {
    color: #000;
}

.add-task {
    padding: 0.5rem 1rem;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
}

.add-task:hover {
    background-color: #45a049;
}
.task-header {
    display: flex;
    justify-content: space-between; /* Atau bisa jadi 'flex-start' kalau mau lebih nempel */
    align-items: center;
    gap: 5px; /* Kurangi dari nilai sebelumnya */
    margin-bottom: 1rem;
}
.task-header {
    display: flex;
    justify-content: flex-start;
    align-items: center;
}

.search-form {
    margin-right: 8px;
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
     @include('layouts.sidebar')
     
    <div class="content">
        <h2 class="title">Daftar Task</h2>


        <form action="{{ route('board.show',$boards->id) }}" method="GET">
            <button type="submit" class="btn  btn-secondary mb-3"> <- kembali ke list</button>
        </form>
        <br>
        <div class="task-header">
        <form action="{{ route('tasks.create', ['boardId' => $boards->id, 'listId' => $lists->id]) }}" method="GET">
        <button type="submit" class="btn add-task">+ add task</button>
    </form>
    <form action="{{ route('tasks.index', ['boardId' => $boards->id, 'listId' => $lists->id]) }}" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search task..." value="{{ request('search') }}">
        <button type="submit" class="search-btn">
            <i class="fas fa-search"></i>
        </button>
    </form>
    <form action="{{ route('tasks.index', ['boardId' => $boards->id, 'listId' => $lists->id]) }}" method="GET" class="ms-2">
    <select name="status" onchange="this.form.submit()" class="form-select" style="width: 180px;">
        <option value="">-Semua Status -</option>
        <option value="Belum Selesai" {{ request('status') == 'Belum Selesai' ? 'selected' : '' }}>Belum Selesai</option>
        <option value="On Progress" {{ request('status') == 'On Progress' ? 'selected' : '' }}>On Progress</option>
        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
    </select>
</form>

    
</div>

<div class="task-list mt-4">@foreach($tasks as $task)
    @php
        $statusClass = match($task->status) {
            'Belum Selesai' => 'badge bg-secondary',
            'On Progress' => 'badge bg-warning text-dark',
            'Selesai' => 'badge bg-success',
            default => 'badge bg-light text-dark'
        };

        $priorityClass = match($task->priority) {
            'Tinggi' => 'text-danger',
            'Sedang' => 'text-warning',
            'Rendah' => 'text-success',
            default => 'text-muted'
        };

        $cardBorder = match($task->status) {
            'Belum Selesai' => 'border-start border-4 border-secondary',
            'On Progress' => 'border-start border-4 border-warning',
            'Selesai' => 'border-start border-4 border-success',
            default => 'border-start border-4 border-light'
        };
    @endphp

    <div class="card mb-3 p-3 shadow-sm {{ $cardBorder }}">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h5 class="mb-1">
                    <i class="bi bi-check2-square me-2"></i>
                    {{ $loop->iteration }}. {{ $task->name }}
                </h5>
                <div class="mb-2">
                    <span class="{{ $statusClass }}">{{ $task->status }}</span>
                    <span class="ms-2 {{ $priorityClass }}"><strong>Prioritas:</strong> {{ $task->priority }}</span>
                </div>
                <div class="small text-muted">
                    <i class="bi bi-calendar-event"></i> {{ $task->start_date }} - {{ $task->end_date }}
                </div>
            </div>
            <div class="btn-group btn-group-sm">
    <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" class="d-inline">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-outline-primary" title="Ubah Status">
            <i class="bi bi-arrow-repeat fs-5"></i>
        </button>
    </form>

    <a href="{{ route('tasks.view', $task->id) }}" class="btn btn-outline-info" title="Lihat Detail">
        <i class="bi bi-eye fs-5"></i>
    </a>

    <a href="{{ route('tasks.edit', ['boardId' => $boards->id, 'listId' => $lists->id, 'id' => $task->id]) }}" class="btn btn-outline-warning" title="Edit Task">
        <i class="bi bi-pencil-square fs-5"></i>
    </a>

    <form action="{{ route('tasks.destroy', ['boardId' => $boards->id, 'listId' => $lists->id, 'id' => $task->id]) }}" method="POST" class="d-inline delete-task-form">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-outline-danger" onclick="confirmDelete(this)" title="Hapus Task">
            <i class="bi bi-trash fs-5"></i>
        </button>
    </form>
</div>

        </div>
    </div>
@endforeach


    </div>
</body>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmDelete(button) {
    Swal.fire({
      title: 'Yakin ingin menghapus task ini?',
      text: "Tindakan ini tidak bisa dibatalkan!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#e3342f',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        // Temukan form terdekat dan submit
        button.closest('form').submit();
      }
    });
  }

</script>
<!-- Bootstrap Bundle (dengan Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</html>
