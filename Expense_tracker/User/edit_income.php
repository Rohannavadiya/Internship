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
    <title>Edit Income</title>
    <link rel="stylesheet" href="../ins/Style.css">
    <?php
    require_once('../ins/connection.php');
    extract($_REQUEST);
    $sql = "select * from income where income_id=$id";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    extract($row);
    ?>
</head>

<body>
    <div class="sidebar">
        <h2>Edit Income</h2>
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
            <h2>Edit Income</h2>
            <form action="submit/update_income.php" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Income Date</label>
                        <input type="date" name="income_date" value="<?= $income_date ?>" required>
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
                            <option <?php echo ($category == "Fixed") ? "selected" : ""; ?>>Fixed</option>
                            <option <?php echo ($category == "Variable") ? "selected" : ""; ?>>Variable</option>
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
                        <label>Receive From</label>
                        <input type="text" name="receive_from" value="<?= $received_from ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="description" value="<?= $description ?>">
                    </div>
                    <div class="form-group full-width" id="chequeDiv" style="display:none; margin-top:10px;">
                        <label for="cheqenum">Cheque Reference Number</label>
                        <input type="text" name="cheqenum" id="cheqenum" value="<?= $cheqe_num ?>">
                    </div>
                    <input type="hidden" name="id" value="<?= $income_id ?>">
                    <div class="form-group full-width">
                        <input type="submit" value="Submit">
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