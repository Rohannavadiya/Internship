<?php
session_start();
require_once('ins/connection.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);
    $sql = "select password,role,name from users where email='$email'";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    if (mysqli_num_rows($result) === 0) {
?>
        <script>
            alert("Invalid input!");
            window.location.href = "index.php";
        </script>
        
        <?php
    } else {
        $row = mysqli_fetch_assoc($result);
        extract($row);
        if (password_verify($pass, $password) == true) {
            if ($role == "admin") {
                $_SESSION['user_type'] = $role;
                $_SESSION['user_name'] = $name;
                header('Location:Admin/Dashboard.php');
            } else if ($role == "user") {
                $_SESSION['user_type'] = $role;
                $_SESSION['user_name'] = $name;
                header('Location:User/Dashboard.php');
            }
        } else {
        ?>
            <script>
                alert("Invalid input!");
                window.location.href = "index.php";
            </script>
    <?php
        }
    }
} else { ?>
    <script>
        alert("Login Require");
        window.location.href = "index.php";
    </script>
<?php } ?>