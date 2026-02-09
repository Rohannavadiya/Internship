<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    extract($_POST);
    include("../../config/db.php");
    if ($password!="") {
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET full_name='$full_name',password='$hash_pass',email='$email',mobile=$mobile,status='$status' WHERE id=$user_id";
        mysqli_query($link, $sql);
    } else {
        $sql = "UPDATE users SET full_name='$full_name',email='$email',mobile=$mobile,status='$status' WHERE id=$user_id";
        mysqli_query($link, $sql);
    }
    header('Location:../users.php');
} else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../dashboard.php";
    </script>
<?php } ?>