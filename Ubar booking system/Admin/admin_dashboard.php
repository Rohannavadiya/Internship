<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | CabRide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f9fafb;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            position: fixed;
            background: #fff;
            border-right: 1px solid #e5e7eb;
            padding: 20px;
        }

        .sidebar h2 {
            color: #facc15;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px;
            border-radius: 8px;
            color: #374151;
            text-decoration: none;
            margin-bottom: 10px;
        }

        .sidebar a i {
            margin-right: 10px;
            color: #facc15;
        }

        .sidebar a:hover {
            background: #facc15;
            color: #000;
        }

        .main {
            margin-left: 220px;
            padding: 25px;
        }

        .header {
            background: #fff;
            padding: 15px 20px;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .card i {
            font-size: 28px;
            color: #facc15;
        }

        .card p {
            color: #6b7280;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2>Admin</h2>
        <a href="#"><i class="fa fa-home"></i>Dashboard</a>
        <a href="#"><i class="fa fa-users"></i>Users</a>
        <a href="#"><i class="fa fa-id-card"></i>Drivers</a>
        <a href="#"><i class="fa fa-car"></i>Bookings</a>
        <a href="#"><i class="fa fa-wallet"></i>Payments</a>
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i>Logout</a>
    </div>

    <div class="main">
        <div class="header">
            <h3>Admin Dashboard</h3>
            <span>Welcome, Admin</span>
        </div>

        <div class="cards">
            <div class="card"><i class="fa fa-users"></i>
                <h3>Total Users</h3>
                <p>250</p>
            </div>
            <div class="card"><i class="fa fa-id-card"></i>
                <h3>Total Drivers</h3>
                <p>85</p>
            </div>
            <div class="card"><i class="fa fa-car"></i>
                <h3>Total Rides</h3>
                <p>1,240</p>
            </div>
            <div class="card"><i class="fa fa-rupee-sign"></i>
                <h3>Total Revenue</h3>
                <p>₹4,50,000</p>
            </div>
        </div>
    </div>

</body>

</html>