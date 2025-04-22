<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
{{-- Notifikasi Icon --}}
<div style="text-align: right; margin-bottom: 20px; position: relative;" id="notifContainer">
  <button id="notifBtn" class="btn btn-light position-relative">
    <i class="fas fa-bell"></i>
    @if (!empty($notifications))
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
      {{ count($notifications) }}
    </span>
    @endif
  </button>

  {{-- Dropdown notifikasi --}}
  <div id="notifDropdown" style="
    display: none;
    position: absolute;
    right: 0;
    top: 100%;
    width: 300px;
    background: white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-radius: 12px;
    padding: 15px;
    z-index: 99;
  ">
    <h6 class="mb-2">Notifikasi</h6>
    @forelse ($notifications ?? [] as $notif)
      <div class="mb-2 p-2 rounded bg-light">
        {{ $notif }}
      </div>
    @empty
      <div class="text-muted">Tidak ada notifikasi</div>
    @endforelse
  </div>
</div>

{{-- Langsung sisipkan script jika tidak pakai @stack --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const notifBtn = document.getElementById('notifBtn');
    const notifDropdown = document.getElementById('notifDropdown');

    notifBtn.addEventListener('click', function (e) {
      e.stopPropagation(); // supaya klik tombol gak langsung trigger close
      notifDropdown.style.display = notifDropdown.style.display === 'block' ? 'none' : 'block';
    });

    // Tutup dropdown kalau klik di luar
    document.addEventListener('click', function (e) {
      if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
        notifDropdown.style.display = 'none';
      }
    });
  });
</script>
@stack('scripts')

</body>
</html>