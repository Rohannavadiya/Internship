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
    <title>Expence Register</title>
    <link rel="stylesheet" href="../ins/Style.css">
    <?php
    require_once('../ins/connection.php');
    $sql = "select * from expenses order by expense_id DESC";
    if (!empty($_GET['filter'])) {
        $filter = mysqli_real_escape_string($link, $_GET['filter']);
        $sql = "SELECT * FROM expenses ORDER BY expense_date $filter";
    } else if (!empty($_GET['from']) and !empty($_GET['to'])) {
        $from = mysqli_real_escape_string($link, $_GET['from']);
        $to = mysqli_real_escape_string($link, $_GET['to']);
        $sql = "SELECT * FROM expenses where expense_date between '$from' and '$to'";
    } else if (!empty($_GET['search'])) {
        $search = mysqli_real_escape_string($link, $_GET['search']);
        $sql = "SELECT * FROM expenses where expense_date like '%$search%' or account_num like '%$search%' or amount like '%$search%' or source like '%$search%' or category like '%$search%' or payment_method like '%$search%' or paid_to like '%$search%' or expense_type like '%$search%' or description like '%$search%' ORDER BY expense_id DESC";
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
                            <option value="asc">Ascending order</option>
                            <option value="desc">Descending order</option>
                        </select>
                    </div>
                    <div class="form-group-search">
                        <label class="search-label">From </label>
                        <input type="date" name="from" class="search-input">
                    </div>
                    <div class="form-group-search">
                        <label class="search-label">To </label>
                        <input type="date" name="to" class="search-input">
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
            <h2>Expence Register</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Account No</th>
                            <th>Amount</th>
                            <th>Source</th>
                            <th>Category</th>
                            <th>Payment</th>
                            <th>Paid to</th>
                            <th>Expence type</th>
                            <th>Cheqenum</th>
                            <th>Description</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) {
                            extract($row); ?>
                            <tr>
                                <td><?= $expense_id ?></td>
                                <td><?= $expense_date ?></td>
                                <td><?= $account_num ?></td>
                                <td><?= $amount ?></td>
                                <td><?= $source ?></td>
                                <td><?= $category ?></td>
                                <td><?= $payment_method ?></td>
                                <td><?= $paid_to ?></td>
                                <td><?= $expense_type ?></td>
                                <td><?= $cheqe_num ?></td>
                                <td><?= $description ?></td>
                                <td>
                                    <a href="edit_expence.php?id=<?= $expense_id ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="submit/delete_expence.php?id=<?= $expense_id ?>">
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