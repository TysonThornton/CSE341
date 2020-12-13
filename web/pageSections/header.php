<?php 
    if (isset($_SESSION['loggedin'])) {

    echo "<a id='profile' href='../accounts/index.php?action=Profile'>Account Profile</a><br>";
    echo "<a id='logout' href='../accounts/index.php?action=Logout'>Logout</a>";

    };
?>


<div class="logo">
    <img src="../images/vinyl-record-large.png" alt="Vinyl Record Playlist Logo">
</div>
    