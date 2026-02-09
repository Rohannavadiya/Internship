<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    extract($_POST);
    include("../../config/db.php");
    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO drivers(full_name,email,mobile,password,license_number,vehicle_type, availability,status) VALUES ('$full_name','$email',$mobile,'$hash_pass','$license_number','$vehicle_type','$availability','$status')";
    mysqli_query($link, $sql);
    header('Location:../drivers.php');
} else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../dashboard.php";
    </script>
<?php } ?>