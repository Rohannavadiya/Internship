<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $driver_id   = $_SESSION['driver_id'];
    include("../../config/db.php");
    extract($_REQUEST);
    if (isset($_GET['accept_id'])) {
        $booking_id = intval($_GET['accept_id']);

        $sql = "UPDATE bookings 
                   SET driver_id='$driver_id', status='accepted'
                   WHERE id='$booking_id' AND status='requested'";
        if (mysqli_query($link, $sql)) {
            header('Location:../ride_requests.php?sussess=✅ Ride Accepted Successfully!');
        } else {
            header('Location:../ride_requests.php?error=❌ Error:');
        }
    }
    if (isset($_GET['reject_id'])) {
        $booking_id = intval($_GET['reject_id']);

        $sql = "UPDATE bookings 
                   SET status='cancelled', cancel_reason='Rejected by driver'
                   WHERE id='$booking_id' AND status='requested'";
        if (mysqli_query($link, $sql)) {
            header('Location:../ride_requests.php?sussess=✅ Ride Rejected Successfully!');
        } else {
            header('Location:../ride_requests.php?error=❌ Error:');
        }
    }
} else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../dashboard.php";
    </script>
<?php } ?>