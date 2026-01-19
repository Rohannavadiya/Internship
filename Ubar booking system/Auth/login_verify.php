<?php
session_start();
require_once('../config/db.php');

/* Get form data safely */
$mail = $_POST['mail'];
$pass = $_POST['pass'];
$selected_role = $_POST['role']; // user OR driver

/* ================= USER LOGIN ================= */
if ($selected_role === 'user') {

    $sql = "SELECT full_name, password 
            FROM users 
            WHERE email = '$mail'";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($pass, $row['password'])) {

            $_SESSION['user_type'] = 'user';
            $_SESSION['user_name'] = $row['full_name'];

            header("Location: ../User/dashboard.php");
            exit;
        } else {
            echo "<script>alert('Invalid password');window.location='login.php';</script>";
        }
    } else {
        echo "<script>alert('User not found');window.location='login.php';</script>";
    }
}

/* ================= DRIVER LOGIN ================= */ elseif ($selected_role === 'driver') {

    $sql = "SELECT full_name, password 
            FROM drivers 
            WHERE email = '$mail'";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($pass, $row['password'])) {

            $_SESSION['user_type'] = 'driver';
            $_SESSION['user_name'] = $row['full_name'];

            header("Location: ../Driver/dashboard.php");
            exit;
        } else {
            echo "<script>alert('Invalid password');
            window.location='login.php';
            </script>";
        }
    } else {
        echo "<script>alert('Driver not found');window.location='login.php';</script>";
    }
}

/* ================= INVALID ROLE ================= */ else {
    echo "<script>alert('Invalid login attempt');window.location='login.php';</script>";
}
