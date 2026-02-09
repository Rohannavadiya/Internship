<?php
session_start();
if (isset($_SESSION['user_type']) == false) {
?>
    <script>
        alert("Login required!");
        window.location.href = "../index.php";
    </script>
<?php } else if ($_SESSION['user_type'] == "admin") {
    session_unset();
    session_destroy();
?>
    <script>
        alert("User Login required!");
        window.location.href = "../index.php";
    </script>
<?php } ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../ins/Style.css">
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
        <a href="logout.php">Logout</a>
    </div>
    <div class="topbar">ITHub Software - User Panel - Hello <?php echo $_SESSION['user_name']; ?>!</div>
    <div class="content">
        <div class="box">
            <div class="container">
                <a href="add_income.php">
                    <div class="card">
                        <i class="fa-solid fa-money-bill-trend-up"></i>
                        <span>Add Income</span>
                    </div>
                </a>
                <a href="add_expence.php">
                    <div class="card">
                        <i class="fa-solid fa-money-bill-transfer"></i>
                        <span>Add Expenses</span>
                    </div>
                </a>
                <a href="profit_loss.php">
                    <div class="card">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Profit & Loss</span>
                    </div>
                </a>
                <a href="income_register.php">
                    <div class="card">
                        <i class="fa-solid fa-wallet"></i>
                        <span>Income Register</span>
                    </div>
                </a>
                <a href="expence_register.php">
                    <div class="card">
                        <i class="fa-solid fa-receipt"></i>
                        <span>Expenses Register</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>