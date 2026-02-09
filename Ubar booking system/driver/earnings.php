<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['driver_id'])) { ?>
    <script>
        alert("Login required!");
        window.location.href = "../auth/login.php";
    </script>
<?php }

$driver_id   = $_SESSION['driver_id'];
$driver_name = $_SESSION['driver_name'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Earnings | CabRide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            font-weight: 900;
            color: #111827;
        }

        /* Section */
        .section {
            background: #fff;
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
        }

        .section h3 {
            margin-bottom: 12px;
            font-size: 18px;
        }

        /* Table */
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
            font-weight: 800;
            border-bottom: 1px solid #e5e7eb;
        }

        .table td {
            border-bottom: 1px solid #f1f5f9;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 900;
            display: inline-block;
        }

        .completed {
            background: #ecfdf5;
            color: #047857;
        }

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
                <h3>Hello, <?= $driver_name; ?> 👋</h3>
                <p>Driver Dashboard</p>
            </div>

            <div class="menu">
                <a href="dashboard.php">🏠 Dashboard</a>
                <a href="ride_requests.php">📥 Ride Requests</a>
                <a href="my_rides.php">🚖 My Rides</a>
                <a class="active" href="earnings.php">💰 Earnings</a>
                <a href="profile.php">👤 Profile</a>
                <a href="logout.php">🚪 Logout</a>
            </div>
        </div>

        <!-- Main -->
        <div class="main">

            <div class="topbar">
                <h2>Driver <span>Earnings</span></h2>
                <small style="color:#6b7280;">CabRide • Driver Panel</small>
            </div>

            <!-- Summary Cards -->
            <div class="grid">
                <div class="card">
                    <?php
                    $sql = "select sum(driver_amount) as driver_amount from payments where driver_id=$driver_id";
                    $result = mysqli_query($link, $sql);
                    $row = mysqli_fetch_assoc($result);
                    extract($row);
                    ?>
                    <h3>Total Earnings</h3>
                    <p>All completed rides earnings</p>
                    <div class="value">₹<?= number_format($driver_amount, 2); ?></div>
                </div>

                <div class="card">
                    <?php
                    $sql = "select sum(driver_amount) as today_earnings from payments where date(payment_time)=CURDATE()";
                    $result = mysqli_query($link, $sql);
                    $row = mysqli_fetch_assoc($result);
                    extract($row);
                    ?>
                    <h3>Today Earnings</h3>
                    <p>Completed rides today</p>
                    <div class="value">₹<?= number_format($today_earnings, 2); ?></div>
                </div>

                <div class="card">
                    <?php
                    $sql = "select count(b.driver_id) as Total_Completed_Rides from drivers d,bookings b where b.driver_id=d.id and b.status='completed' and d.id=$driver_id";
                    $result = mysqli_query($link, $sql) or die(mysqli_errno($link));
                    $row = mysqli_fetch_assoc($result);
                    extract($row);
                    ?>
                    <h3>Completed Rides</h3>
                    <p>Total rides completed</p>
                    <div class="value"><?= $Total_Completed_Rides; ?></div>
                </div>
            </div>

            <!-- Earnings Table -->
            <div class="section">
                <h3>📋 Completed Ride Earnings</h3>

                <table class="table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Pickup</th>
                            <th>Drop</th>
                            <th>Fare</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $sql = "select u.full_name,b.pickup_location,b.drop_location,b.fare,b.status,b.booking_time from users u,bookings b,drivers d where b.user_id=u.id and b.driver_id=$driver_id order by b.booking_time desc limit 5";
                        $result = mysqli_query($link, $sql);
                        if (mysqli_num_rows($result) > 0) { ?>
                            <?php while ($row = mysqli_fetch_assoc($result)) { 
                                extract($row);
                                ?>
                                <tr>
                                    <td><?= $full_name; ?></td>
                                    <td><?= $pickup_location; ?></td>
                                    <td><?= $drop_location; ?></td>
                                    <td>₹<?= $fare; ?></td>
                                    <td><span class="badge completed">completed</span></td>
                                    <td><?= date("d M Y, h:i A", strtotime($booking_time)); ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="6" style="text-align:center;color:#6b7280;font-weight:700;padding:18px;">
                                    ❌ No completed rides found.
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>

</html>