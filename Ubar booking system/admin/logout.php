<?php
session_start();
if (isset($_SESSION['admin_type']) == false) {
?>
    <script>
        alert("Login required!");
        window.location.href = "../auth/login.php";
    </script>
<?php }
unset($_SESSION['admin_id'],$_SESSION['admin_type'],$_SESSION['admin_name']);
session_destroy();
?>
<script>
    alert("Session successfully end!");
    window.location.href = "../auth/admin_login.php";
</script>