<?php
session_start();
include("../config/db.php");
extract($_REQUEST);

if (!isset($_SESSION['admin_id'])) { ?>
    <script>
        alert("Login required!");
        window.location.href = "../auth/login.php";
    </script>
<?php }

$admin_name = $_SESSION['admin_name'];
$admin_id = $_SESSION['admin_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Users | Admin Panel</title>
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

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
            padding: 25px;
        }

        .brand {
            font-size: 22px;
            font-weight: 800;
            color: #facc15;
            margin-bottom: 25px
        }

        .menu a {
            display: block;
            padding: 12px 16px;
            border-radius: 14px;
            margin-bottom: 10px;
            text-decoration: none;
            color: #374151;
            font-weight: 600;
        }

        .menu a.active,
        .menu a:hover {
            background: #facc15;
            color: #000;
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
            background: #fff;
            padding: 22px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
            max-width: 700px
        }

        .form-group {
            margin-bottom: 14px
        }

        label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            display: block
        }

        input,
        select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            font-size: 14px
        }

        input[readonly] {
            background: #f3f4f6
        }

        input:focus,
        select:focus {
            border-color: #facc15;
            box-shadow: 0 0 0 3px rgba(250, 204, 21, .25);
            outline: none
        }

        .btn {
            padding: 12px 18px;
            border-radius: 14px;
            background: #000;
            color: #facc15;
            border: none;
            font-weight: 800;
            cursor: pointer
        }

        .btn-outline {
            display: inline-block;
            margin-left: 10px;
            padding: 12px 18px;
            border-radius: 14px;
            border: 2px solid #facc15;
            text-decoration: none;
            color: #000;
            font-weight: 800
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
                <a class="active" href="drivers.php">🚖 Drivers</a>
                <a href="admins.php">👑 Admins</a>
                <a href="rides.php">📍 Rides</a>
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

            <div class="card">
                <h3>🚖 Add Driver</h3>
                <br>

                <form method="POST" action="submit/insert_drivers.php">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="mail" name="email" required>
                    </div>

                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" name="mobile" required>
                    </div>

                    <div class="form-group">
                        <label>License Number</label>
                        <input type="text" name="license_number" required>
                    </div>

                    <div class="form-group">
                        <label>Vehicle Type</label>
                        <select name="vehicle_type">
                            <option value="Mini">Mini</option>
                            <option value="Sedan">Sedan</option>
                            <option value="SUV">SUV</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Availability</label>
                        <select name="availability">
                            <option value="online">Online</option>
                            <option value="offline">Offline</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status">
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="blocked">Blocked</option>
                        </select>
                    </div>
                    <button type="submit" name="update_driver" class="btn">
                        ✅ Insert Driver
                    </button>
                    <a href="drivers.php" class="btn-outline">⬅ Back</a>
                </form>
            </div>

        </div>
    </div>
</body>

</html>