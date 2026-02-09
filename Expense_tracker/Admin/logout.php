<?php
session_start();
if (isset($_SESSION['user_type']) == false) {
?>
    <script>
        alert("Login required!");
        window.location.href = "../index.php";
    </script>
<?php } else if ($_SESSION['user_type'] == "user") {
    session_unset();
    session_destroy();
    
?>
    <script>
        alert("Admin Login required!");
        window.location.href = "../index.php";
    </script>
<?php }
session_unset();
session_destroy();
?>
<script>
    alert("Session successfully end!");
    window.location.href = "../index.php";
</script>