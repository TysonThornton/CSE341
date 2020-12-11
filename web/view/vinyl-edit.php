<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="/css/small.css" type="text/css" rel="stylesheet" media="screen">
    <link href="/css/large.css" type="text/css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="My Vinyl Shelf is a website to digitally store your vinyl record collection">
    <title>Vinyl Record Playlist | Edit Vinyl Record</title>
</head>

<body>
    <header> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/header.php'; ?> </header>
    <nav> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/nav.php'; ?></nav>

    <main>
        <div class='formcontainer'>

            <div class="formHeader">
            <h1><?php if (isset($vinylInfo['vinylalbum']) && isset($vinylInfo['vinylband'])) {
                    echo "Edit $vinylInfo[vinylalbum] by $vinylInfo[vinylband]";
                }
                ?></h1>
                <p>Edit the vinyl record below. All fields are required</p>
            </div>

            <div class="dbMessage">
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
            </div>

            <form class='newVinylForm' action="../vinyl/index.php" method="post">
                <fieldset>
                    <?php
                        if (isset($imageURL)) {
                            $image = $imageURL;
                            echo "<img src='$image'>";
                        }
                    ?>
                    <label for="vinylBand">Artist / Band </label><br>
                    <input type='text' name="vinylBand" id="vinylBand" placeholder="required" class='input' required <?php if (isset($vinylBand)) {
                                                                                        echo "value='$vinylBand'";
                                                                                    }  ?>><br>
                    <label for="vinylAlbum">Album Name</label><br>
                    <input type='text' name="vinylAlbum" id="vinylAlbum" placeholder="required" class='input' required <?php if (isset($vinylAlbum)) {
                                                                                            echo "value='$vinylAlbum'";
                                                                                        }  ?>><br>
                    <label for="vinylYear">Released Year</label><br>
                    <input type='number' name="vinylYear" id="vinylYear" placeholder="required" class='input' required <?php if (isset($vinylYear)) {
                                                                                            echo "value='$vinylYear'";
                                                                                        }  ?>><br>
                    <label for="vinylCondition">Vinyl Condition</label><br>
                    <input type='text' name="vinylCondition" id="vinylCondition" placeholder="required" class='input' required <?php if (isset($vinylCondition)) {
                                                                                            echo "value='$vinylCondition'";
                                                                                        }  ?>><br>
                    <label for="vinylGenre">Genre</label><br>
                    <input type='text' name="vinylGenre" id="vinylGenre" placeholder="required" class='input' required <?php if (isset($vinylGenre)) {
                                                                                    echo "value='$vinylGenre'";
                                                                                }  ?>><br>
                    <label for="vinylImage">Image</label><br>
                    <input type="text" name="vinylImage" id="vinylImage" class='input' <?php if (isset($vinylImage)) {
                                                                                            echo "value='$vinylImage'";
                                                                                        }  ?>><br>

                    <input type='submit' name='submit' value='Save Vinyl Record Changes' class='submitVinyl'>
                    <!--Add the action key - value pair -->
                    <input type="hidden" name="action" value="updateVinyl">
                    <!-- Adding a second hidden name value to store primary key -->
                    <input type="hidden" name="vinylId" value="<?php if (isset($vinylId)) {
                                                                    echo $vinylId;
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