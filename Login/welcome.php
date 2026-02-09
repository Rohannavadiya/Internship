<?php
session_start();
if (isset($_SESSION['user_id'])) {
    echo "Welcome, User!<br>";
    echo "You are successfully logged in.<br>";
    echo "<a href='logout.php'>Logout</a>";
} else
    header('location:login.php');
