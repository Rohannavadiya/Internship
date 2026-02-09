<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once('../../ins/connection.php');
    extract($_POST);
    $psaa_hash = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users(name, email,password) VALUES ('$name','$email','$psaa_hash')";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
?>
    <script>
        alert("User insert successfully!");
        window.location.href = "../user_register.php";
    </script>
<?php
} else {
?>
    <script>
        alert("Login required!");
        window.location.href = "../index.php";
    </script>
<?php } ?>