<?php include("includes/includedFiles.php");

//uses $_GET is how we retrieve the album id number from the url and place it into var albumID
if(isset($_GET['id'])) {
    $playlistId = $_GET['id'];
}
else {
    header("Location: index.php");
}

$playlist = new Playlist($con, $playlistId);
$owner = new User($con, $playlist->getOwner());
?>

<!-- Here we call album artwork and info from database to the page by using src php echo to function we created in album class -->
<div class="entityInfo">

    <div class="leftSection">
        <div class="playlistImage">
            <img src="assets/images/icons/playlist.png">
        </div>
        
    </div>

    <div class="rightSection">
        <h2><?php echo $playlist->getName(); ?></h2>   
        <p>By <?php echo $playlist->getOwner(); ?></p>
        <p><?php echo $playlist->getNumberOfSongs(); ?> Songs</p>     
        <button class="button" onclick="deletePlaylist('<?php echo $playlistId; ?>')">DELETE PLAYLIST</button>  
        
    </div>

</div>

<div class="trackListContainer">
    <ul class="tracklist">

        <?php
            $songIdArray = $playlist->getSongIds();

            $i = 1;
            foreach($songIdArray as $songId) {

                $playlistsong = new Song($con, $songId);    
                $songArtist = $playlistsong->getArtist();
                
                echo "<li class='tracklistRow'>
                        <div class='trackCount'>
                            <img class='play' src='assets/images/icons/play2.png' onclick='setTrack(\"" . $playlistsong->getId() . "\", tempPlaylist, true)'>
                            <span class='trackNumber'>$i</span>
                        </div>

                        <div class='trackInfo'>   
                            <span class='trackName'>" . $playlistsong->getTitle() . "</span>
                            <span class='artistMame'>" . $songArtist->getName() . "</span>
                        </div>

                        <div class='trackOptions'>
                            <input type='hidden' class='songId' value='" . $playlistsong->getId() . "'>
                            <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
                        </div>

                        <div class='trackDuration'>
                            <span class='duration'>" . $playlistsong->getDuration() . "</span>
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
    <div class="item" onclick="removeFromPlaylist(this, '<?php echo $playlistId; ?>')">Remove from Playlist</div>        
</nav>


