<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['driver_id'])) { ?>
    <script>
        alert("Login required!");
        window.location.href = "../auth/login.php";
    </script>
<?php }

$driver_id   = $_SESSION['driver_id']; // demo
$driver_name = $_SESSION['driver_name'];

/* ✅ Fetch Driver Data */
$sql = "SELECT * FROM drivers WHERE id='$driver_id' LIMIT 1";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    extract($row);
} else {
    die("Driver not found!");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Driver Profile | CabRide</title>
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

        /* Card */
        .card {
            max-width: 900px;
            background: #fff;
            padding: 22px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
        }

        /* Avatar */
        .avatar-box {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 18px;
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 18px;
            background: linear-gradient(135deg, #fde047, #facc15);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 18px;
            display: block;
        }

        .user-info h3 {
            font-size: 18px;
            margin-bottom: 3px;
        }

        .user-info p {
            font-size: 13px;
            color: #6b7280;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-top: 10px;
        }

        .info-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 14px;
        }

        .info-box small {
            display: block;
            color: #6b7280;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .info-box span {
            font-weight: 800;
            color: #111827;
            font-size: 14px;
        }

        /* Button */
        .btn {
            display: inline-block;
            margin-top: 18px;
            background: #000;
            color: #facc15;
            padding: 10px 18px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 900;
        }

        .btn:hover {
            opacity: 0.9;
        }

        /* Alert */
        .alert {
            max-width: 900px;
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

        @media(max-width:900px) {
            .sidebar {
                display: none;
            }

            .main {
                padding: 18px;
            }

            .info-grid {
                grid-template-columns: 1fr;
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
                <a href="earnings.php">💰 Earnings</a>
                <a class="active" href="profile.php">👤 Profile</a>
                <a href="logout.php">🚪 Logout</a>
            </div>
        </div>

        <!-- Main -->
        <div class="main">

            <div class="topbar">
                <h2>Welcome Back, <span><?= $full_name; ?></span></h2>
                <small style="color:#6b7280;">CabRide • Driver Panel</small>
            </div>

            <?php if (isset($_GET['updated'])) { ?>
                <div class="alert success">✅ Profile Updated Successfully!</div>
            <?php } ?>

            <div class="card">
                <h2>My <span style="color:#facc15;">Profile</span></h2>
                <br>

                <div class="avatar-box">
                    <div class="avatar">
                        <!-- ✅ If driver image in DB later -->
                        <img src="../assets/images/<?= $img; ?>" alt="Profile">
                    </div>

                    <div class="user-info">
                        <h3><?= $full_name; ?></h3>
                        <p>CabRide Driver • <?= $vehicle_type; ?></p>
                    </div>
                </div>

                <div class="info-grid">
                    <div class="info-box">
                        <small>Full Name</small>
                        <span><?= $full_name; ?></span>
                    </div>

                    <div class="info-box">
                        <small>Email</small>
                        <span><?= $email; ?></span>
                    </div>

                    <div class="info-box">
                        <small>Mobile</small>
                        <span><?= $mobile; ?></span>
                    </div>

                    <div class="info-box">
                        <small>License Number</small>
                        <span><?= $license_number; ?></span>
                    </div>

                    <div class="info-box">
                        <small>Vehicle Type</small>
                        <span><?= $vehicle_type; ?></span>
                    </div>

                    <div class="info-box">
                        <small>Availability</small>
                        <span style="color:#1d4ed8;"><?= $availability; ?></span>
                    </div>

                    <div class="info-box">
                        <small>Account Status</small>
                        <span style="color:#047857;"><?= $status; ?></span>
                    </div>

                    <div class="info-box">
                        <small>Joined On</small>
                        <span><?= date("d M Y", strtotime($created_at)); ?></span>
                    </div>
                </div>

                <a href="update_profile.php" class="btn">✏️ Update Details</a>
            </div>

        </div>
    </div>
</body>

</html>