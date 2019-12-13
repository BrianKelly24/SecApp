<?php
include("../../config.php");

//add number of plays of a song 
if(isset($_POST['songId'])) {
    $songId = $_POST['songId'];

    $query = mysqli_query($con, "UPDATE songs SET plays = plays + 1 WHERE id='songId'");


}

?>