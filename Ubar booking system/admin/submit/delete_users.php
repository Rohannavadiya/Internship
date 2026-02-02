<?php
include("../../config/db.php");
extract($_REQUEST);
$sql="delete from users where id=$user_id";
mysqli_query($link, $sql);
header("Location: ../users.php");
?>