<?php
if ($_SERVER['REQUEST_METHOD'] === "GET") {
    include("../../config/db.php");
    extract($_REQUEST);
    $sql = "UPDATE users SET status = IF(status='active','inactive','active') WHERE id = $user_id";
    mysqli_query($link, $sql);
    header("Location: ../users.php");
} else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../dashboard.php";
    </script>
<?php } ?>