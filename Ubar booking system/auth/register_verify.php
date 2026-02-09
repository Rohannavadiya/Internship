<?php
session_start();
require_once('../Config/db.php'); // DB connection

/* ================= GET FORM DATA ================= */
$role    = $_POST['role'];          // user | driver
$fname   = trim($_POST['fname']);
$mail    = trim($_POST['mail']);
$mobile  = trim($_POST['mobile']);
$pass    = $_POST['pass'];
$cpass   = $_POST['cpass'];

/* ================= BASIC VALIDATION ================= */
if ($pass !== $cpass) {
    echo "<script>alert('Passwords do not match');window.location='register.php';</script>";
    exit;
}

/* Hash password */
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

/* ================= USER REGISTRATION ================= */
if ($role === 'user') {

    // Check duplicate email
    $check = mysqli_query($link, "SELECT id FROM users WHERE email='$mail'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Email already registered');window.location='register.php';</script>";
        exit;
    }

    // Insert into users table
    $sql = "INSERT INTO users 
            (full_name, email, mobile, password, status) 
            VALUES 
            ('$fname', '$mail', '$mobile', '$hashed_password', 'active')";

    if (mysqli_query($link, $sql)) {

        echo "<script>alert('User registration successfully');window.location='login.php';</script>";
        exit;

    } else {
        echo "<script>alert('User registration failed');window.location='register.php';</script>";
        exit;
    }
}

/* ================= DRIVER REGISTRATION ================= */
elseif ($role === 'driver') {

    $license = trim($_POST['license']);
    $vehicle = trim($_POST['vehicle_type']);

    if ($license === '' || $vehicle === '') {
        echo "<script>alert('License number and vehicle type are required');window.location='register.php?role=driver';</script>";
        exit;
    }

    // Check duplicate email
    $check = mysqli_query($link, "SELECT id FROM drivers WHERE email='$mail'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Email already registered as driver');window.location='register.php?role=driver';</script>";
        exit;
    }

    // Insert into drivers table (pending approval)
    $sql = "INSERT INTO drivers 
            (full_name, email, mobile, password, license_number, vehicle_type, availability, status)
            VALUES 
            ('$fname', '$mail', '$mobile', '$hashed_password', '$license', '$vehicle', 'offline', 'pending')";

    if (mysqli_query($link, $sql)) {

        echo "<script>alert('Driver registration successfully');window.location='login.php';</script>";
        exit;

    } else {
        echo "<script>alert('Driver registration failed');window.location='register.php?role=driver';</script>";
        exit;
    }
}

/* ================= INVALID ROLE ================= */
else {
    echo "<script>alert('Invalid registration attempt');window.location='register.php';</script>";
    exit;
}
?>
