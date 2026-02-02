<?php
include("../../config/db.php");
extract($_REQUEST);
$sql="update drivers set status='$action' where id=$driver_id";
mysqli_query($link, $sql);
header("Location: ../drivers.php");
?>