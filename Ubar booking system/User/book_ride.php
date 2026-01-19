<?php
session_start();
include("../config/db.php");

/* ✅ Uncomment after login system ready
if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}
*/

$user_id = $_SESSION['user_id'] ?? 1; // demo user id

$msg = "";

if(isset($_POST['book_ride'])){
    $pickup_location = mysqli_real_escape_string($link, $_POST['pickup_location']);
    $drop_location   = mysqli_real_escape_string($link, $_POST['drop_location']);
    $distance_km     = floatval($_POST['distance_km']);

    // ✅ simple fare logic (you can change later)
    $rate_per_km = 12;  
    $fare = $distance_km * $rate_per_km;

    if($pickup_location == "" || $drop_location == "" || $distance_km <= 0){
        $msg = "<div class='alert error'>❌ Please fill all fields correctly!</div>";
    }else{
        $sql = "INSERT INTO bookings (user_id, pickup_location, drop_location, distance_km, fare, status)
                VALUES ('$user_id', '$pickup_location', '$drop_location', '$distance_km', '$fare', 'requested')";

        if(mysqli_query($link,$sql)){
            $msg = "<div class='alert success'>✅ Ride Booked Successfully! Driver will accept soon 🚖</div>";
        }else{
            $msg = "<div class='alert error'>❌ Error: ".mysqli_error($conn)."</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Book Ride | CabRide</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}
body{
    background:#f9fafb;
    color:#111827;
}

/* Page Wrapper */
.container{
    max-width:1100px;
    margin:auto;
    padding:30px 18px;
}

/* Header */
.header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:20px;
}
.header h2{
    font-size:24px;
}
.header a{
    text-decoration:none;
    background:#facc15;
    color:#000;
    padding:10px 18px;
    border-radius:12px;
    font-weight:600;
}

/* Booking Box */
.box{
    background:#fff;
    padding:22px;
    border-radius:18px;
    box-shadow:0 10px 30px rgba(0,0,0,0.06);
    border:1px solid #f1f5f9;
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}
.left img{
    width:100%;
    max-width:420px;
}
.right h3{
    margin-bottom:10px;
}
.form-group{
    margin-bottom:14px;
}
label{
    font-size:14px;
    font-weight:600;
    display:block;
    margin-bottom:6px;
}
input{
    width:100%;
    padding:12px 14px;
    border-radius:14px;
    border:1px solid #e5e7eb;
    outline:none;
    font-size:14px;
}
input:focus{
    border:1px solid #facc15;
    box-shadow:0 0 0 3px rgba(250,204,21,0.25);
}
button{
    width:100%;
    padding:12px;
    background:#000;
    color:#facc15;
    border:none;
    border-radius:14px;
    font-size:15px;
    font-weight:700;
    cursor:pointer;
}
button:hover{
    opacity:0.9;
}

/* Alert */
.alert{
    padding:12px 14px;
    border-radius:14px;
    margin-bottom:15px;
    font-size:14px;
    font-weight:600;
}
.success{ background:#ecfdf5; color:#047857; }
.error{ background:#fef2f2; color:#b91c1c; }

/* Responsive */
@media(max-width:900px){
    .box{
        grid-template-columns:1fr;
        text-align:center;
    }
    .left{
        display:flex;
        justify-content:center;
    }
}
</style>
</head>
<body>

<div class="container">

    <div class="header">
        <h2>🚖 Book Your Ride</h2>
        <a href="dashboard.php">⬅ Back</a>
    </div>

    <?= $msg; ?>

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

</body>
</html>

