<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ToList - Board</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    * {
      font-family: 'Poppins', sans-serif;
    }

    body {
      margin: 0;
      background: linear-gradient(135deg, #f9e7e7, #fdf7f7);
      min-height: 100vh;
      display: flex;
    }

    .sidebar {
      width: 260px;
      background: linear-gradient(135deg, #ff8c8c, #ffbaba);
      padding: 30px 20px;
      height: 100vh;
      position: fixed;
      box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
      border-top-right-radius: 30px;
      border-bottom-right-radius: 30px;
    }

    .sidebar h4 {
      color: white;
      font-weight: 700;
      margin-bottom: 40px;
    }

    .sidebar a {
      display: block;
      color: white;
      text-decoration: none;
      font-weight: 500;
      padding: 12px 15px;
      margin-bottom: 15px;
      border-radius: 12px;
      transition: 0.3s;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background: rgba(255, 255, 255, 0.2);
    }

    .content {
      margin-left: 270px;
      padding: 40px;
      width: 100%;
    }

    .content h2 {
      font-weight: 700;
      color: #ff7070;
      margin-bottom: 20px;
    }

    .board-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .board-card {
      width: 220px;
      height: 130px;
      background: white;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(255, 137, 137, 0.15);
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #ff6b6b;
      font-weight: 600;
      font-size: 16px;
      position: relative;
      transition: all 0.3s ease-in-out;
      cursor: pointer;
      text-decoration: none;
    }

    .board-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 30px rgba(255, 137, 137, 0.25);
    }

    .options {
      position: absolute;
      top: 10px;
      right: 10px;
    }

    .new-board {
      font-size: 48px;
      font-weight: bold;
      background: white;
      color: #ff6b6b;
    }

    .search-bar {
      width: 300px;
      margin-bottom: 30px;
      position: relative;
    }

    .search-bar input {
      padding: 10px 40px 10px 15px;
      border-radius: 20px;
      border: 1px solid #ddd;
      width: 100%;
    }

    .search-icon {
      position: absolute;
      right: 15px;
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
      background-color: rgba(0, 0, 0, 0.3);
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    .popup-content {
      background-color: white;
      padding: 25px;
      border-radius: 16px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
      width: 350px;
    }

    .close-btn {
      float: right;
      font-size: 22px;
      cursor: pointer;
      color: #999;
    }

    .popup-content h5 {
      margin-bottom: 20px;
      color: #ff6b6b;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .content {
        margin-left: 0;
        padding: 20px;
      }

      .board-card {
        width: 100%;
      }

      .search-bar {
        width: 100%;
      }
    }
  </style>
</head>

<body>

  <div class="sidebar">
    <h4><i class="fas fa-check-circle me-2"></i>ToList ✨</h4>
    <a href="{{ route('home') }}"><i class="fas fa-home me-2"></i> Home</a>
    <a href="{{ route('board.index') }}" class="active"><i class="fas fa-columns me-2"></i> Board</a>
    <a href="{{ route('calendar.show') }}"><i class="fas fa-calendar-alt me-2"></i> Calendar</a>
  </div>

  <div class="content">
    <h2>Your Boards</h2>

    <div class="search-bar">
      <input type="text" id="searchInput" placeholder="Search Board...">
      <i class="fas fa-search search-icon"></i>
    </div>

    <div class="board-container" id="boardContainer">
      @foreach($boards as $board)
      <a href="{{ route('board.show', $board->id) }}" class="board-card board-item">
        {{ $board->name }}
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
      </a>
      @endforeach
    </div>

    <h5 class="mt-4">Create New Board</h5>
    <div class="board-container">
      <div class="board-card new-board" onclick="openPopup()">+</div>
    </div>
  </div>

  <!-- Pop-up -->
  <div id="popupForm" class="popup">
    <div class="popup-content">
      <span class="close-btn" onclick="closePopup()">&times;</span>
      <h5>Create New Board</h5>
      <form action="{{ route('board.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Board Name" required class="form-control mb-3">
        <button type="submit" class="btn btn-danger w-100">Create</button>
      </form>
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
      let boardItems = document.querySelectorAll('.board-container .board-item');

      boardItems.forEach(function (item) {
        let text = item.textContent.trim().toLowerCase();
        item.style.display = text.includes(filter) ? "flex" : "none";
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
