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

        .list-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
            
        }

        .list-card {
            width: 200px;
            height: 120px;
            background-color: #D9D9D9;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            position: relative;
            cursor: pointer;
            transition: background 0.3s;
            color: #7A3E3E;
        }

        .list-card:hover {
            background-color: #c8c8c8;
        }

        .options {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .add-list-form {
            margin-bottom: 20px;
        }

        .dropdown-menu {
            z-index: 999;
        }
        
        .search-bar {
            width: 250px;
            margin-bottom: 20px;
            position: relative;
        }

        .search-bar input {
            padding: 8px 30px 8px 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
            width: 100%;
        }

        .search-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: gray;
        }

        .popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.popup-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 350px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    position: relative;
    animation: fadeIn 0.3s ease-in-out;
}

/* Animasi agar pop-up muncul dengan efek */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 20px;
    cursor: pointer;
    color: #333;
    transition: 0.3s;
}

.close-btn:hover {
    color: red;
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
        <h2 class="title">{{ $board->name }}</h2>

        <div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search List...">
    <i class="fas fa-search search-icon"></i>
</div>

        {{-- Form Tambah List --}}
        <button class="btn btn-primary" onclick="openPopup()">+ add list</button>

<!-- Pop-up Form -->
<div id="popupForm" class="popup">
  <div class="popup-content">
    <span class="close-btn" onclick="closePopup()">&times;</span>
    <h5>Tambah List Baru</h5>
    <form action="{{ route('board.addList', $board->id) }}" method="POST">
      @csrf
      <input type="text" name="name" placeholder="Nama List" required class="form-control mb-3">
      <button type="submit" class="btn btn-primary w-100">Tambah List</button>
    </form>
  </div>
</div>
        {{-- List dan Task --}}
        <div class="list-container">
            @foreach ($board->lists as $list)
                <div class="list-card">
                <a href="{{ route('tasks.index', ['boardId' => $board->id, 'listId' => $list->id]) }}" 
       class="list-card">
        {{ $list->name }}
    </a>

                    <!-- Tombol Titik 3 -->
                    <div class="dropdown options">
                        <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <!-- Edit List -->
                            <li>
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editListModal{{ $list->id }}">Edit</button>
                            </li>

                            <!-- Hapus List -->
                            <li>
                                <form action="{{ route('list.destroy', $list->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item text-danger" type="submit" onclick="return confirm('Yakin ingin menghapus list ini?')">Delete</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Modal Edit List -->
                <div class="modal fade" id="editListModal{{ $list->id }}" tabindex="-1" aria-labelledby="editListModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit List</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('list.update', $list->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="list_name" class="form-label">List Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $list->name }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
    <script>
  function openPopup() {
    document.getElementById('popupForm').style.display = 'flex';
  }

  function closePopup() {
    document.getElementById('popupForm').style.display = 'none';
  }
  document.getElementById('searchInput').addEventListener('input', function () {
    let filter = this.value.toLowerCase();
    let listItems = document.querySelectorAll('.list-container .list-card');

    listItems.forEach(function (item) {
        let text = item.textContent.trim().toLowerCase(); // Menghapus spasi ekstra
        if (text.includes(filter)) {
            item.style.display = "flex"; // Pastikan tetap terlihat
        } else {
            item.style.display = "none"; // Sembunyikan jika tidak cocok
        }
    });
});

</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
