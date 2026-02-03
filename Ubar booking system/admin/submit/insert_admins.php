<?php
extract($_POST);
include("../../config/db.php");
$hash_pass=password_hash($password,PASSWORD_DEFAULT);
$sql="INSERT INTO admins(name,email,password) VALUES ('$name','$email','$hash_pass')";
mysqli_query($link, $sql);
header('Location:../admins.php');
?>