<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once('../../config/db.php');
    $user_id = $_SESSION['user_id'];
    extract($_POST);
    $rate_per_km = 12;
    $fare = $distance_km * $rate_per_km;
    $sql = "INSERT INTO bookings(user_id,pickup_location,drop_location,distance_km,fare) VALUES ($user_id,'$pickup_location','$drop_location',$distance_km,$fare)";
    mysqli_query($link, $sql) or die(mysqli_error($link));
?>
    <script>
        alert("Booking successfully");
        window.location.href = "../track_ride.php";
    </script>
<?php
} else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../dashboard.php";
    </script>
<?php } ?>