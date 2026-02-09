<?php
session_start();
if (isset($_SESSION['user_type']) == false) {
?>
    <script>
        alert("Login required!");
        window.location.href = "../auth/login.php";
    </script>
<?php }
unset($_SESSION['user_id'],$_SESSION['user_type'],$_SESSION['user_name']);
session_destroy();
?>
<script>
    alert("Session successfully end!");
    window.location.href = "../auth/login.php";
</script>