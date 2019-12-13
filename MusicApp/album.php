<?php include("includes/includedFiles.php");

//uses $_GET is how we retrieve the album id number from the url and place it into var albumID
if(isset($_GET['id'])) {
    $albumId = $_GET['id'];
}
else {
    header("Location: index.php");
}

$album = new Album($con, $albumId);
$artist = $album->getArtist();
$artistId = $artist->getId();

?>

<!-- Here we call album artwork and info from database to the page by using src php echo to function we created in album class -->
<div class="entityInfo">

    <div class="leftSection">
        <img src="<?php echo $album->getArtworkPath(); ?>">
    </div>

    <div class="rightSection">
        <h2><?php echo $album->getTitle(); ?></h2>   
        <p role="link" tabindex="0" onclick="openPage('artist.php?id=$artistId')">By <?php echo $artist->getName(); ?></p>
        <p><?php echo $album->getNumberOfSongs(); ?> Songs</p>        
    </div>

</div>

<div class="trackListContainer">
    <ul class="tracklist">

        <?php
            $songIdArray = $album->getSongIds();

            $i = 1;
            foreach($songIdArray as $songId) {

                $albumSong = new Song($con, $songId);    
                $albumArtist = $albumSong->getArtist();
                
                echo "<li class='tracklistRow'>
                        <div class='trackCount'>
                            <img class='play' src='assets/images/icons/play2.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
                            <span class='trackNumber'>$i</span>
                        </div>

                        <div class='trackInfo'>   
                            <span class='trackName'>" . $albumSong->getTitle() . "</span>
                            <span class='artistMame'>" . $albumArtist->getName() . "</span>
                        </div>

                        <div class='trackOptions'>
                            <input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
                            <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
                        </div>

                        <div class='trackDuration'>
                            <span class='duration'>" . $albumSong->getDuration() . "</span>
                        </div>

                        </li>";    
                $i++;

            }
        ?>

        <script>
            var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
        </script>

    </ul>   
</div>




<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>                 
</nav>