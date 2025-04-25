<style>
  /* === Dark Mode Styling === */
  body.dark-mode {
    background: linear-gradient(135deg, #2b2b2b, #1e1e1e);
    color: #f1f1f1;
  }

  body.dark-mode .sidebar {
    background: linear-gradient(135deg, #333, #555);
    box-shadow: 4px 0 10px rgba(0, 0, 0, 0.3);
  }

  body.dark-mode .sidebar a {
    color: #f1f1f1;
  }

  body.dark-mode .sidebar a:hover,
  body.dark-mode .sidebar a.active {
    background: rgba(255, 255, 255, 0.1);
  }

  body.dark-mode .dashboard-card {
    background: #2e2e2e;
    color: #eee;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
  }

  body.dark-mode .dashboard-icon {
    color: #ffbaba;
  }

  body.dark-mode .dashboard-title,
  body.dark-mode .dashboard-number {
    color: #fff;
  }

  body.dark-mode #calendar,
  body.dark-mode .fc {
    background: #2e2e2e;
    color: #f1f1f1;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.05);
  }

  body.dark-mode .fc-toolbar h2 {
    color: #ffbaba;
  }

  body.dark-mode .fc-button {
    background-color: #444 !important;
    border: none !important;
    color: #fff !important;
  }

  body.dark-mode .fc-button:hover {
    background-color: #666 !important;
  }

  body.dark-mode .fc-day-header,
  body.dark-mode .fc-day-number {
    color: #ddd !important;
  }

  body.dark-mode .fc-unthemed td,
  body.dark-mode .fc-unthemed th {
    border-color: #444;
  }

  body.dark-mode .fc-today {
    background: rgba(255, 255, 255, 0.05) !important;
  }

  body.dark-mode .fc-event {
    background-color: #ff6b6b !important;
    border-color: #ff6b6b !important;
    color: #fff !important;
  }

  body.dark-mode .fc-content {
    color: #fff !important;
  }

  /* === Layout === */
  body {
  display: flex;
  min-height: 100vh;
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(to right, #ffe5e5, #ffd6d6);
  margin: 0;
  padding: 0;
  position: relative; /* Tambahkan ini */
}


  .sidebar {
    width: 250px;
    background: linear-gradient(to bottom, #ff8c8c, #ffbaba);
    color: white;
    padding: 20px;
    height: 100vh;
    box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
    flex-shrink: 0;
    position: relative;
  }

  .content {
    flex-grow: 1;
    padding: 30px;
  }

  .brand-title {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 30px;
  }

  .brand-title i {
    font-size: 18px;
  }

  .notification-wrapper {
    position: relative;
    margin-bottom: 20px;
  }

  .notification-icon {
    font-size: 20px;
    cursor: pointer;
    position: relative;
  }

  .notification-icon .badge {
    position: absolute;
    top: -5px;
    right: -8px;
    background: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
  }

  
  .notification-icon {
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 999; /* agar muncul di atas elemen lain */
  cursor: pointer;
}

.notification-badge {
  position: absolute;
  top: -5px;
  right: -5px;
  background: red;
  color: white;
  border-radius: 50%;
  padding: 2px 6px;
  font-size: 12px;
}
#notification-dropdown {
  display: none;
  list-style: none;
  padding: 10px;
  background: white;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  position: fixed;
  top: 50px; /* geser ke bawah dari ikon */
  right: 20px;
  width: 250px;
  z-index: 1000;
  color: black;
}


</style>

<div class="sidebar">
  <!-- Brand Title -->
  <div class="brand-title">
    <i class="fas fa-check-circle"></i>
    <span>ToList ✨</span>
  </div>

  <!-- Notification -->

  <!-- Navigation -->
  <a href="{{ route('profile') }}">Profil</a>
  <a href="{{ route('home') }}" class="{{ Request::is('home') ? 'active' : '' }}"><i class="fas fa-home me-2"></i> Home</a>
  <a href="{{ route('board.index') }}" class="{{ Request::is('board*') ? 'active' : '' }}"><i class="fas fa-columns me-2"></i> Board</a>
  <a href="{{ route('calendar.show') }}" class="{{ Request::is('calendar*') ? 'active' : '' }}"><i class="fas fa-calendar-alt me-2"></i> Calendar</a>

  <!-- Settings & Logout -->
  <a href="#" onclick="toggleSettings()" id="settings-link"><i class="fas fa-cog me-2"></i> Settings</a>
  <div id="settings-panel" style="display: none; margin-top: 20px;">
    <div class="form-check form-switch text-white">
      <input class="form-check-input" type="checkbox" role="switch" id="darkModeToggle">
      <label class="form-check-label ms-2" for="darkModeToggle">Dark Mode</label>
    </div>

    <form id="logout-form" method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="button" class="btn btn-outline-light btn-sm w-100" onclick="confirmLogout()">
        <i class="fas fa-sign-out-alt me-2"></i> Logout
      </button>
    </form>
  </div>
</div>
<div class="notification-wrapper">
    <div class="notification-icon" onclick="toggleNotificationDropdown()">
      🔔
      @if(isset($notifications) && $notifications->count() > 0)
        <span class="badge">{{ $notifications->count() }}</span>
      @endif
    </div>
    <ul id="notification-dropdown">
      @if(isset($notifications) && $notifications->count() > 0)
        @foreach($notifications as $task)
          @php
            $daysLeft = \Carbon\Carbon::parse($task->end_date)->diffInDays(\Carbon\Carbon::today(), false);
            $isUrgent = $daysLeft <= 1;
          @endphp
          <li style="margin-bottom: 8px; font-size: 14px;">
            📌 <strong><a href="{{ route('tasks.edit', ['boardId' => $task->list->board->id, 'listId' => $task->list->id, 'id' => $task->id]) }}">{{ $task->name }}</a></strong><br>
            <small style="color: {{ $isUrgent ? 'red' : '#555' }}">
              {{ $isUrgent ? '⚠️ ' : '' }}Deadline: {{ \Carbon\Carbon::parse($task->end_date)->format('d M Y') }}
            </small>
          </li>
        @endforeach
      @else
        <li>Tidak ada notifikasi</li>
      @endif
    </ul>
  </div>


<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Sidebar Scripts -->
<script>
  function toggleSettings() {
    const panel = document.getElementById('settings-panel');
    panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
  }

  function toggleNotificationDropdown() {
    const dropdown = document.getElementById('notification-dropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
  }

  function confirmLogout() {
    Swal.fire({
      title: 'Yakin ingin logout?',
      text: "Kamu akan keluar dari akun ini.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Logout!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('logout-form').submit();
      }
    });
  }

  // Dark mode toggle
  const toggle = document.getElementById('darkModeToggle');
  const currentMode = localStorage.getItem('mode');
  if (currentMode === 'dark') {
    document.body.classList.add('dark-mode');
    toggle.checked = true;
  }

  toggle.addEventListener('change', () => {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('mode', document.body.classList.contains('dark-mode') ? 'dark' : 'light');
  });
</script>
