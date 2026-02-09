<?php
session_start();
require_once('../config/db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);
    if ($role == "user") {
        $sql = "SELECT id,full_name, password 
             FROM users 
             WHERE email = '$mail'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($pass, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_type'] = 'user';
                $_SESSION['user_name'] = $row['full_name'];
                header("Location: ../User/dashboard.php");
            } else { ?>
                <script>
                    alert("User not found");
                    window.location.href = "login.php";
                </script>
            <?php
            }
        } else { ?>
            <script>
                alert("Invalid password");
                window.location.href = "login.php";
            </script>
            <?php
        }
    } else if ($role == "driver") {
        $sql = "SELECT id,full_name, password 
             FROM drivers 
             WHERE email = '$mail'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($pass, $row['password'])) {
                $_SESSION['driver_id'] = $row['id'];
                $_SESSION['driver_type'] = 'driver';
                $_SESSION['driver_name'] = $row['full_name'];
                header("Location: ../Driver/dashboard.php");
            } else { ?>
                <script>
                    alert("User not found");
                    window.location.href = "login.php";
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                alert("Invalid password");
                window.location.href = "login.php";
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert("Invalid password");
            window.location.href = "login.php";
        </script>
    <?php
    }
} else { ?>
    <script>
        alert("Login Require");
        window.location.href = "login.php";
    </script>
<?php } ?>