<?php
require_once('../ins/connection.php');
extract($_REQUEST);
$sql = "delete from inter where id=$fid";
mysqli_query($link, $sql) or die(mysqli_error($link));
?>
<script>
    alert("Data deleted sucessfully");
    window.location.href = "../view.php";
</script>