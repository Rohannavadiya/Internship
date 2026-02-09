<?php
require_once('../ins/connection.php');
extract($_POST);
$ho = implode(',', $hob);
$sql = "INSERT INTO inter (name,mobile,gender,hobbies,income) VALUES ('$name',$mobile,'$gen','$ho',$income)";
mysqli_query($link, $sql) or die(mysqli_error($link));
?>
<script>
    alert("Data inserted sucessfully");
    window.location.href = "../view.php";
</script>