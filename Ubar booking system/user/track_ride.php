<?php
session_start();
include("../config/db.php");
$user_name = $_SESSION['user_name'];

if (!isset($_SESSION['user_id'])) { ?>
    <script>
        alert("Login required!");
        window.location.href = "../auth/login.php";
    </script>
<?php }

$user_id = $_SESSION['user_id'];
$sql = "SELECT 
    b.booking_time,
    b.status,
    b.pickup_location,
    b.drop_location,
    b.distance_km,
    b.fare,
    b.driver_id
FROM bookings b
WHERE b.user_id = $user_id
AND b.status NOT IN ('completed', 'cancelled')
ORDER BY b.booking_time;
";

$result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Track Ride | CabRide</title>
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
            max-width: 1100px;
            margin: auto;
            padding: 30px 18px;
        }

        @media(max-width:900px) {
            .nav-links {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                justify-content: flex-end;
            }

            .nav-links a {
                margin-left: 0;
            }
        }

        /* Boxes */
        .box {
            background: #fff;
            padding: 20px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
        }

        .title {
            font-size: 22px;
            margin-bottom: 15px;
        }

        /* Status Badge */
        .badge {
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 13px;
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

        /* Ride Details */
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-top: 15px;
        }

        .info {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 15px;
        }

        .info h4 {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .info p {
            font-size: 15px;
            font-weight: 600;
        }

        /* Steps */
        .steps {
            margin-top: 18px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 12px;
        }

        .step {
            border-radius: 16px;
            padding: 14px;
            background: #fff;
            border: 1px solid #e5e7eb;
        }

        .step span {
            font-size: 13px;
            font-weight: 700;
            color: #6b7280;
            display: block;
            margin-bottom: 6px;
        }

        .step strong {
            font-size: 14px;
        }

        .step.done {
            border: 1px solid #bbf7d0;
            background: #ecfdf5;
        }

        .step.done span {
            color: #047857;
        }

        .step.done strong {
            color: #047857;
        }

        /* No ride */
        .no-ride {
            text-align: center;
            padding: 30px 15px;
            color: #6b7280;
            font-weight: 600;
        }

        .btn {
            display: inline-block;
            margin-top: 12px;
            background: #facc15;
            color: #000;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 14px;
            font-weight: 700;
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
                <a href="dashboard.php">🏠 Dashboard</a>
                <a href="book_ride.php">🚖 Book Ride</a>
                <a class="active" href="track_ride.php">📍 Track Ride</a>
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
            <?php if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    extract($row);
                    $step1 = true; // requested always true
                    $step2 = in_array($status, ['accepted', 'ongoing', 'completed']);
                    $step3 = in_array($status, ['ongoing', 'completed']);
                    $step4 = ($status == 'completed');

            ?>
                    <div class="container">
                        <div class="box">
                            <div class="title">📍 Track Your Ride</div>
                            <p style="margin-bottom:12px;">
                                <b>Status:</b>
                                <span class="badge <?= $status; ?>">
                                    <?= $status; ?>
                                </span>
                            </p>
                            <div class="grid">
                                <div class="info">
                                    <h4>Pickup Location</h4>
                                    <p><?= $pickup_location; ?></p>
                                </div>
                                <div class="info">
                                    <h4>Drop Location</h4>
                                    <p><?= $drop_location; ?></p>
                                </div>
                                <div class="info">
                                    <h4>Distance</h4>
                                    <p><?= $distance_km; ?> km</p>
                                </div>
                                <div class="info">
                                    <h4>Fare</h4>
                                    <p>₹<?= $fare; ?></p>
                                </div>
                            </div>
                            <div class="steps">

                                <div class="step <?= $step1 ? 'done' : '' ?>">
                                    <span><?= $step1 ? '✅ Completed' : '⏳ Pending' ?></span>
                                    <strong>Ride Requested</strong>
                                </div>

                                <div class="step <?= $step2 ? 'done' : '' ?>">
                                    <span><?= $step2 ? '✅ Completed' : '⏳ Pending' ?></span>
                                    <strong>Driver Accepted</strong>
                                </div>

                                <div class="step <?= $step3 ? 'done' : '' ?>">
                                    <span><?= $step3 ? '✅ Completed' : '⏳ Pending' ?></span>
                                    <strong>Ride Ongoing</strong>
                                </div>

                                <div class="step <?= $step4 ? 'done' : '' ?>">
                                    <span><?= $step4 ? '✅ Completed' : '⏳ Pending' ?></span>
                                    <strong>Ride Completed</strong>
                                </div>

                            </div>

                            <div style="margin-top:20px;">
                                <h3 style="margin-bottom:10px;">👨‍✈️ Driver Details</h3>
                                <?php if (!empty($driver_id)) {
                                    $sql = "select full_name,mobile,vehicle_type from drivers where id=$driver_id";
                                    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                    $row = mysqli_fetch_assoc($result);
                                    extract($row);
                                ?>
                                    <div class="grid">
                                        <div class="info">
                                            <h4>Driver Name</h4>
                                            <p><?= $full_name; ?></p>
                                        </div>
                                        <div class="info">
                                            <h4>Driver Mobile</h4>
                                            <p><?= $mobile; ?></p>
                                        </div>
                                        <div class="info">
                                            <h4>Vehicle Type</h4>
                                            <p><?= $vehicle_type; ?></p>
                                        </div>
                                        <div class="info">
                                            <h4>Booking Time</h4>
                                            <p><?= $booking_time; ?></p>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <p style="color:#6b7280;font-weight:600;">
                                        ⏳ Driver not assigned yet. Please wait...
                                    </p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="no-ride">
                    ❌ No ride found to track! <br>
                    Book your first ride now 🚖
                    <br>
                    <a href="book_ride.php" class="btn">Book Ride</a>
                </div>
            <?php } ?>
        </div>
    </div>
    </div>
</body>

</html>