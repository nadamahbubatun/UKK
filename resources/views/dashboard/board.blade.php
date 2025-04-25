<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ToList - Board</title>

  <!-- Fonts & Styles -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    :root {
      --bg-main: linear-gradient(135deg, #fff5f5, #ffeaea);
      --bg-sidebar: linear-gradient(135deg, #ff8c8c, #ffbaba);
      --text-primary: #ff6b6b;
      --text-dark: #333;
      --card-bg: white;
      --card-shadow: rgba(255, 137, 137, 0.15);
      --search-bg: white;
    }

    body.dark {
      --bg-main: linear-gradient(135deg, #1a1a1a, #2a2a2a);
      --bg-sidebar: linear-gradient(135deg, #3a1c1c, #5c2e2e);
      --text-primary: #ff9f9f;
      --text-dark: #f0f0f0;
      --card-bg: #2a2a2a;
      --card-shadow: rgba(255, 137, 137, 0.2);
      --search-bg: #333;
    }

    * {
      font-family: 'Poppins', sans-serif;
    }

    body {
      margin: 0;
      background: var(--bg-main);
      min-height: 100vh;
      display: flex;
      transition: background 0.3s ease;
    }

    .sidebar {
      width: 260px;
      background: var(--bg-sidebar);
      padding: 30px 20px;
      height: 100vh;
      position: fixed;
      box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
      border-top-right-radius: 30px;
      border-bottom-right-radius: 30px;
      color: white;
    }

    .sidebar h4 {
      font-weight: 700;
      margin-bottom: 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .toggle-darkmode {
      background: rgba(255, 255, 255, 0.2);
      border: none;
      color: white;
      border-radius: 50%;
      width: 34px;
      height: 34px;
      font-size: 16px;
      cursor: pointer;
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
      color: var(--text-dark);
    }

    .content h2 {
      font-weight: 700;
      color: var(--text-primary);
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
      background: var(--card-bg);
      border-radius: 16px;
      box-shadow: 0 8px 24px var(--card-shadow);
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: var(--text-primary);
      font-weight: 600;
      font-size: 16px;
      position: relative;
      transition: all 0.3s ease-in-out;
      cursor: pointer;
      text-decoration: none;
    }

    .board-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 30px var(--card-shadow);
    }

    .options {
      position: absolute;
      top: 10px;
      right: 10px;
    }

    .new-board {
      font-size: 48px;
      font-weight: bold;
      background: var(--card-bg);
      color: var(--text-primary);
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
      background: var(--search-bg);
      color: var(--text-dark);
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
      color: var(--text-primary);
    }

    .empty-placeholder {
  font-size: 16px;
  color: var(--text-dark);
  text-align: center;
  padding: 20px;
}

/* Tambahkan ini untuk dark mode */
@media (prefers-color-scheme: dark) {
  .empty-placeholder {
    color: white;
  }
}

    .tip-card {
      background: #fff8e1;
      border-radius: 12px;
      padding: 15px;
      font-size: 14px;
      color: #333;
      margin-top: 20px;
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
    h5.mt-4 {
  color: var(--text-dark);
}

/* Gaya dasar untuk .new-board */


/* Dark mode support */
@media (prefers-color-scheme: dark) {
  h5.mt-4 {
    color: white;
  }

  .board-card.new-board {
    color: white;
    background-color: #2a2a2a;
    border-color: #555;
  }
}
/* H5 pakai warna variabel agar dinamis */
h5.mt-4 {
  color: var(--text-dark);
}

/* Pastikan new-board pakai variabel, bukan warna hardcode */
.board-card.new-board {
  color: var(--text-primary);
  background-color: var(--card-bg);
  border: 2px dashed var(--card-border, #ccc); /* fallback jika tidak ada */
}

/* Pastikan dark mode tetap override dengan class 'dark' */
body.dark h5.mt-4 {
  color: var(--text-dark);
}

body.dark .board-card.new-board {
  color: var(--text-primary);
  background-color: var(--card-bg);
  border-color: var(--card-border);
}
:root, body.dark {
  transition: all 0.3s ease;
}
:root {
  --text-dark: #333;
  --card-bg: white;
}

body.dark {
  --text-dark: #f0f0f0;
  --card-bg: #2a2a2a;
}
.content {
  color: var(--text-dark);
}

.board-card {
  background: var(--card-bg);
  color: var(--text-primary);
}

.board-card.new-board {
  background-color: var(--card-bg);
  color: var(--text-primary);
  border: 2px dashed var(--text-dark); 
}
.empty-placeholder,
h5,
h2 {
  color: var(--text-dark);
}


  </style>
</head>

<body>
  
@include('layouts.sidebar')

  <div class="content">
    <h2>Your Boards</h2>

    <div class="search-bar">
      <input type="text" id="searchInput" placeholder="Search Board...">
      <i class="fas fa-search search-icon"></i>
    </div>

    <div class="board-container" id="boardContainer">
      @forelse($boards as $board)
        <a href="{{ route('board.show', $board->id) }}" class="board-card board-item">
          {{ $board->name }}
          <div class="dropdown options">
            <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu">
              <li>
                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editBoardModal{{ $board->id }}">
                  Edit
                </button>
              </li>
              <li>
  <form action="{{ route('board.destroy', $board->id) }}" method="POST" class="delete-board-form">
    @csrf
    @method('DELETE')
    <button class="dropdown-item text-danger" type="button" onclick="confirmDeleteBoard(this)">
      Delete
    </button>
  </form>
</li>

            </ul>
          </div>   
        </a>
      @empty
        <div class="empty-placeholder">
          📭 Belum ada board. Yuk buat board pertamamu!
        </div>
      @endforelse
    </div>

    <h5 class="mt-4">Create New Board</h5>
    <div class="board-container">
      <div class="board-card new-board" onclick="openPopup()">+</div>
    </div>

    <div class="tip-card">
      💡 <strong>Tips:</strong> Kamu bisa gunakan board untuk memisahkan proyek seperti "Kuliah", "Kerja", atau "Pribadi".
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

  <!-- Scripts -->
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

    function toggleDarkMode() {
      const body = document.body;
      body.classList.toggle('dark');
      localStorage.setItem('darkMode', body.classList.contains('dark') ? 'true' : 'false');
    }

    // Load saved dark mode
    if (localStorage.getItem('darkMode') === 'true') {
      document.body.classList.add('dark');
    }
  </script>
  <script>
  function confirmDeleteBoard(button) {
    Swal.fire({
      title: 'Hapus board ini?',
      text: "Seluruh list dan task dalam board juga akan ikut terhapus.",
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
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
