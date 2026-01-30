<?php
session_start();
include("../config/db.php");

/* after admin login
if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}
*/

// ====== COUNTS ======
$total_users = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) c FROM users"))['c'];
$total_drivers = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) c FROM drivers"))['c'];
$active_drivers = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) c FROM drivers WHERE status='approved'"))['c'];
$total_rides = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) c FROM bookings"))['c'];
$completed_rides = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) c FROM bookings WHERE status='completed'"))['c'];

// ====== TODAY EARNINGS ======
$today = date("Y-m-d");
$pay = mysqli_fetch_assoc(mysqli_query($link, "
    SELECT IFNULL(SUM(amount),0) total
    FROM payments
    WHERE DATE(payment_time)='$today'
    AND payment_status='paid'
"));

$total_amount = $pay['total'];
$driver_amount = $total_amount * 0.70;
$platform_amount = $total_amount * 0.30;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | CabRide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif
        }

        body {
            background: #f9fafb;
            color: #111827
        }

        .wrapper {
            display: flex;
            min-height: 100vh
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
            padding: 25px;
        }

        .brand {
            font-size: 22px;
            font-weight: 800;
            color: #facc15;
            margin-bottom: 25px;
        }

        .menu a {
            display: block;
            padding: 12px 16px;
            border-radius: 14px;
            margin-bottom: 10px;
            text-decoration: none;
            color: #374151;
            font-weight: 600;
        }

        .menu a:hover,
        .menu a.active {
            background: #facc15;
            color: #000;
        }

        /* Main */
        .main {
            flex: 1;
            padding: 30px
        }

        /* Topbar */
        .topbar {
            background: #fff;
            padding: 18px 22px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
            margin-bottom: 25px;
        }

        .topbar h2 span {
            color: #facc15
        }

        /* Cards */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
        }

        .card {
            background: #fff;
            padding: 22px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
            border: 1px solid #f1f5f9;
        }

        .card h3 {
            font-size: 15px;
            color: #6b7280;
            margin-bottom: 8px
        }

        .card .value {
            font-size: 28px;
            font-weight: 800
        }

        /* Earnings */
        .earnings {
            margin-top: 25px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 18px;
        }

        .money {
            font-size: 24px;
            font-weight: 900
        }

        .green {
            color: #047857
        }

        .blue {
            color: #1d4ed8
        }

        .orange {
            color: #c2410c
        }

        @media(max-width:900px) {
            .sidebar {
                display: none
            }

            .main {
                padding: 18px
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="brand">CabRide Admin</div>
            <div class="menu">
                <a class="active" href="dashboard.php">📊 Dashboard</a>
                <a href="users.php">👤 Users</a>
                <a href="drivers.php">🚖 Drivers</a>
                <a href="rides.php">📍 Rides</a>
                <a href="payments.php">💰 Payments</a>
                <a href="ratings.php">⭐ Ratings</a>
                <a href="logout.php">🚪 Logout</a>
            </div>
        </div>

        <!-- Main -->
        <div class="main">

            <div class="topbar">
                <h2>Welcome, <span>Admin</span></h2>
            </div>

            <div class="grid">
                <div class="card">
                    <h3>Total Users</h3>
                    <div class="value"><?= $total_users ?></div>
                </div>
                <div class="card">
                    <h3>Total Drivers</h3>
                    <div class="value"><?= $total_drivers ?></div>
                </div>
                <div class="card">
                    <h3>Active Drivers</h3>
                    <div class="value"><?= $active_drivers ?></div>
                </div>
                <div class="card">
                    <h3>Total Rides</h3>
                    <div class="value"><?= $total_rides ?></div>
                </div>
                <div class="card">
                    <h3>Completed Rides</h3>
                    <div class="value"><?= $completed_rides ?></div>
                </div>
            </div>

            <div class="earnings">
                <div class="card">
                    <h3>Today's Total Earnings</h3>
                    <div class="money green">₹<?= number_format($total_amount, 2) ?></div>
                </div>
                <div class="card">
                    <h3>Driver Share (70%)</h3>
                    <div class="money blue">₹<?= number_format($driver_amount, 2) ?></div>
                </div>
                <div class="card">
                    <h3>Platform Share (30%)</h3>
                    <div class="money orange">₹<?= number_format($platform_amount, 2) ?></div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>