<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="/css/small.css" type="text/css" rel="stylesheet" media="screen">
    <link href="/css/large.css" type="text/css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Vinyl Record Playlist is a website to digitally store your vinyl record collection">
    <title>Vinyl Record Playlist | Add A Vinyl Record</title>
</head>

<body>
    <header> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/header.php'; ?> </header>
    <nav> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/nav.php'; ?></nav>

    <main>
        <div class='formcontainer'>

            <div class="formHeader">
                <h1>Add a Vinyl Record to your Collection</h1>
                <p>Please fill out all the information below and submit</p>
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
                    <!-- <label for="vinylImage">Image</label><br>
                    <input type="text" name="vinylImage" id="vinylImage" class='input' <?php if (isset($vinylImage)) {
                                                                                            echo "value='$vinylImage'";
                                                                                        }  ?>><br> -->



                    <?php
                    require('../vendor/autoload.php');
                    // this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
                    $s3 = new Aws\S3\S3Client([
                        'version'  => '2006-03-01',
                        'region'   => 'us-west-2',
                    ]);
                    $bucket = getenv('S3_BUCKET') ?: die('No "S3_BUCKET" config var in found in env!');
                    ?>

                    <h1>S3 upload example</h1>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
                        // FIXME: you should add more of your own validation here, e.g. using ext/fileinfo
                        try {
                            // FIXME: you should not use 'name' for the upload, since that's the original filename from the user's computer - generate a random filename that you then store in your database, or similar
                            $upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
                    ?>
                            <p>Upload <a href="<?= htmlspecialchars($upload->get('ObjectURL')) ?>">successful</a> :)</p>
                        <?php } catch (Exception $e) { ?>
                            <p>Upload error :(</p>
                    <?php }
                    } ?>
                    <p>Image</p>
                    <form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                        <input name="userfile" type="file">
                        <input type="submit" name='submit' value="Save"><br>
                    </form>









                    <input type='submit' name='submit' value='Add Vinyl Record' class='submitVinyl'>
                    <!--Add the action key - value pair -->
                    <input type="hidden" name="action" value="vinylInsert">
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