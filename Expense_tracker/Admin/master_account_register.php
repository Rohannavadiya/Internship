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
    <title>Master Account Register</title>
    <link rel="stylesheet" href="../ins/Style.css">
    <?php
    require_once('../ins/connection.php');
    $sql = "select * from master_account order by id DESC";
    if (!empty($_GET['filter'])) {
        $filter = mysqli_real_escape_string($link, $_GET['filter']);
        $sql = "select * from master_account order by id $filter";
    } else if (!empty($_GET['search'])) {
        $search = mysqli_real_escape_string($link, $_GET['search']);
        $sql = "SELECT * FROM master_account where acc_name like '%$search%' or acc_group like '%$search%' or opening_balance like '%$search%' or bank_name like '%$search%' or bank_account_number like '%$search%' or bank_branch like '%$search%' or credit_limit like '%$search%' or bill_limit like '%$search%' ORDER BY id DESC";
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
    <div class="content">
        <div class="box-master">
            <div class="search-filter-div">
                <form action="" method="GET" class="search-form">
                    <div class="form-group-search">
                        <input type="text" name="search" class="search-input" placeholder="Search record">
                    </div>
                    <div class="form-group-search">
                        <select name="filter" id="filter" class="search-select">
                            <option value="">Select order</option>
                            <option value="asc">Ascending order</option>
                            <option value="desc">Descending order</option>
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
            <h2>Master Account</h2>
            <div class="table-wrapper-account">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Account Name</th>
                            <th>Account Group</th>
                            <th>Opening Balance</th>
                            <th>Bank Name</th>
                            <th>Bank Account Number</th>
                            <th>Bank Branch</th>
                            <th>Credit Limit</th>
                            <th>Bill Limit</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) {
                            extract($row); ?>
                            <tr>
                                <td><?= $id ?></td>
                                <td><?= $acc_name ?></td>
                                <td><?= $acc_group ?></td>
                                <td><?= $opening_balance ?></td>
                                <td><?= $bank_name ?></td>
                                <td><?= $bank_account_number ?></td>
                                <td><?= $bank_branch ?></td>
                                <td><?= $credit_limit ?></td>
                                <td><?= $bill_limit ?></td>
                                <td>
                                    <a href="edit_master_account.php?id=<?= $id ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="submit/delete_master_account.php?id=<?= $id ?>">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
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