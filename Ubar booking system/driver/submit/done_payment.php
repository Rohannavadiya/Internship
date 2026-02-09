<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === "POST") {
     include("../../config/db.php");
     extract($_POST);
     $driver_id = $_SESSION['driver_id'];
     $driver_amount   = $fare * 0.70;
     $platform_amount = $fare * 0.30;
     $sql = "INSERT INTO payments(booking_id,driver_id,amount,payment_method,payment_status,driver_amount,platform_amount) VALUES ($booking_id,$driver_id,$fare,'$payment_method','paid',$driver_amount,$platform_amount)";
     if (mysqli_query($link, $sql)) {
          $sql = "UPDATE bookings 
                      SET status='completed'
                       WHERE id='$booking_id' AND driver_id='$driver_id'";
          mysqli_query($link, $sql);
          header('Location:../my_rides.php?sussess=✅ Ride Accepted Successfully!');
     } else {
          header('Location:../my_rides.php?error=❌ Error:');
     }
} else {
?>
     <script>
          alert("Direct file not open!");
          window.location.href = "../dashboard.php";
     </script>
<?php } ?>