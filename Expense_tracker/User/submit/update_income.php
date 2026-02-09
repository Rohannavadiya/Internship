<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once('../../ins/connection.php');
    extract($_POST);
    $sql = "UPDATE income SET income_date='$income_date',account_num=$account_num,amount=$amount,source='$sourse',category='$category',payment_method='$payment_method',received_from='$receive_from',description='$description',cheqe_num='$cheqenum' WHERE income_id=$id";
    mysqli_query($link, $sql) or die(mysqli_error($link));
?>
    <script>
        alert("Income Updated successfully");
        window.location.href = "../income_register.php";
    </script>
<?php } else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../Dashboard.php";
    </script>
<?php } ?>