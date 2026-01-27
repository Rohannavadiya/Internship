<?php
session_start();
include("../../config/db.php");
$driver_id = $_SESSION['driver_id'];
extract($_REQUEST);
$sql="update drivers set availability='$availability' where id=$driver_id";
mysqli_query($link, $sql);
header('Location:../dashboard.php');
?>