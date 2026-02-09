<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === "POST") {
	require_once('../../config/db.php');
	extract($_POST);
	$user_id = $_SESSION['user_id'];
	$sql = "select img from users where id=$user_id";
	$result = mysqli_query($link, $sql) or die(mysqli_error($link));
	$row = mysqli_fetch_assoc($result);
	extract($row);
	$oldPhoto = "../../assets/images/" . $img;

	if ($_FILES['profile_image']['error'] === 0) {
		if ($img != "123_unknown.jpg")
			unlink($oldPhoto);
		$photo = rand(1000, 9999) . "_" . $_FILES['profile_image']['name'];
		move_uploaded_file($_FILES['profile_image']['tmp_name'], "../../assets/images/$photo");

		$sql = "update users set full_name='$full_name',mobile=$mobile,img='$photo' where id=$user_id";
		mysqli_query($link, $sql) or die(mysqli_error($link));
	} else if ($_FILES['profile_image']['error'] === 4) {
		$sql = "update users set full_name='$full_name',mobile=$mobile where id=$user_id";
		mysqli_query($link, $sql) or die(mysqli_error($link));
	}
?>
	<script>
		alert("Data updated successfully.");
		window.location.href = "../profile.php?updated=success";
	</script>
<?php
} else {
?>
	<script>
		alert("Direct file not open!");
		window.location.href = "../dashboard.php";
	</script>
<?php } ?>