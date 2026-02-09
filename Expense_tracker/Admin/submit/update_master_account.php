<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once('../../ins/connection.php');
    extract($_POST);
    $sql = "UPDATE master_account SET acc_name='$acc_name',acc_group='$acc_group',opening_balance=$opening_balance,address1='$address1',address2='$address2',city='$city',pincode=$pincode,state='$state',state_code='$state_code',mobile_number=$mobile_number,phone_number=$phone_number,email='$email',bank_name='$bank_name',bank_account_number=$bank_account_number,bank_ifsc='$bank_ifsc',bank_branch='$bank_branch',registry_number='$registry_number',dl_number='$dl_number',credit_limit=$credit_limit,credit_day=$credit_day,bill_limit=$bill_limit,audit='$audit',remark='$remark' WHERE id=$id";
    mysqli_query($link, $sql) or die(mysqli_error($link));
?>
    <script>
        alert("Income Updated successfully");
        window.location.href = "../master_account_register.php";
    </script>
<?php } else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../Dashboard.php";
    </script>
<?php } ?>