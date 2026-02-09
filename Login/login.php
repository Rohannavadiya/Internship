<?php
session_start();
require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = mysqli_real_escape_string($link, $_POST['id']);
    $age = mysqli_real_escape_string($link, $_POST['age']);

    $sql = "select * from login where pid='$id' and age='$age'";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['user_id'] = $id;
        header('location:welcome.php');
        exit();
    } else
        echo "User not found!";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <form action="" method="POST">
        <label for="">ID:</label>
        <input type="text" name="id" id="id" required /><br>
        <label for="">Age</label>
        <input type="password" name="age" id="age" required /><br>
        <button type="submit">Login</button>
    </form>
</body>

</html>