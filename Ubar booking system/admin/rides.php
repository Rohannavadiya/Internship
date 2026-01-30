<?php
session_start();
include("../config/db.php");

/* after admin login
if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}
*/

$admin_name = $_SESSION['admin_name'];
$admin_id   = $_SESSION['admin_id'];

/* Fetch all rides */
$result = mysqli_query($link, "
    SELECT 
        b.id,
        u.full_name AS user_name,
        d.full_name AS driver_name,
        b.pickup_location,
        b.drop_location,
        b.distance_km,
        b.fare,
        b.status,
        b.booking_time
    FROM bookings b
    JOIN users u ON u.id = b.user_id
    LEFT JOIN drivers d ON d.id = b.driver_id
    ORDER BY b.booking_time DESC
");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rides | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* 🔁 SAME CSS AS USERS PAGE (UNCHANGED) */
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

        .sidebar {
            width: 260px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
            padding: 25px
        }

        .brand {
            font-size: 22px;
            font-weight: 800;
            color: #facc15;
            margin-bottom: 25px
        }

        .profile-box {
            background: #f9fafb;
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 25px;
            border: 1px solid #f1f5f9
        }

        .profile-box h3 {
            font-size: 16px;
            margin-bottom: 3px
        }

        .profile-box p {
            font-size: 13px;
            color: #6b7280
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 14px;
            margin-bottom: 10px;
            text-decoration: none;
            color: #374151;
            font-weight: 600
        }

        .menu a:hover,
        .menu a.active {
            background: #facc15;
            color: #000
        }

        .main {
            flex: 1;
            padding: 30px
        }

        .topbar {
            background: #fff;
            padding: 18px 22px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px
        }

        .topbar h2 {
            font-size: 20px
        }

        .topbar span {
            color: #facc15;
            font-weight: 700
        }

        /* CARD */
        .card {
            background: #fff;
            padding: 18px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
            overflow: auto
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1100px
        }

        th,
        td {
            padding: 12px;
            font-size: 14px;
            text-align: left
        }

        th {
            background: #f9fafb;
            color: #6b7280
        }

        tr:not(:last-child) td {
            border-bottom: 1px solid #f1f5f9
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700
        }

        .requested {
            background: #fff7ed;
            color: #c2410c
        }

        .accepted {
            background: #eff6ff;
            color: #1d4ed8
        }

        .ongoing {
            background: #fefce8;
            color: #a16207
        }

        .completed {
            background: #ecfdf5;
            color: #047857
        }

        .cancelled {
            background: #fef2f2;
            color: #b91c1c
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
                <h3>Hello, <?= htmlspecialchars($admin_name); ?> 👋</h3>
                <p>Admin Dashboard</p>
            </div>
            <div class="menu">
                <a href="dashboard.php">📊 Dashboard</a>
                <a href="users.php">👤 Users</a>
                <a href="drivers.php">🚖 Drivers</a>
                <a class="active" href="rides.php">📍 Rides</a>
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

            <!-- 🔴 ONLY THIS CARD CONTENT IS DIFFERENT -->
            <div class="card">
                <h2>Manage <span style="color:#facc15">Rides</span></h2>

                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Driver</th>
                            <th>Pickup</th>
                            <th>Drop</th>
                            <th>Distance</th>
                            <th>Fare</th>
                            <th>Status</th>
                            <th>Booked At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= htmlspecialchars($row['user_name']); ?></td>
                                <td><?= $row['driver_name'] ? htmlspecialchars($row['driver_name']) : "<em>Not Assigned</em>"; ?></td>
                                <td><?= htmlspecialchars($row['pickup_location']); ?></td>
                                <td><?= htmlspecialchars($row['drop_location']); ?></td>
                                <td><?= $row['distance_km']; ?> km</td>
                                <td>₹<?= $row['fare']; ?></td>
                                <td>
                                    <span class="badge <?= $row['status']; ?>">
                                        <?= ucfirst($row['status']); ?>
                                    </span>
                                </td>
                                <td><?= date("d M Y h:i A", strtotime($row['booking_time'])); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>

</html>