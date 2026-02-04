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
$admin_id   = $_SESSION['admin_id'];

/* Fetch ratings */
$sql = "
SELECT 
    r.id,
    r.rating,
    r.created_at,
    u.full_name AS user_name,
    d.full_name AS driver_name,
    b.pickup_location,
    b.drop_location
FROM ratings r
JOIN users u ON u.id = r.user_id
JOIN drivers d ON d.id = r.driver_id
JOIN bookings b ON b.id = r.booking_id
ORDER BY r.created_at DESC
";

$result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ratings | Admin Panel</title>
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
            display: block;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px
        }

        .topbar h2 {
            font-size: 20px
        }

        .topbar span {
            color: #facc15;
            font-weight: 700
        }

        /* Card */
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

        /* Stars */
        .stars {
            color: #facc15;
            font-size: 16px;
            letter-spacing: 1px;
        }

        /* Review */
        .review {
            max-width: 280px;
            font-size: 13px;
            color: #374151;
        }

        /* Empty */
        .no-data {
            text-align: center;
            padding: 30px;
            font-weight: 700;
            color: #6b7280;
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
                <a href="dashboard.php">📊 Dashboard</a>
                <a href="users.php">👤 Users</a>
                <a href="drivers.php">🚖 Drivers</a>
                <a href="admins.php">👑 Admins</a>
                <a href="rides.php">📍 Rides</a>
                <a href="payments.php">💰 Payments</a>
                <a class="active" href="ratings.php">⭐ Ratings</a>
                <a href="logout.php">🚪 Logout</a>
            </div>
        </div>

        <!-- Main -->
        <div class="main">

            <div class="topbar">
                <h2>User <span>Ratings</span></h2>
                <small style="color:#6b7280;">CabRide • Admin Panel</small>
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px;margin-bottom:20px;">
                <?php
                // 🔹 Overall average rating
                $avgSql = "SELECT ROUND(AVG(rating), 2) AS avg_rating, COUNT(*) AS total_ratings FROM ratings";
                $avgResult = mysqli_query($link, $avgSql);
                $avgRow = mysqli_fetch_assoc($avgResult);

                $avg_rating   = $avgRow['avg_rating'] ?? 0;
                $totalRatings = $avgRow['total_ratings'] ?? 0;

                ?>
                <div class="card" style="text-align:center;">
                    <h3 style="margin-bottom:8px;">⭐ Average Rating</h3>
                    <div style="font-size:36px;font-weight:900;color:#facc15;">
                        <?= $avg_rating; ?>
                    </div>
                    <p style="color:#6b7280;font-size:13px;">
                        Based on <?= $totalRatings; ?> rides
                    </p>
                </div>

            </div>

            <div class="card">
                <h2>All <span style="color:#facc15">Ratings</span></h2>

                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Driver</th>
                            <th>Ride</th>
                            <th>Rating</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                extract($row);
                                $stars = str_repeat("★", $rating);
                        ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $user_name; ?></td>
                                    <td><?= $driver_name; ?></td>
                                    <td>
                                        <?= $pickup_location; ?> →
                                        <?= $drop_location; ?>
                                    </td>
                                    <td class="stars"><?= $stars; ?></td>
                                    <td><?= date("d M Y", strtotime($created_at)); ?></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="7" class="no-data">No ratings found ⭐</td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>

</html>