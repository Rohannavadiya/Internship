<?php
extract($_POST);
include("../../config/db.php");
$sql="UPDATE users SET full_name='$full_name',mobile=$mobile,status='$status' WHERE id=$user_id";
mysqli_query($link, $sql);
header('Location:../users.php');
?>