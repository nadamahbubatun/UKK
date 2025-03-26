<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
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
        }
        .sidebar a:hover {
            background-color:rgb(193, 125, 125);
            border-radius: 5px;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
            width: 100%;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4>ToList</h4>
        <a href=""><i class="fas fa-home"></i> Home</a>
        <a href="{{ route('board.index') }}" class="active"><i class="fas fa-box"></i> Board</a>

        <a href="#"><i class="fas fa-file-archive"></i> Calendar</a>
    </div>
    <div class="content">
        <span style="color: #B85C5C; font-weight: bold; font-size: 24px;">Welcome!</span>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p style="color: #B85C5C">Selamat Datang Di ToList</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-xl-3">
                    <div class="card" style="background-color: #B85C5C;">
                        <div class="card-body p-3" style="height: 170px">
                            <h5 class="card-title" style="color: white">Total Board</h5>
                            <br>
                            <div class="icon w-100 h-25 d-flex justify-content-end align-items-end">
                                <i class='fas fa-server menu-icon' style="color:#fafafa; font-size:50px; opacity: 0.7;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-xl-3">
                    <div class="card" style="background-color: #B85C5C;">
                        <div class="card-body p-3" style="height: 170px">
                            <h5 class="card-title" style="color: white">Total List</h5>
                            <div class="icon w-100 h-25 d-flex justify-content-end align-items-end">
                                <i class='far fa-envelope-open menu-icon' style="color:#fafafa; font-size:50px; opacity: 0.7;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-xl-3">
                    <div class="card" style="background-color: #B85C5C;">
                        <div class="card-body p-3" style="height: 170px">
                            <h5 class="card-title" style="color: white">Total Task</h5>
                            <div class="icon w-100 h-25 d-flex justify-content-end align-items-end">
                                <i class='fas fa-users menu-icon' style="color:#fafafa; font-size:50px; opacity: 0.7;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
           
            </div>
        </div>
    </div>
</body>
</html>
