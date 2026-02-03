<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    extract($_POST);
    include("../../config/db.php");
    $sql = "update admins set name='$name',email='$email' where id=$admin_id";
    mysqli_query($link, $sql);
    header('Location:../admins.php');
} else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../dashboard.php";
    </script>
<?php } ?>