<div class="logo">
    <img src="../images/vinyl-record-large.png" alt="Vinyl Record Playlist Logo">
</div>

<?php 
    if (isset($_SESSION['loggedin'])) {

    echo "<div class='accountOptions'>";
    echo "<a id='profile' href='../accounts/index.php?action=Profile'>Account Profile</a>";
    echo "<a id='logout' href='../accounts/index.php?action=Logout'>Logout</a>";
    echo "</div>";

    };
?>



    