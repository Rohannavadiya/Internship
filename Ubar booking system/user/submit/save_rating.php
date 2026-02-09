<?php
session_start();
include("../../config/db.php"); // adjust if needed

if(!isset($_SESSION['user_id'])) exit;

$user_id    = $_SESSION['user_id'];
$booking_id = intval($_POST['booking_id']);
$driver_id  = intval($_POST['driver_id']);
$rating     = intval($_POST['rating']);

if($rating < 1 || $rating > 5) exit;

$check = mysqli_query($link,
    "SELECT id FROM ratings WHERE booking_id='$booking_id'"
);

if(mysqli_num_rows($check) == 0){
    mysqli_query($link,"
        INSERT INTO ratings (booking_id,user_id,driver_id,rating)
        VALUES ('$booking_id','$user_id','$driver_id','$rating')
    ");
}else{
    mysqli_query($link,"
        UPDATE ratings 
        SET rating='$rating'
        WHERE booking_id='$booking_id' AND user_id='$user_id'
    ");
}
