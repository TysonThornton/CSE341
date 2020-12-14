<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="/css/small.css" type="text/css" rel="stylesheet" media="screen">
    <link href="/css/large.css" type="text/css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Vinyl Record Playlist is a website to digitally store your vinyl record collection">
    <title>Vinyl Record Playlist | Edit Wishlist Item</title>
</head>

<body>
    <header> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/header.php'; ?> </header>
    <nav> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/nav.php'; ?></nav>

    <main class="editWishlist">
        <div class='formcontainer'>

            <div class="formHeader">
            <h1><?php if (isset($wlVinylAlbum) && isset($wlVinylBand)) {
                    echo "Edit $wlVinylAlbum by $wlVinylBand";
                }
                ?></h1>
                <p>Edit the wishlist item below.</p>
            </div>

            
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
            

            <form class='form' action="../wishlist/index.php" method="post">
                <fieldset>
                <label for="wlVinylBand">Artist / Band </label>
                    <input type='text' name="wlVinylBand" id="wlVinylBand" placeholder="required" class='input' required <?php if (isset($wlVinylBand)) {
                                                                                        echo "value='$wlVinylBand'";
                                                                                    }  ?>>
                    <label for="wlVinylAlbum">Album Name</label>
                    <input type='text' name="wlVinylAlbum" id="wlVinylAlbum" placeholder="required" class='input' required <?php if (isset($wlVinylAlbum)) {
                                                                                            echo "value='$wlVinylAlbum'";
                                                                                        }  ?>>
                    <label for="wlVinylPrice">Price</label>
                    <input type='number' name="wlVinylPrice" id="wlVinylPrice" placeholder="required" class='input' required <?php if (isset($wlVinylPrice)) {
                                                                                            echo "value='$wlVinylPrice'";
                                                                                        }  ?>>
                    <label for="wlVinylNotes">Notes</label>
                    <textarea name="wlVinylNotes" id="wlVinylNotes" class='input'><?php if (isset($wlVinylNotes)) {
                                                                                                    echo "$wlVinylNotes";
                                                                                                }  ?></textarea>

                    <input type='submit' name='submit' value='Save Changes' class='inputButton'>
                    <!--Add the action key - value pair -->
                    <input type="hidden" name="action" value="updateWlItem">
                    <!-- Adding a second hidden name value to store primary key -->
                    <input type="hidden" name="wishlistId" value="<?php if (isset($wishlistId)) {
                                                                    echo $wishlistId;
                                                                } ?>">
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