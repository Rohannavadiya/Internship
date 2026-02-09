<?php
session_start();
include("../config/db.php");
extract($_REQUEST);


if (!isset($_SESSION['driver_id'])) { ?>
    <script>
        alert("Login required!");
        window.location.href = "../auth/login.php";
    </script>
<?php }

$driver_id   = $_SESSION['driver_id'];
$driver_name = $_SESSION['driver_name'];

$msg = "";
/* ✅ Check booking belongs to driver */
$sql = "select b.user_id,u.full_name,u.mobile,b.pickup_location,b.drop_location,b.distance_km,b.fare from users u,bookings b where u.id=b.user_id and b.driver_id=$driver_id and b.id=$booking_id";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) != 1) {
    die("Ride not found or not allowed!");
}
$row = mysqli_fetch_assoc($result);
extract($row);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment | CabRide</title>
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

        /* Alerts */
        .alert {
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

        .error {
            background: #fef2f2;
            color: #b91c1c;
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

        .card h3 {
            font-size: 20px;
            margin-bottom: 10px;
            font-weight: 900;
        }

        .details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-top: 14px;
        }

        .info {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 14px;
        }

        .info small {
            display: block;
            color: #6b7280;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .info span {
            font-weight: 900;
        }

        /* Payment method */
        .pay-box {
            margin-top: 18px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 16px;
        }

        .pay-box label {
            font-weight: 900;
            display: block;
            margin-bottom: 8px;
        }

        .select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            outline: none;
            font-size: 14px;
        }

        .select:focus {
            border: 1px solid #facc15;
            box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.25);
        }

        .btn {
            width: 100%;
            margin-top: 14px;
            padding: 12px;
            background: #000;
            color: #facc15;
            border: none;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 900;
            cursor: pointer;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .back {
            display: inline-block;
            margin-top: 14px;
            text-decoration: none;
            font-weight: 900;
            color: #111827;
        }

        @media(max-width:900px) {
            .sidebar {
                display: none;
            }

            .main {
                padding: 18px;
            }

            .details {
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
                <h3>Hello, <?= htmlspecialchars($driver_name); ?> 👋</h3>
                <p>Driver Dashboard</p>
            </div>

            <div class="menu">
                <a href="dashboard.php">🏠 Dashboard</a>
                <a href="ride_requests.php">📥 Ride Requests</a>
                <a href="my_rides.php">🚖 My Rides</a>
                <a href="earnings.php">💰 Earnings</a>
                <a class="active" href="payment.php?booking_id=<?= $booking_id; ?>">💳 Payment</a>
                <a href="profile.php">👤 Profile</a>
                <a href="logout.php">🚪 Logout</a>
            </div>
        </div>

        <!-- Main -->
        <div class="main">

            <div class="topbar">
                <h2>Ride <span>Payment</span></h2>
                <small style="color:#6b7280;">CabRide • Driver Panel</small>
            </div>

            <?php if (isset($_GET['paid'])) { ?>
                <div class="alert success">✅ Payment Completed Successfully!</div>
            <?php } ?>

            <?= $msg; ?>

            <div class="card">
                <h3>💳 Collect Payment</h3>
                <p style="color:#6b7280;font-weight:600;">Complete the payment after ride finished.</p>

                <div class="details">
                    <div class="info"><small>User Name</small><span><?= $full_name; ?></span></div>
                    <div class="info"><small>User Mobile</small><span><?= $mobile; ?></span></div>
                    <div class="info"><small>Pickup</small><span><?= $pickup_location; ?></span></div>
                    <div class="info"><small>Drop</small><span><?= $drop_location; ?></span></div>
                    <div class="info"><small>Distance</small><span><?= $distance_km; ?> km</span></div>
                    <div class="info"><small>Fare</small><span>₹<?= $fare; ?></span></div>
                </div>

                <div class="pay-box">
                    <form method="POST" action="submit/done_payment.php">
                        <label>Select Payment Method</label>
                        <select class="select" name="payment_method" required>
                            <option value="">-- Select --</option>
                            <option value="cash">💵 Cash</option>
                            <option value="online">📲 Online</option>
                        </select>
                        <input type="hidden" name="booking_id" value="<?= $booking_id; ?>">
                        <input type="hidden" name="fare" value="<?= $fare; ?>">
                        <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                        <button class="btn" type="submit" name="confirm_payment">
                            ✅ Confirm Payment
                        </button>
                    </form>
                </div>

                <a class="back" href="my_rides.php">⬅ Back to My Rides</a>
            </div>

        </div>
    </div>
</body>

</html>