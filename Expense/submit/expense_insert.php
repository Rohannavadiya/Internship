<?php
require_once('../ins/connection.php');
extract($_POST);
$pay = implode(',', $payment);

$sql = "INSERT INTO expenses (expense_date, amount, category, expense_type, payment_method)
        VALUES ('$expense_date', $amount, '$category', '$expense_type', '$pay')";

mysqli_query($link, $sql) or die(mysqli_error($link));
?>

<script>
    alert("Expense inserted successfully");
    window.location.href="../expense_form.php";
</script>