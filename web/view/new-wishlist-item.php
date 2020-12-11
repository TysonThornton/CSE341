<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="/css/small.css" type="text/css" rel="stylesheet" media="screen">
    <link href="/css/large.css" type="text/css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Vinyl Record Playlist is a website to digitally store your vinyl record collection">
    <title>Vinyl Record Playlist | Add To Your Wishlist</title>
</head>

<body>
    <header> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/header.php'; ?> </header>
    <nav> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/nav.php'; ?></nav>

    <main>
        <div class='formcontainer'>

            <div class="formHeader">
                <h1>Add a Vinyl Record to Your Wishlist</h1>
                <p>Please fill out the required information below and submit</p>
            </div>

            <div class="dbMessage">
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
            </div>

            <form class='newWlForm' action="../wishlist/index.php" method="post">
                <fieldset>
                    <label for="wlVinylBand">Artist / Band </label><br>
                    <input type='text' name="wlVinylBand" id="wlVinylBand" placeholder="required" class='input' required <?php if (isset($wlVinylBand)) {
                                                                                        echo "value='$wlVinylBand'";
                                                                                    }  ?>><br>
                    <label for="wlVinylAlbum">Album Name</label><br>
                    <input type='text' name="wlVinylAlbum" id="wlVinylAlbum" placeholder="required" class='input' required <?php if (isset($wlVinylAlbum)) {
                                                                                            echo "value='$wlVinylAlbum'";
                                                                                        }  ?>><br>
                    <label for="wlVinylPrice">Price</label><br>
                    <input type='number' name="wlVinylPrice" id="wlVinylPrice" placeholder="required" class='input' required <?php if (isset($wlVinylPrice)) {
                                                                                            echo "value='$wlVinylPrice'";
                                                                                        }  ?>><br>
                    <label for="wlVinylNotes">Notes</label><br>
                    <textarea name="wlVinylNotes" id="wlVinylNotes" class='input'><?php if (isset($wlVinylNotes)) {
                                                                                                    echo "$wlVinylNotes";
                                                                                                }  ?></textarea><br>

                    <input type='submit' name='submit' value='Add Vinyl Record' class='submitVinyl'>
                    <!--Add the action key - value pair -->
                    <input type="hidden" name="action" value="wishlistItemInsert">
                    <!-- Adding a second hidden name value to store primary key value for user -->
                    <input type="hidden" name="userId" value="<?php $sessionUserId = $_SESSION['userData']['userid'];
                                                                echo $sessionUserId;
                                                                ?>">
                </fieldset>
            </form>
        </div>


    </main>
    <footer> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/footer.php'; ?></footer>
</body>

</html>
<?php
// Unset the stored message
unset($_SESSION['message']);
?>