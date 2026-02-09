<?php
session_start();
session_unset();
session_destroy();
?>
<script>
    alert("Logout successfully");
    window.location.href = "login.php";
</script>