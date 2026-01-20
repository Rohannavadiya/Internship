<?php
session_start();
if (isset($_SESSION['user_type']) == false) {
?>
    <script>
        alert("Login required!");
        window.location.href = "login.php";
    </script>
<?php }
session_unset();
session_destroy();
?>
<script>
    alert("Session successfully end!");
    window.location.href = "login.php";
</script>