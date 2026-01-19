<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'user') {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book Ride | CabRide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f9fafb;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            height: 100vh;
            position: fixed;
            background: #fff;
            border-right: 1px solid #e5e7eb;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
            color: #facc15;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px;
            border-radius: 8px;
            color: #374151;
            text-decoration: none;
            margin-bottom: 10px;
        }

        .sidebar a i {
            margin-right: 10px;
            color: #facc15;
        }

        .sidebar a:hover {
            background: #facc15;
            color: #000;
        }

        /* Main */
        .main {
            margin-left: 220px;
            padding: 25px;
        }

        /* Header */
        .header {
            background: #fff;
            padding: 15px 20px;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        /* Card */
        .card {
            margin-top: 25px;
            max-width: 520px;
            background: #fff;
            padding: 25px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        /* Form */
        label {
            font-size: 14px;
            color: #374151;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            margin-bottom: 18px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #facc15;
            box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.3);
        }

        /* Button */
        .btn {
            width: 100%;
            padding: 12px;
            background: #facc15;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn:hover {
            background: #eab308;
        }

        /* Fare box */
        .fare {
            background: #fef9c3;
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            font-weight: 600;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>User</h2>
        <a href="user_dashboard.php"><i class="fa fa-home"></i>Dashboard</a>
        <a href="book_ride.php"><i class="fa fa-car"></i>Book Ride</a>
        <a href="ride_history.php"><i class="fa fa-history"></i>Ride History</a>
        <a href="profile.php"><i class="fa fa-user"></i>Profile</a>
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i>Logout</a>
    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- HEADER -->
        <div class="header">
            <h3>Book Ride</h3>
            <span>Hello, <?php echo $_SESSION['user_name'] ?? 'User'; ?></span>
        </div>

        <!-- BOOK RIDE FORM -->
        <div class="card">
            <h3 style="margin-bottom:15px;">Book a New Ride</h3>

            <form method="POST" action="book_ride_action.php">

                <label>Pickup Location</label>
                <input type="text" name="pickup" placeholder="Enter pickup location" required>

                <label>Drop Location</label>
                <input type="text" name="drop" placeholder="Enter drop location" required>

                <label>Vehicle Type</label>
                <select name="vehicle_type" required>
                    <option value="">-- Select vehicle --</option>
                    <option value="Mini">Mini</option>
                    <option value="Sedan">Sedan</option>
                    <option value="SUV">SUV</option>
                </select>

                <div class="fare">
                    Estimated Fare: ₹450
                </div>

                <button type="submit" class="btn">
                    Confirm Ride
                </button>
            </form>
        </div>

    </div>

</body>

</html>