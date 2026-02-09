<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once('../../ins/connection.php');
    extract($_POST);
    $psaa_hash = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET name='$name',email='$mail',role='$role',password='$psaa_hash' WHERE id=$id";
    mysqli_query($link, $sql) or die(mysqli_error($link));
?>
    <script>
        alert("User Updated successfully");
        window.location.href = "../user_register.php";
    </script>
<?php } else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../Dashboard.php";
    </script>
<?php } ?>