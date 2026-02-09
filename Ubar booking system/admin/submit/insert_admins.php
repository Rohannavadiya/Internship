<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    extract($_POST);
    include("../../config/db.php");
    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO admins(name,email,password) VALUES ('$name','$email','$hash_pass')";
    mysqli_query($link, $sql);
    header('Location:../admins.php');
} else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../dashboard.php";
    </script>
<?php } ?>