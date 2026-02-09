<html>

<head>
	<title>edit</title>
</head>

<body>
	<?php
	require_once("ins\connection.php");
	extract($_REQUEST);

	$sql = "select * from img_loc where id=$id";
	$result = mysqli_query($link, $sql) or die(mysqli_error($link));
	$row = mysqli_fetch_array($result);

	extract($row);
	?>
	<form action="submit\update.php" method="POST" enctype="multipart/form-data">
		<label>Attch Resume: </label>
		<input type="file" name="resume" accept="image/*" />
		<a href="img/<?php echo $img; ?>">Resume</a>
		<br><br>
		<input type="hidden" name="id" value="<?= $id ?>" />

		<button type="submit">submit</button>
	</form>
</body>

</html>