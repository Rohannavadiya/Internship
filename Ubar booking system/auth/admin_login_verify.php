<?php
session_start();
require_once('../config/db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);
    $sql = "SELECT id,name, password 
             FROM admins 
             WHERE email = '$mail'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_type'] = 'admin';
            $_SESSION['admin_name'] = $row['name'];
            header("Location: ../admin/dashboard.php");
        } else { ?>
            <script>
                alert("User not found");
                window.location.href = "admin_login.php";
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert("Invalid password");
            window.location.href = "admin_login.php";
        </script>
    <?php
    }
} else { ?>
    <script>
        alert("Login Require");
        window.location.href = "admin_login.php";
    </script>
<?php } ?>