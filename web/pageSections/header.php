<div>
    
    <?php 
    if (isset($_SESSION['loggedin'])) {

        echo "<a id='profile' href='../accounts/index.php?action=Profile'>Account Profile</a><br>";
        echo "<a id='logout' href='../accounts/index.php?action=Logout'>Logout</a>";

         };
    ?>
    <h1>Vinyl Record Playlist</h1>
    
</div>