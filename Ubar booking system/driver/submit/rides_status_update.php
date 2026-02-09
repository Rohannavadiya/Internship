<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $driver_id   = $_SESSION['driver_id'];
    include("../../config/db.php");
    extract($_REQUEST);
    if (isset($start_id)) {
        $sql = "UPDATE bookings 
                  SET status='ongoing'
                  WHERE id='$start_id' AND driver_id='$driver_id' AND status='accepted'";

        if (mysqli_query($link, $sql)) {
            $msg = "<div class='alert success'>✅ Ride Started Successfully!</div>";
            header('Location:../my_rides.php?msg=$msg');
        } else {
            $msg = "<div class='alert error'>❌ Error: " . mysqli_error($link) . "</div>";
        }
    }

    if (isset($complete_id))
        header("Location: ../payment.php?booking_id=" . $complete_id);
} else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../dashboard.php";
    </script>
<?php } ?>