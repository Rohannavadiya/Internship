<<?php
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        require_once('../../ins/connection.php');
        extract($_POST);
        $sql = "INSERT INTO income(income_date,account_num,amount,source,category, payment_method, received_from,description,cheqe_num) VALUES ('$income_date',$account_num,$amount,'$sourse','$category','$payment_method','$receive_from','$description','$cheqenum')";
        mysqli_query($link, $sql) or die(mysqli_error($link));
    ?>
    <script>
    alert("Income inserted successfully");
    window.location.href = "../income_register.php";
    </script>
<?php } else {
?>
    <script>
        alert("Direct file not open!");
        window.location.href = "../Dashboard.php";
    </script>
<?php } ?>