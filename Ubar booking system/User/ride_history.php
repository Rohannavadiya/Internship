<?php
session_start();
include("../config/db.php");
$user_name = $_SESSION['user_name'];

/* ✅ Uncomment after login system ready
if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}
*/

$tmp_id = $_SESSION['user_id']; // demo

// Fetch user bookings
$sql = "SELECT b.pickup_location,b.drop_location,b.distance_km,b.fare,b.status,b.booking_time FROM bookings b,users u WHERE b.user_id=u.id and u.id=$tmp_id";
$result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ride History | CabRide</title>
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


        .container {
            max-width: 1150px;
            margin: auto;
            padding: 30px 18px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .header h2 {
            font-size: 24px;
        }

        .header a {
            text-decoration: none;
            background: #facc15;
            color: #000;
            padding: 10px 18px;
            border-radius: 12px;
            font-weight: 600;
        }

        .card {
            background: #fff;
            padding: 18px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
            overflow: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        th,
        td {
            padding: 12px 10px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: #f9fafb;
            color: #6b7280;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            border-bottom: 1px solid #f1f5f9;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
        }

        .requested {
            background: #fff7ed;
            color: #c2410c;
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

        .no-data {
            text-align: center;
            padding: 25px;
            color: #6b7280;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="brand">CabRide</div>

            <div class="profile-box">
                <h3>Hello, <?= htmlspecialchars($user_name); ?> 👋</h3>
                <p>User Dashboard</p>
            </div>

            <div class="menu">
                <a href="dashboard.php">🏠 Dashboard</a>
                <a href="book_ride.php">🚖 Book Ride</a>
                <a href="track_ride.php">📍 Track Ride</a>
                <a class="active" href="ride_history.php">📜 Ride History</a>
                <a href="profile.php">👤 Profile</a>
                <a href="../auth/logout.php">🚪 Logout</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main">

            <!-- Topbar -->
            <div class="topbar">
                <h2>Welcome Back, <span><?= htmlspecialchars($user_name); ?></span></h2>
                <div>
                    <small style="color:#6b7280;">CabRide • User Panel</small>
                </div>
            </div>

            <div class="header">
                <h2>📜 Ride History</h2>
                <!-- <a href="dashboard.php">⬅ Back</a> -->
            </div>

            <div class="card">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pickup</th>
                            <th>Drop</th>
                            <th>Distance</th>
                            <th>Fare</th>
                            <th>Status</th>
                            <th>Booking Time</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $status = $row['status'];

                                echo "<tr>";
                                echo "<td>" . $i++ . "</td>";
                                echo "<td>" . htmlspecialchars($row['pickup_location']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['drop_location']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['distance_km']) . " km</td>";
                                echo "<td>₹" . htmlspecialchars($row['fare']) . "</td>";
                                echo "<td><span class='badge " . $status . "'>" . ucfirst($status) . "</span></td>";
                                echo "<td>" . htmlspecialchars($row['booking_time']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='no-data'>❌ No rides found! Book your first ride 🚖</td></tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>

        </div>


    </div>
    </div>


</body>

</html>