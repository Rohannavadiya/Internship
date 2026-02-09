<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id'])) { ?>
    <script>
        alert("Login required!");
        window.location.href = "../auth/login.php";
    </script>
<?php }

$user_id   = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

/* Fetch bookings with saved rating */
$sql = "
SELECT 
    b.id AS booking_id,
    b.pickup_location,
    b.drop_location,
    b.distance_km,
    b.fare,
    b.status,
    b.booking_time,
    b.driver_id,
    IFNULL(r.rating, 0) AS saved_rating
FROM bookings b
LEFT JOIN ratings r ON r.booking_id = b.id
WHERE b.user_id = $user_id
ORDER BY b.booking_time DESC
";
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

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

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
        }

        .menu a {
            display: flex;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            text-decoration: none;
            color: #374151;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .menu a:hover,
        .menu a.active {
            background: #facc15;
            color: #000;
        }

        .main {
            flex: 1;
            padding: 30px;
        }

        .topbar {
            background: #fff;
            padding: 18px 22px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
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
            padding: 12px;
            font-size: 14px;
        }

        th {
            background: #f9fafb;
            color: #6b7280;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .completed {
            background: #ecfdf5;
            color: #047857;
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

        .cancelled {
            background: #fef2f2;
            color: #b91c1c;
        }

        .star-rating {
            display: inline-flex;
            gap: 6px;
            font-size: 22px;
            cursor: pointer;
        }

        .star-rating span {
            color: #d1d5db;
            transition: .2s;
        }

        .star-rating span.filled {
            color: #facc15;
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
                <a href="track_ride.php">📍 Track Ride</a>
                <a class="active" href="ride_history.php">📜 Ride History</a>
                <a href="profile.php">👤 Profile</a>
                <a href="logout.php">🚪 Logout</a>
            </div>
        </div>

        <!-- Main -->
        <div class="main">

            <div class="topbar">
                <h2>Ride <span style="color:#facc15;">History</span></h2>
                <small>CabRide • User Panel</small>
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
                            <th>Time</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                extract($row);
                        ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $pickup_location; ?></td>
                                    <td><?= $drop_location; ?></td>
                                    <td><?= $distance_km; ?> km</td>
                                    <td>₹<?= $fare; ?></td>
                                    <td><span class="badge <?= $status; ?>"><?= $status; ?></span></td>
                                    <td><?= date("d M Y, h:i A", strtotime($booking_time)); ?></td>
                                    <td>
                                        <?php if ($row['status'] == "completed") { ?>
                                            <div class="star-rating"
                                                data-booking="<?= $booking_id; ?>"
                                                data-driver="<?= $driver_id; ?>"
                                                data-rated="<?= $saved_rating; ?>">
                                                <?php for ($s = 1; $s <= 5; $s++) { ?>
                                                    <span data-value="<?= $s; ?>">★</span>
                                                <?php } ?>
                                            </div>
                                        <?php } else {
                                            echo "-";
                                        } ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='8' style='text-align:center;'>No rides found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        document.querySelectorAll(".star-rating").forEach(box => {

            const stars = box.querySelectorAll("span");
            const booking = box.dataset.booking;
            const driver = box.dataset.driver;
            const saved = parseInt(box.dataset.rated);

            // show saved rating
            if (saved > 0) {
                stars.forEach(star => {
                    if (star.dataset.value <= saved) {
                        star.classList.add("filled");
                    }
                });
            }

            stars.forEach(star => {
                star.addEventListener("click", () => {

                    const rating = star.dataset.value;

                    // fill stars
                    stars.forEach(s => {
                        s.classList.toggle("filled", s.dataset.value <= rating);
                    });

                    // save rating (NO submit button)
                    fetch("submit/save_rating.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: `booking_id=${booking}&driver_id=${driver}&rating=${rating}`
                    });
                });
            });
        });
    </script>


</body>

</html>