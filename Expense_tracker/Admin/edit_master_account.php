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
    <title>Edit master account</title>
    <link rel="stylesheet" href="../ins/Style.css">
    <?php
    require_once('../ins/connection.php');
    extract($_REQUEST);
    $sql = "select * from master_account where id=$id";
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
        <div class="box">
            <h2>Edit Master Account</h2>
            <form action="submit/update_master_account.php" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Account name</label>
                        <input type="text" name="acc_name" value="<?= $acc_name ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Account group</label>
                        <select name="acc_group">
                            <option <?php echo ($acc_group == "Income") ? "selected" : ""; ?>>Income</option>
                            <option <?php echo ($acc_group == "Expense") ? "selected" : ""; ?>>Expense</option>
                            <option <?php echo ($acc_group == "Asset") ? "selected" : ""; ?>>Asset</option>
                            <option <?php echo ($acc_group == "Liability") ? "selected" : ""; ?>>Liability</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Opening balance</label>
                        <input type="number" name="opening_balance" value="<?= $opening_balance ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="mail" name="email" value="<?= $email ?>" required>
                    </div>
                    <div class="form-group full-width">
                        <label>Address1</label>
                        <input type="text" name="address1" value="<?= $address1 ?>" required>
                    </div>
                    <div class="form-group full-width">
                        <label>address2</label>
                        <input type="text" name="address2" value="<?= $address2 ?>" required>
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" name="state" value="<?= $state ?>" required>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" value="<?= $city ?>" required>
                    </div>
                    <div class="form-group">
                        <label>State code</label>
                        <input type="text" name="state_code" value="<?= $state_code ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Pincode</label>
                        <input type="number" name="pincode" value="<?= $pincode ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Mobile number</label>
                        <input type="number" name="mobile_number" value="<?= $mobile_number ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Phone number</label>
                        <input type="number" name="phone_number" value="<?= $phone_number ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Bank name</label>
                        <input type="text" name="bank_name" value="<?= $bank_name ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Bank account number</label>
                        <input type="number" name="bank_account_number" value="<?= $bank_account_number ?>" required>
                    </div>
                    <div class="form-group">
                        <label>IFSC code</label>
                        <input type="text" name="bank_ifsc" value="<?= $bank_ifsc ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Bank branch</label>
                        <input type="text" name="bank_branch" value="<?= $bank_branch ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Registry number</label>
                        <input type="text" name="registry_number" value="<?= $registry_number ?>" required>
                    </div>
                    <div class="form-group">
                        <label>DL number</label>
                        <input type="text" name="dl_number" value="<?= $dl_number ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Credit limit</label>
                        <input type="number" name="credit_limit" value="<?= $credit_limit ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Credit day</label>
                        <input type="number" name="credit_day" value="<?= $credit_day ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Bill limit</label>
                        <input type="number" name="bill_limit" value="<?= $bill_limit ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Audit</label>
                        <select name="audit">
                            <option <?php echo ($audit == "Yes") ? "selected" : ""; ?>>Yes</option>
                            <option <?php echo ($audit == "No") ? "selected" : ""; ?>>No</option>
                        </select>
                    </div>
                    <div class="form-group full-width">
                        <label>Remark</label>
                        <input type="text" name="remark" value="<?= $remark ?>" required>
                    </div>
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-group full-width">
                        <input type="submit" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>