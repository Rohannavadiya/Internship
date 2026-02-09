<?php
session_start();
include("../config/db.php");
$driver_id = $_SESSION['driver_id'];
if (isset($_SESSION['driver_type']) == false) {
?>
    <script>
        alert("Login required!");
        window.location.href = "../auth/login.php";
    </script>
<?php }
$sql = "update drivers set availability='offline' where id=$driver_id";
mysqli_query($link, $sql);
unset($_SESSION['driver_id'], $_SESSION['driver_type'], $_SESSION['driver_name']);
session_destroy();
?>
<script>
    alert("Session successfully end!");
    window.location.href = "../auth/login.php";
</script>