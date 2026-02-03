<?php
extract($_POST);
include("../../config/db.php");
$sql="update admins set name='$name',email='$email' where id=$admin_id";
mysqli_query($link, $sql);
header('Location:../admins.php');
?>