<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>

    {{-- Font Poppins & Bootstrap --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    {{-- FullCalendar --}}
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.css" rel="stylesheet" />
    
    <style>
        * {
            font-family: 'Poppins', sans-serif; /* Menambahkan font Poppins untuk seluruh halaman */
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

        h2 {
            font-weight: 700;
            color: #ff7070;
            margin-bottom: 30px;
        }

        #calendar {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #ff8c8c;
            border: none;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #ff6b6b;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-radius: 10px;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
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
        body.dark {
    background: linear-gradient(135deg, #1a1a1a, #2a2a2a);
}

body.dark .content h2 {
    color: #ffbaba;
}

body.dark #calendar {
    background: #2e2e2e;
    color: #f0f0f0;
    box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.05);
}

body.dark .fc-event {
    background-color: #ff6b6b !important;
    border-color: #ff6b6b !important;
    color: #fff !important;
}

body.dark .fc-day-header,
body.dark .fc-day-number {
    color: #f0f0f0;
}

body.dark .fc-toolbar h2 {
    color: #ffbaba;
}

body.dark .fc-button {
    background-color: #444 !important;
    border: none;
    color: #f0f0f0 !important;
}

body.dark .fc-button:hover {
    background-color: #666 !important;
}

body.dark .fc-unthemed td,
body.dark .fc-unthemed th {
    border-color: #444;
}

    </style>
</head>
<body>
@include('layouts.sidebar')
    {{-- Content --}}
    <div class="content">
        <h2>Calendar</h2>
        <div class="container-fluid">
            <div id="calendar"></div>
        </div>
    </div>

    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#calendar').fullCalendar({
                events: '/calendar/events',
                editable: false,
                eventColor: '#ff8c8c', // pink
                eventClick: function(event) {
                    let message = 'Task: ' + event.title + 
                                  '\nTanggal: ' + event.start.format('YYYY-MM-DD') + 
                                  '\nDeskripsi: ' + (event.description ?? '-');

                    alert(message);
                }
            });
        });
        
    </script>
    
</body>
</html>
