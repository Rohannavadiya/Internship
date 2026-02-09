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

$sql = "select status from drivers where id=$driver_id";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
extract($row);

if (isset($_REQUEST['sussess'])) {
    $msg = "<div class='alert success'>" . $_REQUEST['sussess'] . "</div>";
} else if (isset($_REQUEST['error'])) {
    $msg = "<div class='alert error'>" . $_REQUEST['error'] . mysqli_error($link) . "</div>";
}

/* ✅ Fetch Requested Rides */
$sql = "select b.*,u.full_name,u.mobile from bookings b,users u,drivers d where b.user_id=u.id and b.status='requested' and d.availability='online' ORDER BY b.booking_time DESC";

$result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ride Requests | CabRide</title>
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
            font-size: 18px;
            margin-bottom: 14px;
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
            font-weight: 700;
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

        .requested {
            background: #fff7ed;
            color: #c2410c;
        }

        /* Buttons */
        .btns {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 14px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-accept {
            background: #000;
            color: #facc15;
        }

        .btn-reject {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
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
                <a class="active" href="ride_requests.php">📥 Ride Requests</a>
                <a href="my_rides.php">🚖 My Rides</a>
                <a href="earnings.php">💰 Earnings</a>
                <a href="profile.php">👤 Profile</a>
                <a href="logout.php">🚪 Logout</a>
            </div>
        </div>

        <!-- Main -->
        <div class="main">

            <!-- Topbar -->
            <div class="topbar">
                <h2>Welcome Back, <span><?= $driver_name; ?></span></h2>
                <small style="color:#6b7280;">CabRide • Driver Panel</small>
            </div>
            <?= $msg; ?>
            <div class="section">
                <h3>📥 New Booking Requests</h3>

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
                        <?php
                        if ($status == "approved") {
                            if (mysqli_num_rows($result) > 0) { ?>
                                <?php while ($row = mysqli_fetch_assoc($result)) {
                                    extract($row);
                                ?>
                                    <tr>
                                        <td><?= $full_name; ?></td>
                                        <td><?= $mobile; ?></td>
                                        <td><?= $pickup_location; ?></td>
                                        <td><?= $drop_location; ?></td>
                                        <td><?= $distance_km; ?></td>
                                        <td>₹<?= $fare; ?></td>
                                        <td><span class="badge requested"><?= $status; ?></span></td>
                                        <td>
                                            <div class="btns">
                                                <a class="btn btn-accept" href="submit/ride_update.php?accept_id=<?= $id; ?>"
                                                    onclick="return confirm('Accept this ride?')">✅ Accept</a>

                                                <a class="btn btn-reject" href="submit/ride_update.php?reject_id=<?= $id; ?>"
                                                    onclick="return confirm('Reject this ride?')">❌ Reject</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="8" style="text-align:center;color:#6b7280;padding:16px;">
                                        ✅ No new ride requests found.
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            echo "<tr><td>You are not approved!</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>

</html>