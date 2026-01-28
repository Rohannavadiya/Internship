<?php
session_start();
sleep(rand(1, 5));
include("../../config/db.php");
extract($_REQUEST);
$driver_id = $_SESSION['driver_id'];
if ($availability == "online") {
    $sql = "update drivers set availability='$availability' where id=$driver_id";
    mysqli_query($link, $sql);
    header('Location:../ride_requests.php');
} else if ($availability == "offline") {
    $sql = "update drivers set availability='$availability' where id=$driver_id";
    mysqli_query($link, $sql);
    header('Location:../dashboard.php');
}
?>