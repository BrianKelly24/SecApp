<?php
    ob_start();
    session_start(); //This enables the use of SESSIONS

    $timezone = date_default_timezone_set("Europe/London");

    $con = mysqli_connect("localhost", "root", "", "musicapp",);

    if(mysqli_connect_errno()){
        echo "Failed to connect: " . mysqli_connect_errno();    
    }

?>