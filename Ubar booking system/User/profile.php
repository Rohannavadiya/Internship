<?php
session_start();
include("../config/db.php");

/* ✅ Enable after login
if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}
*/

$tmp_id = $_SESSION['user_id']; // demo
$user_name = $_SESSION['user_name'] ?? "User";

/* ✅ Fetch User Data */
$sql = "SELECT * FROM users WHERE id='$tmp_id' LIMIT 1";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    extract($row);
} else {
    die("User not found!");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Profile | CabRide</title>
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

        /* Profile Card */
        .card {
            max-width: 900px;
            background: #fff;
            padding: 22px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
        }

        .avatar-box {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 18px;
        }

        .avatar {
            width: 72px;
            height: 72px;
            border-radius: 18px;
            background: linear-gradient(135deg, #fde047, #facc15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            font-weight: 900;
            color: #000;
        }

        .avatar img {
            /* width: 100px; */
            height: 85px;
            border-radius: 20px;
            background: linear-gradient(135deg, #fde047, #facc15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            font-weight: 900;
            color: #000;
            margin: 0 auto 12px;
            overflow: hidden;
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
                <h3>Hello, <?= htmlspecialchars($user_name); ?> 👋</h3>
                <p>User Dashboard</p>
            </div>

            <div class="menu">
                <a href="dashboard.php">🏠 Dashboard</a>
                <a href="book_ride.php">🚖 Book Ride</a>
                <a href="track_ride.php">📍 Track Ride</a>
                <a href="ride_history.php">📜 Ride History</a>
                <a class="active" href="profile.php">👤 Profile</a>
                <a href="../auth/logout.php">🚪 Logout</a>
            </div>
        </div>

        <!-- Main -->
        <div class="main">

            <!-- Topbar -->
            <div class="topbar">
                <h2>My <span>Profile</span></h2>
                <small style="color:#6b7280;">CabRide • User Panel</small>
            </div>

            <!-- ✅ Success message after update -->
            <?php if (isset($_GET['updated'])) { ?>
                <div class="alert success">✅ Profile Updated Successfully!</div>
            <?php } ?>

            <!-- Profile Detail Card -->
            <div class="card">
                <br>
                <div class="avatar-box">
                    <div class="avatar">
                        <img src="../assets/images/<?= $img; ?>" alt="Profile">
                    </div>

                    <div class="user-info">
                        <h3><?= $full_name; ?></h3>
                        <p>Active User • CabRide</p>
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
                        <small>Status</small>
                        <span style="color:#047857;"><?= $status; ?> ✅</span>
                    </div>

                    <div class="info-box">
                        <small>Joined On</small>
                        <span><?= date("d M Y", strtotime($created_at)); ?></span>
                    </div>
                </div>

                <!-- ✅ Update Profile Button -->
                <a href="update_profile.php" class="btn">✏️ Update Details</a>

            </div>

        </div>
    </div>

</body>

</html>