<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="/css/small.css" type="text/css" rel="stylesheet" media="screen">
    <link href="/css/large.css" type="text/css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Vinyl Record Playlist is a website to digitally store your vinyl record collection">
    <title>Vinyl Record Playlist | Add Wishlist Item to Vinyl Collection</title>
</head>

<body>
    <header> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/header.php'; ?> </header>
    <nav> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/nav.php'; ?></nav>

    <main class="wlToCollection">
        <div class='formcontainer'>

            <div class="formHeader">
                <h1><?php if (isset($wlVinylAlbum) && isset($wlVinylBand)) {
                        echo "Add $wlVinylAlbum by $wlVinylBand to your Vinyl Collection";
                    }
                    ?></h1>
                <p>Please fill out the remaining vinyl record fields below and submit.</p>
            </div>

           
                <?php
                if (isset($message)) {
                    echo $message;
                }
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
                ?>
           

            <h2>Wishlist Item Details</h2>
            <form class='form'>
                <fieldset>
                    <label for="wlVinylBand">Artist / Band </label>
                    <input type='text' name="wlVinylBand" id="wlVinylBand" class='input' readonly <?php if (isset($wlVinylBand)) {
                                                                                                        echo "value='$wlVinylBand'";
                                                                                                    }  ?>>
                    <label for="wlVinylAlbum">Album Name</label>
                    <input type='text' name="wlVinylAlbum" id="wlVinylAlbum" class='input' readonly <?php if (isset($wlVinylAlbum)) {
                                                                                                        echo "value='$wlVinylAlbum'";
                                                                                                    }  ?>>
                    <label for="wlVinylPrice">Price</label>
                    <input type='number' name="wlVinylPrice" id="wlVinylPrice" class='input' readonly <?php if (isset($wlVinylPrice)) {
                                                                                                            echo "value='$wlVinylPrice'";
                                                                                                        }  ?>>
                    <label for="wlVinylNotes">Notes</label>
                    <textarea name="wlVinylNotes" id="wlVinylNotes" class='input' readonly><?php if (isset($wlVinylNotes)) {
                                                                                                echo "$wlVinylNotes";
                                                                                            }  ?></textarea>
                </fieldset>
            </form>


            <h2>Information to be Added to Vinyl Collection</h2>
            <form class='form' action="../wishlist/index.php" method="post">
                <fieldset>
                    <?php
                    if (isset($imageURL)) {
                        echo '<div><img src="'
                            . $imageURL .
                            '" alt="vinyl record image"></div><br>';
                    } else {
                        echo '<a href="../view/image-from-wishlist.php">Add an Image</a><br>';
                    }

                    ?>
                    <label for="vinylBand">Artist / Band </label>
                    <input type='text' name="vinylBand" id="vinylBand" placeholder="required" class='input' required <?php if (isset($vinylBand)) {
                                                                                                                            echo "value='$vinylBand'";
                                                                                                                        }  ?>>
                    <label for="vinylAlbum">Album Name</label>
                    <input type='text' name="vinylAlbum" id="vinylAlbum" placeholder="required" class='input' required <?php if (isset($vinylAlbum)) {
                                                                                                                            echo "value='$vinylAlbum'";
                                                                                                                        }  ?>>
                    <label for="vinylYear">Released Year</label>
                    <input type='number' name="vinylYear" id="vinylYear" placeholder="required" class='input' required <?php if (isset($vinylYear)) {
                                                                                                                            echo "value='$vinylYear'";
                                                                                                                        }  ?>>
                    <label for="vinylCondition">Vinyl Condition</label>
                    <input type='text' name="vinylCondition" id="vinylCondition" placeholder="required" class='input' required <?php if (isset($vinylCondition)) {
                                                                                                                                    echo "value='$vinylCondition'";
                                                                                                                                }  ?>>
                    <label for="vinylGenre">Genre</label>
                    <input type='text' name="vinylGenre" id="vinylGenre" placeholder="required" class='input' required <?php if (isset($vinylGenre)) {
                                                                                                                            echo "value='$vinylGenre'";
                                                                                                                        }  ?>>

                    <input type='submit' name='submit' value='Add Vinyl Record' class='inputButton'>
                    <!--Add the action key - value pair -->
                    <input type="hidden" name="action" value="insertWlToCollection">
                    <!-- Adding a second hidden name value to store primary key value for user -->
                    <input type="hidden" name="userId" value="<?php $sessionUserId = $_SESSION['userData']['userid'];
                                                                echo $sessionUserId;
                                                                ?>">
                    <input type="hidden" name="wishlistId" value="<?php if (isset($wishlistId)) {
                                                                        echo $wishlistId;
                                                                    }
                                                                    ?>">
                    <!-- Adding a third hidden name value to store image url -->
                    <input type="hidden" name="imageURL" value="<?php if (isset($imageURL)) {
                                                                    echo $imageURL;
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