<?php
session_start();
include("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action === 'hide') {
        mysqli_query($link, "UPDATE ratings SET is_visible = 0 WHERE id = $id");
    }

    if ($action === 'show') {
        mysqli_query($link, "UPDATE ratings SET is_visible = 1 WHERE id = $id");
    }

    header("Location: ../ratings.php");
} else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../dashboard.php";
    </script>
<?php } ?>