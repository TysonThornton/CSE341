<?php
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../accounts/index.php?action=login");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="/css/small.css" type="text/css" rel="stylesheet" media="screen">
    <link href="/css/large.css" type="text/css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="My Vinyl Shelf is a website to digitally store your vinyl record collection">
    <title>Vinyl Record Playlist | Vinyl Collection</title>
</head>

<!-- <script> 
let data = "<?php //echo $vinylData ?>";
</script>
<body onload="buildVinylCollection(data)"> 
    -->
    <body>
    <header> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/header.php'; ?> </header>
    <nav> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/nav.php'; ?></nav>

    <main class="vinylRecordCollection">
        <h1>Vinyl Record Collection</h1>


        <!-- This will display a message if there is a message, display a heading and directions and the category list if there is one -->
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
        }
        if (isset($message)) {
            echo $message;
        }
        ?><br>
        <div class="pageLink">
        <a href='../vinyl/index.php?action=addVinyl'>Add Vinyl Record to Collection</a><br>
        </div>

        <?php if (isset($vinylDisplay)) {
            echo $vinylDisplay;
        } ?>



    </main>
    <footer> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/footer.php'; ?></footer>
</body>

</html>
<?php
// Unset the stored message
unset($_SESSION['message']);
?>