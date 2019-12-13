<?php 
include("includes/includedFiles.php");
?>

<h1 class="pageHeadingBig">You Might Also Like</h1>

<div class="gridViewContainer">


    <?php   //Here we are getting the albumns from the database
        //This variable makes a query that gets database connection from $con, and selects all rows from album table    
        $albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 10"); //Order by RAND() essentially randomizes info printed out to the page & LIMIT 10 limits to 10 albums printed

        //While Loop, loops over every result from above ^^ and fetches it into an array using "mysqli_fetch_array" into variable row
        while($row = mysqli_fetch_array($albumQuery)) {
            //Here we can print out titles of albums and print with line break using append (full stop) and <br>
            
            
            
            echo "<div class='gridViewItem'>
                    <span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
                        <img src='" . $row['artworkPath'] . "'>

                        <div class='gridViewInfo'>"
                            .$row['title'] .
                        "</div>
                    </span>
                </div>";
        }
    ?>

</div>