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

        .sidebar a.active,
        .sidebar a:hover {
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

        .board-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .board-card {
            width: 200px;
            height: 120px;
            background-color: #D9D9D9;
            border-radius: 8px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #7A3E3E;
            font-size: 16px;
            font-weight: bold;
        }

        .options {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
        }

        .new-board {
            font-size: 40px;
            color: #7A3E3E;
            cursor: pointer;
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

        /* Pop-up style */
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
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
        }

        .close-btn {
            float: right;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4>ToList</h4>
        <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
        <a href="{{ route('board.index') }}" class="active"><i class="fas fa-box"></i> Board</a>
        <a href="#"><i class="fas fa-calendar-alt"></i> Calendar</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2 class="title">ToList</h2>
        <h5>Your Boards</h5>

        <!-- Input Search -->
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search Board...">
            <i class="fas fa-search search-icon"></i>
        </div>

        <!-- Board Container -->
        <div class="board-container" id="boardContainer">
            @foreach($boards as $board)
            <div class="board-card position-relative board-item">
                <a href="{{ route('board.show', $board->id) }}" class="board-card">{{ $board->name }}</a>
                <div class="dropdown options">
                    <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editBoardModal{{ $board->id }}">Edit</button>
                        </li>
                        <li>
                            <form action="{{ route('board.destroy', $board->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item text-danger" type="submit" onclick="return confirm('Yakin ingin menghapus board ini?')">Delete</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Add New Board -->
        <h5>Create New Board</h5>
        <div class="board-container">
            <div class="board-card new-board" onclick="openPopup()">+</div>
        </div>
    </div>

    <!-- Pop-up Form Add List -->
    <div id="popupForm" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h5>Create New Board</h5>
            <form action="{{ route('board.store') }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Board Name" required class="form-control mb-3">
                <button type="submit" class="btn btn-primary w-100">Create Board</button>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function openPopup() {
            document.getElementById('popupForm').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('popupForm').style.display = 'none';
        }

        document.getElementById('searchInput').addEventListener('input', function () {
    let filter = this.value.toLowerCase();
    let listItems = document.querySelectorAll('.list-card'); // Ganti ke list-card

    listItems.forEach(function (item) {
        let text = item.textContent.toLowerCase();
        item.style.display = text.includes(filter) ? '' : 'none';
    });
});

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
