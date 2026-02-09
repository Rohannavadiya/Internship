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
    <title>User Register</title>
    <link rel="stylesheet" href="../ins/Style.css">
    <?php
    require_once('../ins/connection.php');
    $sql = "select * from users";
    if (!empty($_GET['filter'])) {
        $filter = mysqli_real_escape_string($link, $_GET['filter']);
        $sql = "SELECT * FROM users where role like '$filter'";
    } else if (!empty($_GET['search'])) {
        $search = mysqli_real_escape_string($link, $_GET['search']);
        $sql = "SELECT * FROM users where name like '%$search%'or email like '%$search%' or role like '%$search%' ORDER BY id DESC";
    }
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
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
    <div class="content-fuill">
        <div class="box-fuill">
            <div class="search-filter-div">
                <form action="" method="GET" class="search-form">
                    <div class="form-group-search">
                        <input type="text" name="search" class="search-input" placeholder="Search record">
                    </div>
                    <div class="form-group-search">
                        <select name="filter" id="filter" class="search-select">
                            <option value="">Select order</option>
                            <option value="admin">Admins</option>
                            <option value="user">Users</option>
                        </select>
                    </div>
                    <div class="form-group-search">
                        <input type="submit" value="Submit">
                    </div>
                </form>
                <form action="" method="">
                    <div class="form-group-search">
                        <input type="submit" value="Resate">
                    </div>
                </form>
            </div>
            <h2>Users Register</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) {
                            extract($row); ?>
                            <tr>
                                <td><?= $id ?></td>
                                <td><?= $name ?></td>
                                <td><?= $email ?></td>
                                <td><?= $role ?></td>
                                <td>
                                    <?php
                                    if ($_SESSION['user_name'] != $name) {
                                    ?>
                                        <a href="edit_user.php?id=<?= $id ?>">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="submit/delete_user.php?id=<?= $id ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>