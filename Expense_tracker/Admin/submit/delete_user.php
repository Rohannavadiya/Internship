<?php
if ($_SERVER['REQUEST_METHOD'] === "GET") {
    require_once('../../ins/connection.php');
    extract($_REQUEST);
    $sql = "delete from users WHERE id=$id";
    mysqli_query($link, $sql) or die(mysqli_error($link));
?>
    <script>
        alert("User deleted successfully!");
        window.location.href = "../user_register.php";
    </script>
<?php } else {
?>
    <script>
        alert("Direct file not open!");
        // window.location.href = "../Dashboard.php";
    </script>
<?php } ?>