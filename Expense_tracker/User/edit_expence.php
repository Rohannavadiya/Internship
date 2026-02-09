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
    <title>Edit Expence</title>
    <link rel="stylesheet" href="../ins/Style.css">
    <?php
    require_once('../ins/connection.php');
    extract($_REQUEST);
    $sql = "select * from expenses where expense_id =$id";
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
        <a href="logout.php">Logout</a>
    </div>
    <div class="topbar">ITHub Software - User Panel - Hello <?php echo $_SESSION['user_name']; ?>!</div>
    <div class="content">
        <div class="box">
            <h2>Edit Expence</h2>
            <form action="../submit/update_expence.php" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Expence Date</label>
                        <input type="date" name="expence_date" value="<?= $expense_date ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Account Number</label>
                        <input type="number" name="account_num" value="<?= $account_num ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" name="amount" value="<?= $amount ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Source</label>
                        <select name="sourse">
                            <option <?php echo ($source == "Salary") ? "selected" : ""; ?>>Salary</option>
                            <option <?php echo ($source == "Freelance") ? "selected" : ""; ?>>Freelance</option>
                            <option <?php echo ($source == "Interest") ? "selected" : ""; ?>>Interest</option>
                            <option <?php echo ($source == "Business") ? "selected" : ""; ?>>Business</option>
                            <option <?php echo ($source == "Gift") ? "selected" : ""; ?>>Gift</option>
                            <option <?php echo ($source == "Bonus") ? "selected" : ""; ?>>Bonus</option>
                            <option <?php echo ($source == "Rent") ? "selected" : ""; ?>>Rent</option>
                            <option <?php echo ($source == "Other") ? "selected" : ""; ?>>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category">
                            <option <?php echo ($category == "Food") ? "selected" : ""; ?>>Food</option>
                            <option <?php echo ($category == "Transport") ? "selected" : ""; ?>>Transport</option>
                            <option <?php echo ($category == "Rent") ? "selected" : ""; ?>>Rent</option>
                            <option <?php echo ($category == "Utilities") ? "selected" : ""; ?>>Utilities</option>
                            <option <?php echo ($category == "Internet") ? "selected" : ""; ?>>Internet</option>
                            <option <?php echo ($category == "Entertainment") ? "selected" : ""; ?>>Entertainment</option>
                            <option <?php echo ($category == "Medical") ? "selected" : ""; ?>>Medical</option>
                            <option <?php echo ($category == "Shopping") ? "selected" : ""; ?>>Shopping</option>
                            <option <?php echo ($category == "Education") ? "selected" : ""; ?>>Education</option>
                            <option <?php echo ($category == "Other") ? "selected" : ""; ?>>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Payment Method</label>
                        <select name="payment_method" id="payment" onchange="toggleChequeInput()">
                            <option <?php echo ($payment_method == "Bank") ? "selected" : ""; ?>>Bank</option>
                            <option <?php echo ($payment_method == "UPI") ? "selected" : ""; ?>>UPI</option>
                            <option <?php echo ($payment_method == "Cash") ? "selected" : ""; ?>>Cash</option>
                            <option <?php echo ($payment_method == "Cheque") ? "selected" : ""; ?>>Cheque</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Expence type</label>
                        <select name="expence_type">
                            <option <?php echo ($expense_type == "Fixed") ? "selected" : ""; ?>>Fixed</option>
                            <option <?php echo ($expense_type == "Variable") ? "selected" : ""; ?>>Variable</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Paid to</label>
                        <input type="text" name="paid_to" value="<?= $paid_to ?>" required>
                    </div>
                    <div class="form-group full-width">
                        <label>Description</label>
                        <input type="text" name="description" value="<?= $description ?>">
                    </div>
                    <div class="form-group full-width" id="chequeDiv" style="display:none; margin-top:10px;">
                        <label for="cheqenum">Cheque Reference Number</label>
                        <input type="text" name="cheqenum" id="cheqenum" value="<?= $cheqe_num ?>">
                    </div>
                    <input type="hidden" name="id" value="<?= $expense_id  ?>">
                    <div class="form-group full-width">
                        <input type="submit" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    function toggleChequeInput() {
        const payment = document.getElementById("payment").value;
        const chequeDiv = document.getElementById("chequeDiv");
        const chequeNo = document.getElementById("cheqenum");
        console.log(payment);
        if (payment === "Cheque") {
            chequeDiv.style.display = "block";
            chequeNo.required = true;
            chequeNo.value = "<?= $cheqe_num ?>";
        } else {
            chequeDiv.style.display = "none";
            chequeNo.required = false;
            chequeNo.value = "";
        }
    }
    window.addEventListener('DOMContentLoaded', (event) => {
        toggleChequeInput();
    });
</script>

</html>