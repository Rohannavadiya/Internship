<?php
session_start();
require_once('../config/db.php');

if (!isset($_SESSION['user_id'])) { ?>
    <script>
        alert("Login required!");
        window.location.href = "../auth/login.php";
    </script>
<?php }

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Dashboard | CabRide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f9fafb;
            color: #111827;
        }

        /* Layout */
        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 25px 20px;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .brand {
            font-size: 22px;
            font-weight: 700;
            color: #facc15;
            margin-bottom: 25px;
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

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            text-decoration: none;
            color: #374151;
            font-weight: 500;
            margin-bottom: 10px;
            transition: 0.25s;
        }

        .menu a:hover {
            background: #facc15;
            color: #000;
        }

        .menu a.active {
            background: #facc15;
            color: #000;
        }

        /* Main */
        .main {
            flex: 1;
            padding: 30px;
        }

        /* Top bar */
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
            margin-bottom: 25px;
        }

        .card {
            background: #fff;
            border-radius: 18px;
            padding: 22px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
            transition: 0.25s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            font-size: 16px;
            margin-bottom: 6px;
        }

        .card p {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .card .value {
            font-size: 26px;
            font-weight: 700;
            color: #111827;
        }

        .card small {
            color: #10b981;
            font-weight: 600;
        }

        /* Actions */
        .actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 18px;
        }

        .action-card {
            background: linear-gradient(135deg, #fde047, #facc15);
            border-radius: 20px;
            padding: 22px;
            color: #000;
            position: relative;
            overflow: hidden;
        }

        .action-card h3 {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .action-card p {
            font-size: 13px;
            opacity: 0.9;
            margin-bottom: 14px;
        }

        .action-card a {
            display: inline-block;
            text-decoration: none;
            background: #000;
            color: #facc15;
            padding: 10px 18px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 14px;
        }

        .action-card::after {
            content: "";
            width: 120px;
            height: 120px;
            background: rgba(0, 0, 0, 0.1);
            position: absolute;
            right: -30px;
            top: -30px;
            border-radius: 50%;
        }

        /* Recent ride section */
        .section {
            background: #fff;
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
            margin-top: 25px;
        }

        .section h3 {
            margin-bottom: 12px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px 10px;
            text-align: left;
            font-size: 14px;
        }

        .table th {
            color: #6b7280;
            font-weight: 600;
            border-bottom: 1px solid #e5e7eb;
        }

        .table td {
            border-bottom: 1px solid #f1f5f9;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .requested {
            background: #fff7ed;
            color: #c2410c;
        }

        .pending {
            background: #fff7ed;
            color: #c2410c;
        }

        .accepted {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .completed {
            background: #ecfdf5;
            color: #047857;
        }

        .ongoing {
            background: #eff6ff;
            color: #1d4ed8;
        }

        /* Responsive */
        @media(max-width:900px) {
            .sidebar {
                display: none;
            }

            .main {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

    <div class="wrapper">

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="brand">CabRide</div>

            <div class="profile-box">
                <h3>Hello, <?= $user_name; ?> 👋</h3>
                <p>User Dashboard</p>
            </div>

            <div class="menu">
                <a class="active" href="dashboard.php">🏠 Dashboard</a>
                <a href="book_ride.php">🚖 Book Ride</a>
                <a href="track_ride.php">📍 Track Ride</a>
                <a href="ride_history.php">📜 Ride History</a>
                <a href="profile.php">👤 Profile</a>
                <a href="logout.php">🚪 Logout</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main">

            <!-- Topbar -->
            <div class="topbar">
                <h2>Welcome Back, <span><?= $user_name; ?></span></h2>
                <div>
                    <small style="color:#6b7280;">CabRide • User Panel</small>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid">
                <div class="card">
                    <h3>Total Rides</h3>
                    <p>All rides you booked</p>
                    <div class="value">
                        <?php
                        $sql = "select count(*) as Total_Rides from users u,bookings b where u.id=b.user_id and u.id=$user_id";
                        $result = mysqli_query($link, $sql) or die(mysqli_errno($link));
                        $row = mysqli_fetch_assoc($result);
                        extract($row);
                        echo $Total_Rides;

                        $sql = "
                                SELECT COUNT(*) AS week_total 
                                FROM bookings 
                                WHERE user_id = $user_id 
                                AND YEARWEEK(booking_time,1) = YEARWEEK(CURDATE(),1)
                                ";
                        $result = mysqli_query($link, $sql) or die(mysqli_errno($link));
                        $row = mysqli_fetch_assoc($result);
                        extract($row);
                        ?>
                    </div>
                    <small>+<?= $week_total; ?> this week</small>
                </div>

                <div class="card">
                    <h3>Completed</h3>
                    <p>Successfully finished</p>
                    <div class="value">
                        <?php
                        $sql = "select count(*) as Total_Rides from users u,bookings b where u.id=b.user_id and b.status='completed' and u.id=$user_id";
                        $result = mysqli_query($link, $sql) or die(mysqli_errno($link));
                        $row = mysqli_fetch_assoc($result);
                        extract($row);
                        echo $Total_Rides;
                        ?>
                    </div>
                    <?php if ($Total_Rides == 0) { ?>
                        <small>Book a ride ✅</small>
                    <?php } else {
                    ?>
                        <small>Great job ✅</small>
                    <?php } ?>
                </div>

                <div class="card">
                    <h3>Pending</h3>
                    <p>Waiting for driver</p>
                    <div class="value">
                        <?php
                        $sql = "select count(*) as Total_Rides from users u,bookings b where u.id=b.user_id and b.status='requested' and u.id=$user_id";
                        $result = mysqli_query($link, $sql) or die(mysqli_errno($link));
                        $row = mysqli_fetch_assoc($result);
                        extract($row);
                        echo $Total_Rides;
                        ?>
                    </div>
                    <small>Be ready 🚕</small>
                </div>

                <div class="card">
                    <h3>Ongoing</h3>
                    <p>Currently running ride</p>
                    <div class="value">
                        <?php
                        $sql = "select count(*) as Total_Rides from users u,bookings b where u.id=b.user_id and b.status='ongoing' and u.id=$user_id";
                        $result = mysqli_query($link, $sql) or die(mysqli_errno($link));
                        $row = mysqli_fetch_assoc($result);
                        extract($row);
                        echo $Total_Rides;
                        ?>
                    </div>
                    <small>Tracking live 📍</small>
                </div>
            </div>

            <!-- Action Cards -->
            <div class="actions">
                <div class="action-card">
                    <h3>Book a New Ride 🚖</h3>
                    <p>Choose pickup & destination and get instant driver confirmation.</p>
                    <a href="book_ride.php">Book Ride</a>
                </div>

                <div class="action-card">
                    <h3>Track Your Ride 📍</h3>
                    <p>Check driver status, ride status and location updates anytime.</p>
                    <a href="track_ride.php">Track Ride</a>
                </div>
            </div>

            <!-- Recent Rides -->
            <div class="section">
                <h3>Recent Rides</h3>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Pickup</th>
                            <th>Drop</th>
                            <th>Status</th>
                            <th>Fare</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select booking_time,pickup_location,drop_location,status,fare from bookings where user_id=$user_id limit 5";
                        $result = mysqli_query($link, $sql) or die(mysqli_errno($link));
                        while ($row = mysqli_fetch_assoc($result)) {
                            extract($row);
                        ?>
                            <tr>
                                <td><?= date("d-m-Y", strtotime($booking_time)); ?></td>
                                <td><?= $pickup_location; ?></td>
                                <td><?= $drop_location; ?></td>
                                <td><span class="badge <?= $status; ?>"><?= $status; ?></span></td>
                                <td><?= $fare; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>

</html>