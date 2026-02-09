<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    require_once('ins/connection.php');
    extract($_REQUEST);
    $sql = "select * from inter where id=$fid";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    extract($row);
    $ho = explode(',', $hobbies);
    ?>
</head>

<body>
    <form action="submit\edit.php" method="POST">
        Full name: <input type="text" name="name" id="name" value="<?= $name; ?>" required /><br><br>

        mobile number <input type="number" name="mobile" id="mobile" value="<?= $mobile; ?>" min=1000000000 max=9999999999 required><br><br>

        Gender <input type="radio" name="gen" id="gen" value="m" <?php if ($gender == "m") echo "checked"; ?>>Male
        <input type="radio" name="gen" id="gen" value="f" <?php if ($gender == "f") echo "checked"; ?>>Female <br><br>

        Hobbies <input type="checkbox" name="hob[]" id="hob[]" value="Reading_books" <?php if (in_array('Reading_books', $ho)) echo "checked"; ?>>Reading books
        <input type="checkbox" name="hob[]" id="hob[]" value="Painting" <?php if (in_array('Painting', $ho)) echo "checked"; ?>>Painting
        <input type="checkbox" name="hob[]" id="hob[]" value="Music" <?php if (in_array('Music', $ho)) echo "checked"; ?>>Music <br><br>

        Income: <input type="number" name="income" id="income" value="<?= $income; ?>" required /><br><br>

        <input type="hidden" name="hid" value="<?= $id; ?>">
        <input type="submit" value="submit">
    </form>
</body>

</html>