<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ride Requests | Driver</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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

        /* Sidebar */
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

        .sidebar a:hover i {
            color: #000;
        }

        /* Main */
        .main {
            margin-left: 220px;
            padding: 25px;
        }

        /* Header */
        .header {
            background: #fff;
            padding: 15px 20px;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .header h3 {
            color: #111827;
        }

        /* Ride cards */
        .ride-list {
            margin-top: 25px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .ride-card {
            background: #fff;
            padding: 20px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .ride-card h4 {
            color: #111827;
            margin-bottom: 10px;
        }

        .ride-info {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 6px;
        }

        .ride-info i {
            color: #facc15;
            margin-right: 6px;
        }

        /* Actions */
        .actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .btn {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-accept {
            background: #22c55e;
            color: #fff;
        }

        .btn-reject {
            background: #ef4444;
            color: #fff;
        }

        /* Empty state */
        .empty {
            text-align: center;
            margin-top: 60px;
            color: #6b7280;
        }

        .empty i {
            font-size: 40px;
            color: #facc15;
            margin-bottom: 10px;
        }

        /* Responsive */
        @media(max-width:768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Driver</h2>
        <a href="dashboard.php"><i class="fa fa-home"></i>Dashboard</a>
        <a href="ride_requests.php"><i class="fa fa-car"></i>Ride Requests</a>
        <a href="active_ride.php"><i class="fa fa-route"></i>Active Ride</a>
        <a href="ride_history.php"><i class="fa fa-clock"></i>Ride History</a>
        <a href="earnings.php"><i class="fa fa-wallet"></i>Earnings</a>
        <a href="../auth/logout.php"><i class="fa fa-sign-out-alt"></i>Logout</a>
    </div>

    <!-- MAIN -->
    <div class="main">

        <div class="header">
            <h3>Ride Requests</h3>
            <span>Status: <strong style="color:#22c55e;">Online</strong></span>
        </div>

        <!-- RIDE LIST -->
        <div class="ride-list">

            <!-- Ride Card -->
            <div class="ride-card">
                <h4>Pickup → Drop</h4>
                <div class="ride-info"><i class="fa fa-location-dot"></i>Pickup: City Mall</div>
                <div class="ride-info"><i class="fa fa-flag-checkered"></i>Drop: Airport</div>
                <div class="ride-info"><i class="fa fa-road"></i>Distance: 12 km</div>
                <div class="ride-info"><i class="fa fa-rupee-sign"></i>Fare: ₹450</div>

                <div class="actions">
                    <button class="btn btn-accept">Accept</button>
                    <button class="btn btn-reject">Reject</button>
                </div>
            </div>

            <!-- Ride Card -->
            <div class="ride-card">
                <h4>Pickup → Drop</h4>
                <div class="ride-info"><i class="fa fa-location-dot"></i>Pickup: Railway Station</div>
                <div class="ride-info"><i class="fa fa-flag-checkered"></i>Drop: Bus Stand</div>
                <div class="ride-info"><i class="fa fa-road"></i>Distance: 6 km</div>
                <div class="ride-info"><i class="fa fa-rupee-sign"></i>Fare: ₹220</div>

                <div class="actions">
                    <button class="btn btn-accept">Accept</button>
                    <button class="btn btn-reject">Reject</button>
                </div>
            </div>

        </div>

        <!-- EMPTY STATE (use when no requests) -->
        <!--
    <div class="empty">
        <i class="fa fa-car"></i>
        <p>No ride requests available</p>
    </div>
    -->

    </div>

</body>

</html>