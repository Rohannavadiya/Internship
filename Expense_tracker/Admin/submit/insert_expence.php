<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once('../../ins/connection.php');
    extract($_POST);
    $sql = "INSERT INTO expenses(expense_date,account_num,amount,source,category,payment_method,paid_to,expense_type,description,cheqe_num) VALUES ('$expence_date',$account_num,$amount,'$sourse','$category','$payment_method','$paid_to','$expence_type','$description','$cheqenum')";
    mysqli_query($link, $sql) or die(mysqli_error($link));
?>
    <script>
        alert("Income inserted successfully");
        window.location.href = "../expence_register.php";
    </script>
<?php } else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../Dashboard.php";
    </script>
<?php } ?>