<?php
    $link = mysqli_connect('localhost','root','');
    mysqli_select_db($link,'cab_booking') or die (mysqli_error($link));
?>