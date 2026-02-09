<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Income</title>

    <?php
    require_once('ins/connection.php');
    $sql = "SELECT * FROM income";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    ?>
</head>

<body>

    <table border="1" align="center">
        <tr>
            <td>ID</td>
            <td>Date</td>
            <td>Amount</td>
            <td>Source</td>
            <td>Category</td>
            <td>Payment Method</td>
            <td>Update</td>
            <td>Delete</td>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            extract($row);
        ?>
            <tr>
                <td><?= $income_id; ?></td>
                <td><?= $income_date; ?></td>
                <td><?= $amount; ?></td>
                <td><?= $source; ?></td>
                <td><?= $category; ?></td>
                <td><?= $payment_method; ?></td>
                <td><a href="income_update.php?fid=<?= $income_id; ?>">Update</a></td>
                <td><a href="submit/income_delete.php?fid=<?= $income_id; ?>">Delete</a></td>
            </tr>
        <?php } ?>

    </table>

</body>

</html>