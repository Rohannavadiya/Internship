<?php
include("../../config/db.php");
extract($_REQUEST);
$sql = "UPDATE users SET status = IF(status='active','inactive','active') WHERE id = $user_id";
mysqli_query($link, $sql);
header("Location: ../users.php");
