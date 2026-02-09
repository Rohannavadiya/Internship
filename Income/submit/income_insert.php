<?php
require_once('../ins/connection.php');
extract($_POST);

$pay = implode(',', $payment);

$sql = "INSERT INTO income (income_date, amount, source, category, payment_method)
        VALUES ('$income_date', $amount, '$source', '$category', '$pay')";

mysqli_query($link, $sql) or die(mysqli_error($link));
?>

<script>
    alert("Income inserted successfully");
    window.location.href = "../income_form.php";
</script>