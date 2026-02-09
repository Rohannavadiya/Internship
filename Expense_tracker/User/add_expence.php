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
    <title>Add Expence</title>
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
            <h2>Add Expence</h2>
            <form action="../submit/insert_expence.php" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Expence Date</label>
                        <input type="date" name="expence_date" required>
                    </div>
                    <div class="form-group">
                        <label>Account Number</label>
                        <input type="number" name="account_num" required>
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label>Source</label>
                        <select name="sourse">
                            <option>Salary</option>
                            <option>Freelance</option>
                            <option>Interest</option>
                            <option>Business</option>
                            <option>Gift</option>
                            <option>Bonus</option>
                            <option>Rent</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category">
                            <option>Food</option>
                            <option>Transport</option>
                            <option>Rent</option>
                            <option>Utilities</option>
                            <option>Internet</option>
                            <option>Entertainment</option>
                            <option>Medical</option>
                            <option>Shopping</option>
                            <option>Education</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Payment Method</label>
                        <select name="payment_method" id="payment" onchange="toggleChequeInput()">
                            <option>Bank</option>
                            <option>UPI</option>
                            <option>Cash</option>
                            <option>Cheque</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Expence type</label>
                        <select name="expence_type">
                            <option>Fixed</option>
                            <option>Variable</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Paid to</label>
                        <input type="text" name="paid_to" required>
                    </div>
                    <div class="form-group full-width" id="chequeDiv" style="display:none; margin-top:10px;">
                        <label for="cheqenum">Cheque Reference Number</label>
                        <input type="text" name="cheqenum" id="cheqenum">
                    </div>
                    <div class="form-group full-width">
                        <label>Description</label>
                        <input type="text" name="description">
                    </div>
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
        } else {
            chequeDiv.style.display = "none";
            chequeNo.required = false;
            chequeNo.value = "";
        }
    }
</script>

</html>