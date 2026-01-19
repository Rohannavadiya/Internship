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
    <title>Ride History | CabRide</title>
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
            background: #fff;
            padding: 20px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        th {
            background: #facc15;
            color: #000;
        }

        .status-completed {
            color: #16a34a;
            font-weight: 600;
        }

        .status-cancelled {
            color: #dc2626;
            font-weight: 600;
        }

        /* Responsive */
        @media(max-width:768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main {
                margin-left: 0;
            }
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
        <a href="../auth/logout.php"><i class="fa fa-sign-out-alt"></i>Logout</a>
    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- HEADER -->
        <div class="header">
            <h3>Ride History</h3>
            <span>Hello, <?php echo $_SESSION['user_name'] ?? 'User'; ?></span>
        </div>

        <!-- HISTORY CARD -->
        <div class="card">
            <h3>Your Past Rides</h3>

            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Pickup</th>
                        <th>Drop</th>
                        <th>Fare</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>12 Jan 2026</td>
                        <td>City Mall</td>
                        <td>Airport</td>
                        <td>₹450</td>
                        <td class="status-completed">Completed</td>
                    </tr>
                    <tr>
                        <td>08 Jan 2026</td>
                        <td>Railway Station</td>
                        <td>Home</td>
                        <td>₹220</td>
                        <td class="status-completed">Completed</td>
                    </tr>
                    <tr>
                        <td>05 Jan 2026</td>
                        <td>Office</td>
                        <td>Market</td>
                        <td>₹180</td>
                        <td class="status-cancelled">Cancelled</td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>

</body>

</html>