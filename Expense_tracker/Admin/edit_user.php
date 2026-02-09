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
<?php } ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user</title>
    <link rel="stylesheet" href="../ins/Style.css">
    <?php
    require_once('../ins/connection.php');
    extract($_REQUEST);
    $sql = "select * from users where id=$id";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    extract($row);
    ?>
</head>

<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <a href="Dashboard.php">Home</a>
        <a href="add_income.php">Add Income</a>
        <a href="income_register.php">Income Register</a>
        <a href="add_expence.php">Add Expence</a>
        <a href="expence_register.php">Expence Register</a>
        <a href="profit_loss.php">Profit & Loss</a>
        <a href="master_account_add.php">Add Master Account</a>
        <a href="master_account_register.php">Master Register</a>
        <a href="add_user.php">Add user</a>
        <a href="user_register.php">User Register</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="topbar">ITHub Software - Admin Panel - Hello <?php echo $_SESSION['user_name']; ?>!</div>
    <div class="content">
        <div class="box-index">
            <h2>Edit User</h2>
            <form action="submit/update_user.php" method="POST">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Name</label>
                        <input type="text" name="name" value="<?= $name ?>" required>
                    </div>
                    <div class="form-group full-width">
                        <label>Email</label>
                        <input type="mail" name="mail" value="<?= $email ?>" required>
                    </div>
                    <div class="form-group full-width">
                        <label>Password</label>
                        <input type="password" name="pass" value="<?= $password ?>" required>
                    </div>
                    <div class="form-group  full-width">
                        <label>Role</label>
                        <select name="role">
                            <option <?php echo ($role == "admin") ? "selected" : ""; ?> value="admin">Admin</option>
                            <option <?php echo ($role == "user") ? "selected" : ""; ?> value="user">User</option>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-group full-width">
                        <input type="submit" value="Submit">
                    </div>
            </form>
        </div>
    </div>
</body>

</html>