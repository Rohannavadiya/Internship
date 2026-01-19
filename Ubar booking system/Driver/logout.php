<?php
session_start();
session_unset();
session_destroy();
?>
<script>
    alert("Session successfully end!");
    window.location.href = "../Auth/login.php";
</script>