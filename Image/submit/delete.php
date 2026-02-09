<?php
require_once("..\ins\connection.php");
extract($_REQUEST);

$sql = "select img from img_loc where id=$id";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));
$row = mysqli_fetch_assoc($result);
extract($row);
unlink("../img/$img");

$sql = "delete from img_loc where id=$id";
mysqli_query($link, $sql) or die(mysqli_error($link));
?>
<script>
	alert("Image successfully deleted!");
	window.location.href = "../view.php";
</script>