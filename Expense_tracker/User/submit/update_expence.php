<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once('../../ins/connection.php');
    extract($_POST);
    $sql = "UPDATE expenses SET expense_date='$expence_date',account_num=$account_num,amount=$amount,source='$sourse',category='$category',payment_method='$payment_method',paid_to='$paid_to',expense_type='$expence_type',description='$description',cheqe_num='$cheqenum' WHERE expense_id=$id";
    mysqli_query($link, $sql) or die(mysqli_error($link));
?>
    <script>
        alert("Expence Updated successfully");
        window.location.href = "../expence_register.php";
    </script>
<?php } else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../Dashboard.php";
    </script>
<?php } ?>