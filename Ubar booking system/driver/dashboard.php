<?php
session_start();
require_once('../config/db.php');

if (!isset($_SESSION['driver_id'])) { ?>
    <script>
        alert("Login required!");
        window.location.href = "../auth/login.php";
    </script>
<?php }

$driver_name = $_SESSION['driver_name'];
$driver_id = $_SESSION['driver_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Driver Dashboard | CabRide</title>
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

        /* Stats Cards */
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
            font-weight: 800;
            color: #111827;
        }

        /* Action Cards */
        .actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .action-card {
            background: linear-gradient(135deg, #fde047, #facc15);
            border-radius: 20px;
            padding: 22px;
            position: relative;
            overflow: hidden;
        }

        .action-card::after {
            content: "";
            width: 120px;
            height: 120px;
            background: rgba(0, 0, 0, 0.12);
            position: absolute;
            right: -30px;
            top: -30px;
            border-radius: 50%;
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
            font-weight: 700;
            font-size: 14px;
        }

        /* Table */
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

        /* Status badge */
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
                <a class="active" href="dashboard.php">🏠 Dashboard</a>
                <a href="ride_requests.php">📥 Ride Requests</a>
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
                <h2>Welcome, <span><?= $driver_name; ?></span></h2>
                <small style="color:#6b7280;">CabRide • Driver Panel</small>
            </div>

            <!-- Stats -->
            <div class="grid">
                <div class="card">
                    <h3>Total Rides</h3>
                    <p>All rides completed or running</p>
                    <div class="value">
                        <?php
                        $sql = "select count(b.driver_id) as Total_Rides from drivers d,bookings b where b.driver_id=d.id and d.id=$driver_id";
                        $result = mysqli_query($link, $sql) or die(mysqli_errno($link));
                        $row = mysqli_fetch_assoc($result);
                        extract($row);
                        echo $Total_Rides;
                        ?>
                    </div>
                </div>

                <div class="card">
                    <h3>Pending Requests</h3>
                    <p>Waiting for your action</p>
                    <div class="value">
                        <?php
                        $sql = "select count(b.driver_id) as Total_Pending_Rides from drivers d,bookings b where b.driver_id=d.id and b.status='pending' and d.id=$driver_id";
                        $result = mysqli_query($link, $sql) or die(mysqli_errno($link));
                        $row = mysqli_fetch_assoc($result);
                        extract($row);
                        echo $Total_Pending_Rides;
                        ?>
                    </div>
                </div>

                <div class="card">
                    <h3>Ongoing Rides</h3>
                    <p>Currently running rides</p>
                    <div class="value">
                        <?php
                        $sql = "select count(b.driver_id) as Total_Ongoing_Rides from drivers d,bookings b where b.driver_id=d.id and b.status='ongoing' and d.id=$driver_id";
                        $result = mysqli_query($link, $sql) or die(mysqli_errno($link));
                        $row = mysqli_fetch_assoc($result);
                        extract($row);
                        echo $Total_Ongoing_Rides;
                        ?>
                    </div>
                </div>

                <div class="card">
                    <h3>Completed</h3>
                    <p>Successfully finished rides</p>
                    <div class="value">
                        <?php
                        $sql = "select count(b.driver_id) as Total_Completed_Rides from drivers d,bookings b where b.driver_id=d.id and b.status='completed' and d.id=$driver_id";
                        $result = mysqli_query($link, $sql) or die(mysqli_errno($link));
                        $row = mysqli_fetch_assoc($result);
                        extract($row);
                        echo $Total_Completed_Rides;
                        ?>
                    </div>
                </div>
                <div class="card">
                    <?php
                    $rating_sql = "
                        SELECT 
                            ROUND(AVG(rating), 1) AS avg_rating,
                            COUNT(*) AS total_ratings
                        FROM ratings
                        WHERE driver_id = $driver_id
                    ";
                    $rating_result = mysqli_query($link, $rating_sql);
                    $rating_row = mysqli_fetch_assoc($rating_result);

                    $avg_rating = $rating_row['avg_rating'] ?? 0;
                    $total_ratings = $rating_row['total_ratings'] ?? 0;
                    ?>
                    <h3>My Rating ⭐</h3>
                    <p>Based on user reviews</p>
                    <div class="value">
                        <?= $avg_rating ? $avg_rating . " / 5" : "No Ratings"; ?>
                    </div>
                    <small style="color:#6b7280;">
                        <?= $total_ratings; ?> reviews
                    </small>
                </div>
            </div>

            <!-- Actions -->
            <div class="actions">
                <?php
                $sql = "select availability from drivers where id=$driver_id";
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_assoc($result);
                extract($row);
                ?>
                <div class="action-card">
                    <?php
                    if ($availability == 'offline') {
                    ?>
                        <h3>Go Online ✅</h3>
                        <p>Start receiving ride requests from users.</p>
                        <a href="submit/online_offline.php?availability=online">Go Online</a>
                    <?php
                    } else if ($availability == 'online') {
                    ?>
                        <h3>Go Offline ✅</h3>
                        <p>End receiving ride requests from users.</p>
                        <a href="submit/online_offline.php?availability=offline">Go Offline</a>
                    <?php
                    }
                    ?>
                </div>

                <div class="action-card">
                    <h3>View Requests 📥</h3>
                    <p>Accept or reject new ride booking requests.</p>
                    <a href="ride_requests.php">Open Requests</a>
                </div>
            </div>

            <!-- Latest Requests Table -->
            <div class="section">
                <h3>📌 Latest Ride Requests</h3>

                <table class="table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Pickup</th>
                            <th>Drop</th>
                            <th>Fare</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select u.full_name,b.pickup_location,b.drop_location,b.fare,b.status from users u,bookings b,drivers d where b.user_id=u.id and b.driver_id=d.id limit 5";
                        $result = mysqli_query($link, $sql) or die(mysqli_errno($link));
                        while ($row = mysqli_fetch_assoc($result)) {
                            extract($row);
                        ?>
                            <tr>
                                <td><?= $full_name; ?></td>
                                <td><?= $pickup_location; ?></td>
                                <td><?= $drop_location; ?></td>
                                <td><?= $fare; ?></td>
                                <td><span class="badge <?= $status; ?>"><?= $status; ?></span></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>

</html>