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
    <title>Income Register</title>
    <link rel="stylesheet" href="../ins/Style.css">
    <?php
    require_once('../ins/connection.php');
    $sql = "select * from income order by income_id DESC";
    if (!empty($_GET['filter'])) {
        $filter = mysqli_real_escape_string($link, $_GET['filter']);
        $sql = "SELECT * FROM income ORDER BY income_date $filter";
    } else if (!empty($_GET['from']) and !empty($_GET['to'])) {
        $from = mysqli_real_escape_string($link, $_GET['from']);
        $to = mysqli_real_escape_string($link, $_GET['to']);
        $sql = "SELECT * FROM income where income_date between '$from' and '$to'";
    } else if (!empty($_GET['search'])) {
        $search = mysqli_real_escape_string($link, $_GET['search']);
        $sql = "SELECT * FROM income where income_date like '%$search%'or account_num like '%$search%'or amount like '%$search%' or source like '%$search%' or category like '%$search%' or payment_method like '%$search%' or received_from like '%$search%' or description like '%$search%' or cheqe_num like '%$search%' ORDER BY income_id DESC";
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
            <h2>Income Register</h2>
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
                            <th>Received From</th>
                            <th>Description</th>
                            <th>Cheque No</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) {
                            extract($row); ?>
                            <tr>
                                <td><?= $income_id ?></td>
                                <td><?= $income_date ?></td>
                                <td><?= $account_num ?></td>
                                <td><?= $amount ?></td>
                                <td><?= $source ?></td>
                                <td><?= $category ?></td>
                                <td><?= $payment_method ?></td>
                                <td><?= $received_from ?></td>
                                <td><?= $description ?></td>
                                <td><?= $cheqe_num ?></td>
                                <td>
                                    <a href="edit_income.php?id=<?= $income_id ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="submit/delete_income.php?id=<?= $income_id ?>">
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