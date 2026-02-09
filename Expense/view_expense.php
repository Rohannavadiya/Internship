<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Expenses</title>
    <?php
        require_once('ins/connection.php');
        $sql = "SELECT * FROM expenses";
        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    ?>
</head>

<body>

<table border="1" align="center">
    <tr>
        <td>ID</td>
        <td>Date</td>
        <td>Amount</td>
        <td>Category</td>
        <td>Expense Type</td>
        <td>Payment Method</td>
        <td>Update</td>
        <td>Delete</td>
    </tr>

    <?php
        while ($row = mysqli_fetch_assoc($result)) {
            extract($row);
    ?>
    <tr>
        <td><?= $expense_id; ?></td>
        <td><?= $expense_date; ?></td>
        <td><?= $amount; ?></td>
        <td><?= $category; ?></td>
        <td><?= $expense_type; ?></td>
        <td><?= $payment_method; ?></td>
        <td><a href="expense_update.php?fid=<?= $expense_id; ?>">Update</a></td>
        <td><a href="submit/expense_delete.php?fid=<?= $expense_id; ?>">Delete</a></td>
    </tr>
    <?php } ?>

</table>

</body>
</html>