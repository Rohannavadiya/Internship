<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    require_once('ins/connection.php');
    $sql = "select * from inter";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    ?>
</head>

<body>
    <table border="1" align="center">
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Mobile</td>
            <td>Gender</td>
            <td>Hobbies</td>
            <td>Income</td>
            <td>Updete</td>
            <td>Delete</td>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            extract($row);
        ?>
            <tr>
                <td><?= $id; ?></td>
                <td><?= $name; ?></td>
                <td><?= $mobile; ?></td>
                <td><?= $gender; ?></td>
                <td><?= $hobbies ?></td>
                <td><?= $income; ?></td>
                <td><a href="update.php?fid=<?= $id; ?>">Update</a></td>
                <td><a href="submit/delete.php?fid=<?= $id; ?>">Delete</a></td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>