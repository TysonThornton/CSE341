<?php
$imageURL = filter_input(INPUT_GET, 'imageURL', FILTER_SANITIZE_STRING);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="/css/small.css" type="text/css" rel="stylesheet" media="screen">
    <link href="/css/large.css" type="text/css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="My Vinyl Shelf is a website to digitally store your vinyl record collection">
    <title>Vinyl Record Playlist | Upload An Image</title>
</head>

<body>
    <header> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/header.php'; ?> </header>
    <nav> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/nav.php'; ?></nav>

    <main class="uploadMain">
        <div>

            <?php
            require('../vendor/autoload.php');
            // this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
            $s3 = new Aws\S3\S3Client([
                'version'  => '2006-03-01',
                'region'   => 'us-west-1',
            ]);
            $bucket = getenv('S3_BUCKET_NAME') ?: die('No "S3_BUCKET" config var in found in env!');
            ?>

            <h1>Upload An Image</h1>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {


                try {
                    // FIXME: you should not use 'name' for the upload, since that's the original filename from the user's computer - generate a random filename that you then store in your database, or similar
                    $upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
            ?>
                    <p class="uploadSuccess">Download Successful!</p>
                    <?php $imageURL = htmlspecialchars($upload->get('ObjectURL')); ?>
                    <a href='../vinyl/index.php?action=addVinyl&imageURL=<?php echo $imageURL; ?>'>Click here to return to continue adding a new vinyl record</a><br>

                <?php } catch (Exception $e) { ?>
                    <p>Download error. Please try again.</p>
                    <a href='../vinyl/index.php?action=addVinyl'>Click here to return to the Add New Vinyl page</a><br>
            <?php }
            }
            if (isset($imageURL)) {
                echo "<img src='$imageURL'>";
            }
            echo
                "<form enctype='multipart/form-data' action='" . $_SERVER['PHP_SELF'] . "' method='POST'>
                    <label for='userfile'>Select a file:</label>     
                    <input name='userfile' type='file' class='selectFile'><br>
                    <input type='submit' name='submit' class='inputButton' value='Save'>
                    </form>";

            ?>
        </div>


    </main>
    <footer> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/footer.php'; ?></footer>
</body>

</html>
<?php
// Unset the stored message
unset($_SESSION['message']);
?>