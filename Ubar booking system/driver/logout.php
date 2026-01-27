<?php
session_start();
if (isset($_SESSION['driver_type']) == false) {
?>
    <script>
        alert("Login required!");
        window.location.href = "../auth/login.php";
    </script>
<?php }
unset($_SESSION['driver_id'],$_SESSION['driver_type'],$_SESSION['driver_name']);
session_destroy();
?>
<script>
    alert("Session successfully end!");
    window.location.href = "../auth/login.php";
</script>