<?php
//including config file allows this page to read the SESSION start so we can use SESSION variables used in Logged In
include("includes/config.php");
include("includes/classes/User.php");
include("includes/classes/Artist.php");
include("includes/classes/Album.php");
include("includes/classes/Song.php");
include("includes/classes/Playlist.php");

//session_destroy(); 

//This checks to see if the user is logged in, if not the user will be kicked off the index page
if(isset($_SESSION['userLoggedIn'])){
    $userLoggedIn = new User($con, $_SESSION['userLoggedIn']); 
    $username = $userLoggedIn->getUsername();    
    echo "<script>userLoggedIn = '$username';</script>";    
}
else{
    header("Location: register.php"); //Redirects user to register page
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music App</title>

    <link rel="stylesheet" type="text/css" href="assets/css/style.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>
<body>

    
    <div id="mainContainer">

        <div id="topContainer">

            <?php include("includes/navBarContainer.php"); ?>  
            
            <div id="mainViewContainer">
                
                <div id="mainContent">