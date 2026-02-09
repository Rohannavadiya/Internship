<!DOCTYPE html>
<html>
<head>
    <title>Expense Form</title>
</head>
<body>
<form action="submit/expense_insert.php" method="POST">
    Date: <input type="date" name="expense_date" required><br><br>

    Amount: <input type="number" name="amount" required><br><br>

    Category:
    <input type="text" name="category" required><br><br>

    Expense Type:
    <input type="radio" name="expense_type" value="Fixed">Fixed
    <input type="radio" name="expense_type" value="Variable">Variable
    <br><br>

    Payment Method:
    <input type="checkbox" name="payment[]" value="Cash">Cash
    <input type="checkbox" name="payment[]" value="Card">Card
    <input type="checkbox" name="payment[]" value="UPI">UPI
    <br><br>

    <input type="submit" value="Submit">

</form>

</body>
</html>