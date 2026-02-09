<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once('../../ins/connection.php');
    extract($_POST);
    var_dump($_POST);
    $sql = "INSERT INTO master_account(acc_name,acc_group,opening_balance,address1,address2,city,pincode,state,state_code,mobile_number,phone_number,email,bank_name,bank_account_number,bank_ifsc,bank_branch,registry_number,dl_number,credit_limit,credit_day,bill_limit,audit,remark) VALUES ('$acc_name','$acc_group',$opening_balance,'$address1','$address2','$city',$pincode,'$state','$state_code',$mobile_number,$phone_number,'$email','$bank_name',$bank_account_number,'$bank_ifsc','$bank_branch','$registry_number','$dl_number',$credit_limit,$credit_day,$bill_limit,'$audit','$remark')";
    mysqli_query($link, $sql) or die(mysqli_error($link));
?>
    <script>
        alert("Income inserted successfully");
        window.location.href = "../master_account_register.php";
    </script>
<?php } else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../Dashboard.php";
    </script>
<?php } ?>