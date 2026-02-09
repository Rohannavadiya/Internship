<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="submit\insert.php" method="POST">
        Full name: <input type="text" name="name" id="name" required /><br><br>

        mobile number <input type="number" name="mobile" id="mobile" min=1000000000 max=9999999999 required><br><br>

        Gender <input type="radio" name="gen" id="gen" value="m">Male
        <input type="radio" name="gen" id="gen" value="f">Female <br><br>

        Hobbies <input type="checkbox" name="hob[]" id="hob[]" value="Reading_books">Reading books
        <input type="checkbox" name="hob[]" id="hob[]" value="Painting">Painting
        <input type="checkbox" name="hob[]" id="hob[]" value="Music">Music <br><br>

        Income: <input type="number" name="income" id="income" required /><br><br>
        <input type="submit" value="submit">
    </form>
</body>

</html>