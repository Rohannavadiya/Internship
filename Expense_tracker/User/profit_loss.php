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
    <title>Profit & Loss</title>
    <link rel="stylesheet" href="../ins/Style.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php
    require_once('../ins/connection.php');
    /* INCOME */
    $sql_income = "select account_num,sum(amount) as sum_account_num from income group by account_num";
    $sql_income_total = "select sum(amount) as amount_total_income from income";
    $result_income = mysqli_query($link, $sql_income);
    $total_income  = mysqli_query($link, $sql_income_total);
    /* EXPENSE */
    $sql_expense = "select account_num,sum(amount) as sum_account_num from expenses group by account_num";
    $sql_expense_total = "select sum(amount) as amount_total_expenses from expenses";
    $result_expense = mysqli_query($link, $sql_expense);
    $total_expense  = mysqli_query($link, $sql_expense_total);
    $income_count  = mysqli_num_rows($result_income);
    $expense_count = mysqli_num_rows($result_expense);
    /* TOTAL VALUES */
    $row = mysqli_fetch_assoc($total_income);
    $amount_total_income = $row['amount_total_income'] ?? 0;
    $row = mysqli_fetch_assoc($total_expense);
    $amount_total_expenses = $row['amount_total_expenses'] ?? 0;
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
        <a href="logout.php">Logout</a>
    </div>
    <div class="topbar">ITHub Software - Admin Panel - Hello <?php echo $_SESSION['user_name']; ?>!</div>
    <div class="content">
        <div class="box-charts">
            <div class="parent-table">
                <!-- INCOME TABLE -->
                <div class="table-wrapper">
                    <h2>Income Register</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Account number</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result_income)): ?>
                                <tr>
                                    <td><?= $row['account_num'] ?></td>
                                    <td><?= $row['sum_account_num'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                            <?php while ($income_count < $expense_count): ?>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            <?php $income_count++;
                            endwhile; ?>
                            <tr class="black-total">
                                <td>Total</td>
                                <td><?= $amount_total_income ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="profit-loss">
                        <?php
                        $profit = $amount_total_income;
                        $loss = $amount_total_expenses;
                        if ($profit - $loss > 0) {
                            echo "<span class='profit'>Profit: " . $profit - $loss . "</span>";
                        } else {
                            echo "<span class='loss'>Loss: " . $profit - $loss . "</span>";
                        }
                        ?>
                    </div>
                </div>
                <!-- EXPENSE TABLE -->
                <div class="table-wrapper">
                    <h2>Expense Register</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Account number</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result_expense)): ?>
                                <tr>
                                    <td><?= $row['account_num'] ?></td>
                                    <td><?= $row['sum_account_num'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                            <?php while ($expense_count < $income_count): ?>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            <?php $expense_count++;
                            endwhile; ?>
                            <tr class="black-total">
                                <td>Total</td>
                                <td><?= $amount_total_expenses ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- CHARTS -->
                <div class="table-wrapper">
                    <h2>Profit & Loss</h2>
                    <canvas id="plChart" height="200"></canvas>
                    <br><br>
                    <canvas id="pieChart" height="200"></canvas>
                </div>

            </div>
        </div>
    </div>
    <script>
        const income = <?= $amount_total_income ?>;
        const expenses = <?= $amount_total_expenses ?>;
        const profit = income - expenses;
        /* BAR CHART */
        new Chart(document.getElementById('plChart'), {
            type: 'bar',
            data: {
                labels: ['Income', 'Expenses', 'Profit / Loss'],
                datasets: [{
                    data: [income, expenses, profit],
                    backgroundColor: ['green', 'red', profit >= 0 ? 'blue' : 'orange']
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
        /* PIE CHART */
        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: ['Income', 'Expenses'],
                datasets: [{
                    data: [income, expenses],
                    backgroundColor: ['green', 'red']
                }]
            }
        });
    </script>
</body>

</html>