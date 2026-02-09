<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="GET">
        <input type="text" name="search" id="search" placeholder="Search by Name, Age, Email">
        <input type="submit" value="submit">
    </form>
    <table width='100%'>
        <tr bgcolor="#CCCCCC">
            <td>Name</td>
            <td>Age</td>
            <td>Email</td>
        </tr>
        <?php
        require_once('connection.php');
        $search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) : '';
        $result = mysqli_query($link, "select * from login where name like '%$search%' or age like '%$search%' or email like '%$search%'");
        while ($res = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $res['name'] . "</td>";
            echo "<td>" . $res['age'] . "</td>";
            echo "<td>" . $res['email'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>