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
$msg = "";

/* ✅ Fetch My Rides (Accepted + Ongoing + Completed) */
$sql = "SELECT b.*, u.full_name AS user_name, u.mobile AS user_mobile
        FROM bookings b
        INNER JOIN users u ON b.user_id = u.id
        WHERE b.driver_id='$driver_id'
        ORDER BY 
          CASE 
            WHEN b.status='ongoing' THEN 1
            WHEN b.status='accepted' THEN 2
            WHEN b.status='completed' THEN 3
            WHEN b.status='cancelled' THEN 4
            ELSE 5
          END,
          b.booking_time DESC";

$result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Rides | CabRide</title>
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

        /* Alerts */
        .alert {
            padding: 12px 14px;
            border-radius: 14px;
            margin-bottom: 15px;
            font-size: 14px;
            font-weight: 800;
        }

        .success {
            background: #ecfdf5;
            color: #047857;
        }

        .error {
            background: #fef2f2;
            color: #b91c1c;
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

        /* Badge */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 800;
            display: inline-block;
        }

        .accepted {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .ongoing {
            background: #fefce8;
            color: #a16207;
        }

        .completed {
            background: #ecfdf5;
            color: #047857;
        }

        .cancelled {
            background: #fef2f2;
            color: #b91c1c;
        }

        /* Buttons */
        .btns {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 14px;
            border-radius: 12px;
            font-weight: 900;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-start {
            background: #000;
            color: #facc15;
        }

        .btn-complete {
            background: #10b981;
            color: #fff;
        }

        .btn:hover {
            opacity: 0.9;
        }

        @media(max-width:900px) {
            .sidebar {
                display: none;
            }

            .main {
                padding: 18px;
            }

            .btns {
                flex-direction: column;
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
                <a class="active" href="my_rides.php">🚖 My Rides</a>
                <a href="earnings.php">💰 Earnings</a>
                <a href="profile.php">👤 Profile</a>
                <a href="logout.php">🚪 Logout</a>
            </div>
        </div>

        <!-- Main -->
        <div class="main">

            <div class="topbar">
                <h2>Welcome Back, <span><?= $driver_name; ?></span></h2>
                <small style="color:#6b7280;">CabRide • Driver Panel</small>
            </div>

            <?= $msg; ?>

            <div class="section">
                <h3>🚖 Ride List</h3>

                <table class="table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Mobile</th>
                            <th>Pickup</th>
                            <th>Drop</th>
                            <th>KM</th>
                            <th>Fare</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0) { ?>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['user_name']); ?></td>
                                    <td><?= htmlspecialchars($row['user_mobile']); ?></td>
                                    <td><?= htmlspecialchars($row['pickup_location']); ?></td>
                                    <td><?= htmlspecialchars($row['drop_location']); ?></td>
                                    <td><?= htmlspecialchars($row['distance_km']); ?></td>
                                    <td>₹<?= htmlspecialchars($row['fare']); ?></td>
                                    <td>
                                        <span class="badge <?= htmlspecialchars($row['status']); ?>">
                                            <?= htmlspecialchars($row['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btns">
                                            <?php if ($row['status'] == "accepted") { ?>
                                                <a class="btn btn-start"
                                                    href="submit/rides_status_update.php?start_id=<?= $row['id']; ?>"
                                                    onclick="return confirm('Start this ride?')">▶ Start</a>
                                            <?php } ?>

                                            <?php if ($row['status'] == "ongoing") { ?>
                                                <a class="btn btn-complete"
                                                    href="submit/rides_status_update.php?complete_id=<?= $row['id']; ?>"
                                                    onclick="return confirm('Complete this ride and take payment?')">🏁 Complete</a>

                                            <?php } ?>

                                            <?php if ($row['status'] == "completed") { ?>
                                                <span style="color:#047857;font-weight:900;">✅ Done</span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="8" style="text-align:center;color:#6b7280;font-weight:700;padding:18px;">
                                    ❌ No rides found yet.
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