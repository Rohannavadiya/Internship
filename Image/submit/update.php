<?php
require_once("..\ins\connection.php");
extract($_POST);

$sql = "select img from img_loc where id=$id";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));
$row = mysqli_fetch_assoc($result);
extract($row);
$oldPhoto = "../img/" . $img;

if ($_FILES['resume']['error'] === 0) {
	unlink($oldPhoto);
	$photo = rand(1000, 9999) . "_" . $_FILES['resume']['name'];
	move_uploaded_file($_FILES['resume']['tmp_name'], "../img/$photo");

	$sql = "update img_loc set img='$photo' where id=$id";
	mysqli_query($link, $sql) or die(mysqli_error($link));
} else if ($_FILES['resume']['error'] === 4) {
	$sql = "update img_loc set img='$photo' where id=$id";
	mysqli_query($link, $sql) or die(mysqli_error($link));
}
?>
<script>
	alert("Image update successfully.");
	window.location.href = "../view.php";
</script>