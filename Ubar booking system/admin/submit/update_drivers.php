<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    extract($_POST);
    include("../../config/db.php");
    if ($password!="") {
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE drivers SET full_name='$full_name',password='$hash_pass',email='$email',license_number='$license_number',mobile=$mobile,vehicle_type='$vehicle_type',availability='$availability',status='$status' WHERE id=$driver_id";
        mysqli_query($link, $sql);
    } else {
        $sql = "UPDATE drivers SET full_name='$full_name',email='$email',license_number='$license_number',mobile=$mobile,vehicle_type='$vehicle_type',availability='$availability',status='$status' WHERE id=$driver_id";
        mysqli_query($link, $sql);
    }
    header('Location:../drivers.php');
} else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../dashboard.php";
    </script>
<?php } ?>