<?php
if ($_SERVER['REQUEST_METHOD'] === "GET") {
    include("../../config/db.php");
    extract($_REQUEST);
    $sql = "update drivers set status='$action' where id=$driver_id";
    mysqli_query($link, $sql);
    header("Location: ../drivers.php");
} else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../dashboard.php";
    </script>
<?php } ?>