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

// $user_id = $_SESSION['user_id'] ?? 1; // demo user id

// $msg = "";

// if (isset($_POST['book_ride'])) {
//     $pickup_location = mysqli_real_escape_string($link, $_POST['pickup_location']);
//     $drop_location   = mysqli_real_escape_string($link, $_POST['drop_location']);
//     $distance_km     = floatval($_POST['distance_km']);

//     // ✅ simple fare logic (you can change later)
//     $rate_per_km = 12;
//     $fare = $distance_km * $rate_per_km;

//     if ($pickup_location == "" || $drop_location == "" || $distance_km <= 0) {
//         $msg = "<div class='alert error'>❌ Please fill all fields correctly!</div>";
//     } else {
//         $sql = "INSERT INTO bookings (user_id, pickup_location, drop_location, distance_km, fare, status)
//                 VALUES ('$user_id', '$pickup_location', '$drop_location', '$distance_km', '$fare', 'requested')";

//         if (mysqli_query($link, $sql)) {
//             $msg = "<div class='alert success'>✅ Ride Booked Successfully! Driver will accept soon 🚖</div>";
//         } else {
//             $msg = "<div class='alert error'>❌ Error: " . mysqli_error($conn) . "</div>";
//         }
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book Ride | CabRide</title>
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

        /* Page Wrapper */
        .container {
            max-width: 1100px;
            margin: auto;
            padding: 30px 18px;
        }

        /* Header */
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

        /* Booking Box */
        .box {
            background: #fff;
            padding: 22px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .left img {
            width: 100%;
            max-width: 420px;
        }

        .right h3 {
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            outline: none;
            font-size: 14px;
        }

        input:focus {
            border: 1px solid #facc15;
            box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.25);
        }

        button {
            width: 100%;
            padding: 12px;
            background: #000;
            color: #facc15;
            border: none;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.9;
        }

        /* Alert */
        .alert {
            padding: 12px 14px;
            border-radius: 14px;
            margin-bottom: 15px;
            font-size: 14px;
            font-weight: 600;
        }

        .success {
            background: #ecfdf5;
            color: #047857;
        }

        .error {
            background: #fef2f2;
            color: #b91c1c;
        }

        /* Responsive */
        @media(max-width:900px) {
            .box {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .left {
                display: flex;
                justify-content: center;
            }
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

        /* Top bar */
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

        /* Cards */
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
            font-weight: 700;
            color: #111827;
        }

        .card small {
            color: #10b981;
            font-weight: 600;
        }

        /* Actions */
        .actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 18px;
        }

        .action-card {
            background: linear-gradient(135deg, #fde047, #facc15);
            border-radius: 20px;
            padding: 22px;
            color: #000;
            position: relative;
            overflow: hidden;
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
            font-weight: 600;
            font-size: 14px;
        }

        .action-card::after {
            content: "";
            width: 120px;
            height: 120px;
            background: rgba(0, 0, 0, 0.1);
            position: absolute;
            right: -30px;
            top: -30px;
            border-radius: 50%;
        }

        

        
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .pending {
            background: #fff7ed;
            color: #c2410c;
        }

        .completed {
            background: #ecfdf5;
            color: #047857;
        }

        .ongoing {
            background: #eff6ff;
            color: #1d4ed8;
        }

        /* Responsive */
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
                <h3>Hello, <?= htmlspecialchars($user_name); ?> 👋</h3>
                <p>User Dashboard</p>
            </div>

            <div class="menu">
                <a class="active" href="dashboard.php">🏠 Dashboard</a>
                <a href="book_ride.php">🚖 Book Ride</a>
                <a href="track_ride.php">📍 Track Ride</a>
                <a href="ride_history.php">📜 Ride History</a>
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

            <div class="container">

                <div class="header">
                    <h2>🚖 Book Your Ride</h2>
                </div>


                <div class="box">
                    <!-- Left Image -->
                    <div class="left">
                        <!-- ✅ Put your car image path here -->
                        <img src="../assets/images/car.png" alt="Cab Image">
                    </div>

                    <!-- Right Form -->
                    <div class="right">
                        <h3>Enter Ride Details</h3>

                        <form method="POST">
                            <div class="form-group">
                                <label>Pickup Location</label>
                                <input type="text" name="pickup_location" placeholder="Enter pickup point">
                            </div>

                            <div class="form-group">
                                <label>Drop Location</label>
                                <input type="text" name="drop_location" placeholder="Enter destination">
                            </div>

                            <div class="form-group">
                                <label>Distance (KM)</label>
                                <input type="number" step="0.1" name="distance_km" placeholder="Example: 5.5">
                            </div>

                            <button type="submit" name="book_ride">✅ Confirm Booking</button>
                        </form>
                    </div>
                </div>

            </div>


        </div>
    </div>

</body>

</html>