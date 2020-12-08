<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="/css/small.css" type="text/css" rel="stylesheet" media="screen">
    <link href="/css/large.css" type="text/css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="My Vinyl Shelf is a website to digitally store your vinyl record collection">
    <title>Vinyl Record Playlist | Remove Vinyl Record</title>
</head>

<body>
    <header> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/header.php'; ?> </header>
    <nav> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/nav.php'; ?></nav>

    <main>
        <main>
            <h1><?php if (isset($_SESSION['vinylInfo']['vinylalbum'])) {
                    echo "Delete $_SESSION[vinylInfo][vinylalbum]";
                }
                ?></h1>
            <p>Please confirm deletion of vinyl record from your collection.</p>
            </div>
            <?php
            if (isset($message)) {
                echo $message;
            }
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            echo $vinylInfo;
            ?>

            <form action="../vinyl/index.php" method="post">
                <fieldset>
                    <label for="vinylAlbum">Album: </label>
                    <input type='text' name="vinylAlbum" id="vinylAlbum" class='input' readonly <?php if (isset($vinylInfo['vinylalbum'])) {
                                                                                                echo "value='$vinylInfo[vinylalbum]'";
                                                                                            }
                                                                                            ?>><br>
                    <label for="vinylBand">Band / Artist: </label>
                    <input type='text' name="vinylBand" id="vinylBand" class='input' readonly <?php if (isset($vinylInfo['vinylband'])) {
                                                                                                    echo "value='$vinylInfo[vinylband]'";
                                                                                                }  ?>><br>

                    <input type='submit' name='submit' value='Delete Vinyl'>
                    <!--Add the action key - value pair -->
                    <input type="hidden" name="action" value="deleteVinylConfirmed">
                    <!-- Adding a second hidden name value to store primary key value for the product being updated on this page -->
                    <input type="hidden" name="vinylId" value="<?php if (isset($vinylInfo['vinylid'])) {
                                                                    echo $prodInfo['vinylid'];
                                                                } ?>">
                </fieldset>
            </form>


        </main>
        <footer> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/footer.php'; ?></footer>
</body>

</html>
<?php
// Unset the stored message
unset($_SESSION['message']);
?>