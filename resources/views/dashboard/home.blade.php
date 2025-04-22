<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/app.css">

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
      margin-bottom: 30px;
    }

    .dashboard-card {
      background: white;
      border-radius: 20px;
      padding: 25px;
      box-shadow: 0 10px 30px rgba(255, 137, 137, 0.2);
      transition: all 0.3s ease-in-out;
      cursor: pointer;
    }

    .dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(255, 137, 137, 0.3);
    }

    .dashboard-icon {
      font-size: 40px;
      color: #ff6b6b;
      margin-bottom: 15px;
    }

    .dashboard-title {
      font-weight: 600;
      font-size: 18px;
      color: #333;
    }

    .dashboard-number {
      font-size: 32px;
      font-weight: 700;
      color: #111;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .content {
        margin-left: 0;
        padding: 20px;
      }
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

  @include('layouts.sidebar')

  <div class="content">
    <h2>Welcome back! 🚀</h2>

    

    <div class="row g-4">
      <div class="col-md-6 col-lg-4">
        <div class="dashboard-card text-center">
          <div class="dashboard-icon"><i class="fas fa-box-open"></i></div>
          <div class="dashboard-title">Total Board</div>
          <div class="dashboard-number">{{ $totalBoards }}</div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="dashboard-card text-center">
          <div class="dashboard-icon"><i class="fas fa-stream"></i></div>
          <div class="dashboard-title">Total List</div>
          <div class="dashboard-number">{{ $totalLists }}</div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="dashboard-card text-center">
          <div class="dashboard-icon"><i class="fas fa-tasks"></i></div>
          <div class="dashboard-title">Total Task</div>
          <div class="dashboard-number">{{ $totalTasks }}</div>
        </div>
      </div>
    </div>
    <div class="mt-7" style="max-width: 900px;">
  <h4 class="mb-4">Activity Overview</h4>
  <canvas id="dashboardChart" height="250"></canvas>
</div>

  </div>

</body>
<script>
  const ctx = document.getElementById('dashboardChart').getContext('2d');

  const totalBoards = {{ $totalBoards }};
  const totalLists = {{ $totalLists }};
  const totalTasks = {{ $totalTasks }};

  const dashboardChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Boards', 'Lists', 'Tasks'],
      datasets: [{
        label: 'Jumlah Total',
        data: [totalBoards, totalLists, totalTasks],
        fill: true,
        backgroundColor: 'rgba(255, 140, 140, 0.2)',
        borderColor: 'rgba(255, 112, 112, 1)',
        tension: 0.3,
        pointBackgroundColor: '#ff7070',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#ff7070'
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          labels: {
            color: '#ff8c8c',
            font: {
              weight: 'bold'
            }
          }
        },
        tooltip: {
          backgroundColor: '#fff0f0',
          titleColor: '#ff6b6b',
          bodyColor: '#ff7070',
          borderColor: '#ffe0e0',
          borderWidth: 1
        }
      },
      scales: {
        x: {
          ticks: {
            color: '#ff8c8c',
            font: {
              weight: 'bold'
            }
          },
          grid: {
            color: '#fff0f0'
          }
        },
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1,
            color: '#ff8c8c',
            font: {
              weight: 'bold'
            }
          },
          grid: {
            color: '#ffe5e5'
          }
        }
      }
    }
  });
</script>





</html>
