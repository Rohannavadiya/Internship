<?php
require_once("..\ins\connection.php");
extract($_POST);

$photo = rand(1000, 9999) . "_" . $_FILES['resume']['name'];
move_uploaded_file($_FILES['resume']['tmp_name'], "../img/$photo");

$sql = "insert into img_loc(img) values ('$photo')";

mysqli_query($link, $sql) or die(mysqli_error($link));
?>
<script>
	alert("img insert successfully.");
	window.location.href = "../view.php";
</script>