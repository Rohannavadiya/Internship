<html>

<head>
	<title></title>
</head>

<body>
	<div>
		<a href="insert_img.php">ADD</a>
	</div>
	<div class="table">
		<table>
			<tr>
				<td>Images</td>
				<td>OPERATION</td>
			</tr>
			<?php
			require_once("ins\connection.php");
			$sql = "select * from img_loc";
			$result = mysqli_query($link, $sql) or die(mysqli_error($link));
			while ($row = mysqli_fetch_assoc($result)) {
				extract($row);
			?>
				<tr>
					<td><a href="img\<?= $img ?>">img</a></td>
					<td colspan=2>
						<a href="edit.php?id=<?= $id ?>">Edit</a>
						<a href="submit\delete.php?id=<?= $id ?>">Delete</a>
					</td>
				</tr>
			<?php
			}
			?>
		</table>
		<div>
</body>

</html>