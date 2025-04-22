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
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: #fdfbfb;
            background: linear-gradient(to right, #ffffff, #fceef3);
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

        .sidebar h4 {
            font-weight: 600;
            margin-bottom: 30px;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s;
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
            color: #d04e4e;
            font-weight: 600;
            font-size: 32px;
            text-align: center;
            margin-bottom: 30px;
        }

        .search-bar {
            width: 250px;
            margin-bottom: 20px;
            position: relative;
        }

        .search-bar input {
            padding: 10px 35px 10px 15px;
            border-radius: 25px;
            border: 1px solid #ccc;
            width: 100%;
            transition: all 0.3s;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #ff8c8c;
            box-shadow: 0 0 5px rgba(255, 140, 140, 0.4);
        }

        .search-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: gray;
        }

        .btn-primary {
            background: linear-gradient(to right, #ff8c8c, #ffbaba);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 500;
            box-shadow: 0 4px 8px rgba(255, 140, 140, 0.3);
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #ff7b7b, #ffadad);
            box-shadow: 0 6px 12px rgba(255, 120, 120, 0.4);
        }

        .list-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }

        .list-card {
            width: 220px;
            height: 130px;
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.07);
            font-size: 16px;
            font-weight: 500;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            color: #d04e4e;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .list-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(255, 140, 140, 0.3);
        }

        .options {
            position: absolute;
            top: 10px;
            right: 10px;
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
            z-index: 1000;
        }

        .popup-content {
            background-color: white;
            padding: 25px;
            border-radius: 15px;
            width: 350px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: fadeIn 0.3s ease-in-out;
        }

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
            font-size: 22px;
            cursor: pointer;
            color: #555;
        }

        .close-btn:hover {
            color: red;
        }
        .list-card:hover {
    transform: scale(1.05) rotate(-1deg);
    box-shadow: 0 10px 20px rgba(255, 140, 140, 0.4);
}
* {
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease-in-out;
}
.btn-primary {
    background: linear-gradient(270deg, #ff8c8c, #ffbaba);
    background-size: 200% 200%;
    animation: gradientMove 4s ease infinite;
    ...
}

@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
.alert-custom {
    background: linear-gradient(to right, #ffe6e6, #ffdada);
    border: 1px solid #ffbaba;
    color: #d04e4e;
    padding: 16px 24px;
    border-radius: 20px;
    font-weight: 500;
    box-shadow: 0 4px 8px rgba(255, 170, 170, 0.2);
}

    </style>
</head>
<body>
@include('layouts.sidebar')

    <div class="content">
        <h2 class="title">{{ $board->name }}</h2>

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search List...">
            <i class="fas fa-search search-icon"></i>
        </div>

        <button class="btn btn-primary" onclick="openPopup()">+ Add List</button>

        <!-- Pop-up Form -->
        <div id="popupForm" class="popup">
            <div class="popup-content">
                <span class="close-btn" onclick="closePopup()">&times;</span>
                <h5 class="mb-3">Tambah List Baru</h5>
                <form action="{{ route('board.addList', $board->id) }}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Nama List" required class="form-control mb-3">
                    <button type="submit" class="btn btn-primary w-100">Tambah List</button>
                </form>
            </div>
        </div>
        <div class="alert-custom text-center mt-4">
    🎯 Kamu telah membuat <strong>{{ $board->lists->count() }}</strong> list!
</div>



        <div class="list-container">
            @foreach ($board->lists as $list)
                <div class="position-relative">
                    <a href="{{ route('tasks.index', ['boardId' => $board->id, 'listId' => $list->id]) }}" class="list-card">
                        {{ $list->name }}
                    </a>

                    <div class="dropdown options">
                        <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editListModal{{ $list->id }}">Edit</button>
                            </li>
                            <li>
    <form action="{{ route('list.destroy', $list->id) }}" method="POST" class="delete-list-form">
        @csrf
        @method('DELETE')
        <button class="dropdown-item text-danger" type="button" onclick="confirmDeleteList(this)">Delete</button>
    </form>
</li>

                        </ul>
                    </div>
                </div>

                <!-- Modal Edit List -->
                <div class="modal fade" id="editListModal{{ $list->id }}" tabindex="-1" aria-labelledby="editListModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content rounded-3">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit List</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('list.update', $list->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="form-label">List Name</label>
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
                let text = item.textContent.trim().toLowerCase();
                item.style.display = text.includes(filter) ? "flex" : "none";
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
  function confirmDeleteList(button) {
    Swal.fire({
      title: 'Yakin ingin menghapus list ini?',
      text: "Semua task dalam list juga akan ikut terhapus.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#e3342f',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        button.closest('form').submit();
      }
    });
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
