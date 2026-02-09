<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    extract($_POST);
    include("../../config/db.php");
    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users(full_name,email,mobile,password,status) VALUES ('$full_name','$full_name',$mobile,'$hash_pass','$status')";
    mysqli_query($link, $sql);
    header('Location:../users.php');
} else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../dashboard.php";
    </script>
<?php } ?>