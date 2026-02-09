<?php
require_once('../ins/connection.php');
extract($_POST);
$ho = implode(',', $hob);
$sql = "UPDATE inter SET name='$name',mobile=$mobile,gender='$gen',hobbies='$ho',income=$income WHERE id=$hid";
mysqli_query($link, $sql) or die(mysqli_error($link));
?>
<script>
    alert("Data updated sucessfully");
    window.location.href = "../view.php";
</script>