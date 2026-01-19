<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Driver Dashboard | CabRide</title>
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
        <h2>Driver</h2>
        <a href="#"><i class="fa fa-home"></i>Dashboard</a>
        <a href="ride_requests.php"><i class="fa fa-car"></i>Ride Requests</a>
        <a href="active_ride.php"><i class="fa fa-history"></i>Ride History</a>
        <a href="#"><i class="fa fa-wallet"></i>Earnings</a>
        <a href="#"><i class="fa fa-user"></i>Profile</a>
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i>Logout</a>
    </div>

    <div class="main">
        <div class="header">
            <h3>Driver Dashboard</h3>
            <span>Status: Online</span>
        </div>

        <div class="cards">
            <div class="card"><i class="fa fa-route"></i>
                <h3>Total Rides</h3>
                <p>320</p>
            </div>
            <div class="card"><i class="fa fa-star"></i>
                <h3>Rating</h3>
                <p>4.8</p>
            </div>
            <div class="card"><i class="fa fa-wallet"></i>
                <h3>Earnings</h3>
                <p>₹68,000</p>
            </div>
            <div class="card"><i class="fa fa-signal"></i>
                <h3>Status</h3>
                <p>Available</p>
            </div>
        </div>
    </div>

</body>

</html>