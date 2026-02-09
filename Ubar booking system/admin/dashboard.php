<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['admin_id'])) { ?>
    <script>
        alert("Login required!");
        window.location.href = "../auth/login.php";
    </script>
<?php }

$admin_name = $_SESSION['admin_name'];
$admin_id = $_SESSION['admin_id'];

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

        .profile-box {
            background: #f9fafb;
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 25px;
            border: 1px solid #f1f5f9;
        }

        .profile-box h3 {
            font-size: 16px;
            margin-bottom: 3px;
        }

        .profile-box p {
            font-size: 13px;
            color: #6b7280;
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
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .topbar h2 {
            font-size: 20px;
        }

        .topbar span {
            color: #facc15;
            font-weight: 700;
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
    transition: all 0.3s ease;   /* 👈 important */
}

.card:hover {
    transform: translateY(-6px); /* 👈 move up */
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.12);
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
            <div class="profile-box">
                <h3>Hello, <?= $admin_name; ?> 👋</h3>
                <p>Admin Dashboard</p>
            </div>
            <div class="menu">
                <a class="active" href="dashboard.php">📊 Dashboard</a>
                <a href="users.php">👤 Users</a>
                <a href="drivers.php">🚖 Drivers</a>
                <a href="admins.php">👑 Admins</a>
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
                <small style="color:#6b7280;">CabRide • Admin Panel</small>
            </div>

            <div class="grid">
                <?php
                $sql = "select count(id) as Total_users from users";
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_assoc($result);
                extract($row);

                $sql = "select count(id) as Total_drivers from drivers";
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_assoc($result);
                extract($row);

                $sql = "select count(id) as Active_drivers from drivers where availability='online'";
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_assoc($result);
                extract($row);

                $sql = "select count(*) as Total_rides from bookings";
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_assoc($result);
                extract($row);

                $sql = "select count(*) as Completed_rides from bookings where status='completed'";
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_assoc($result);
                extract($row);
                ?>
                <div class="card">
                    <h3>Total Users</h3>
                    <div class="value"><?= $Total_users ?></div>
                </div>
                <div class="card">
                    <h3>Total Drivers</h3>
                    <div class="value"><?= $Total_drivers ?></div>
                </div>
                <div class="card">
                    <h3>Active Drivers</h3>
                    <div class="value"><?= $Active_drivers ?></div>
                </div>
                <div class="card">
                    <h3>Total Rides</h3>
                    <div class="value"><?= $Total_rides ?></div>
                </div>
                <div class="card">
                    <h3>Completed Rides</h3>
                    <div class="value"><?= $Completed_rides ?></div>
                </div>
            </div>

            <div class="earnings">
                <?php

                $today = date("Y-m-d");
                $sql = "select sum(platform_amount) as Today_earnings from payments where date(payment_time)='$today' and payment_status='paid'";
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_assoc($result);
                extract($row);

                $sql = "select sum(driver_amount) as driver_amount,sum(platform_amount) as platform_amount from payments";
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_assoc($result);
                extract($row);
                ?>
                <div class="card">
                    <h3>Today's Total Earnings</h3>
                    <div class="money green">₹<?= number_format($Today_earnings, 2) ?></div>
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