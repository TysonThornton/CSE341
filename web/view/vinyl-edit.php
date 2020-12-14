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

    <main class="editVinylMain">
        <div class='formcontainer'>

            <div class="formHeader">
                <h1><?php if (isset($vinylInfo['vinylalbum']) && isset($vinylInfo['vinylband'])) {
                        echo "Edit $vinylInfo[vinylalbum] by $vinylInfo[vinylband]";
                    }
                    ?></h1>
                <p>Edit the vinyl record below. All fields are required</p>
            </div>

            
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
            

            <form class='form' action="../vinyl/index.php" method="post">
                <fieldset>
                    <?php
                    if (isset($imageURL)) {
                        $image = $imageURL;
                        echo "<img src='$image'>";
                        echo '<a href="../view/change-image.php?imageURL=' . $imageURL . '&vinylId=' . $vinylId . '">Change Image</a>';
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

                    <input type='submit' name='submit' value='Save Changes' class='inputButton'>
                    <!--Add the action key - value pair -->
                    <input type="hidden" name="action" value="updateVinyl">
                    <!-- Adding a second hidden name value to store primary key -->
                    <input type="hidden" name="vinylId" value="<?php if (isset($vinylId)) {
                                                                    echo $vinylId;
                                                                } ?>">
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