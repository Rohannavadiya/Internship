<?php
session_start();
include("../../config/db.php");
extract($_POST);
$driver_id = $_SESSION['driver_id'];
$sql = "INSERT INTO payments(booking_id,amount,payment_method,payment_status) VALUES ($booking_id,$fare,'$payment_method','paid')";
if (mysqli_query($link, $sql)) {
$sql = "UPDATE bookings 
                      SET status='completed'
                       WHERE id='$booking_id' AND driver_id='$driver_id'";
     mysqli_query($link, $sql);
     header('Location:../my_rides.php?sussess=✅ Ride Accepted Successfully!');
} else {
header('Location:../my_rides.php?error=❌ Error:');
}
?>