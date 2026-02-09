<!DOCTYPE html>
<html>

<head>
    <title>Income Form</title>
</head>

<body>

    <form action="submit/income_insert.php" method="POST">

        Date: <input type="date" name="income_date" required><br><br>

        Amount: <input type="number" name="amount" required><br><br>

        Source: <input type="text" name="source" required><br><br>

        Category:
        <input type="radio" name="category" value="Fixed">Fixed
        <input type="radio" name="category" value="Variable">Variable
        <br><br>

        Payment Method:
        <input type="checkbox" name="payment[]" value="Cash">Cash
        <input type="checkbox" name="payment[]" value="Bank">Bank
        <input type="checkbox" name="payment[]" value="UPI">UPI
        <br><br>

        <input type="submit" value="Submit">

    </form>

</body>

</html>