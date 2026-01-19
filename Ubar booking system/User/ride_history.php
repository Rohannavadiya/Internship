<?php
session_start();
include("../config/db.php");

/* ✅ Uncomment after login system ready
if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}
*/

$user_id = $_SESSION['user_id'] ?? 1; // demo

// Fetch user bookings
$sql = "SELECT * FROM bookings WHERE user_id='$user_id' ORDER BY id DESC";
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

    <div class="container">

        <div class="header">
            <h2>📜 Ride History</h2>
            <a href="dashboard.php">⬅ Back</a>
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

</body>

</html>