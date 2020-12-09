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
    <meta name="description" content="Vinyl Record Playlist is a website to digitally store your vinyl record collection">
    <title>Vinyl Record Playlist | Wishlist</title>
</head>

    <body>
    <header> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/header.php'; ?> </header>
    <nav> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/nav.php'; ?></nav>

    <main>
        <h1>Vinyl Record Wishlist</h1>


        <!-- This will display a message if there is a message, display a heading and directions and the category list if there is one -->
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
        }
        if (isset($message)) {
            echo $message;
        }
        ?><br>
        <a href='../wishlist/index.php?action=addWishlistItem'>Add a Vinyl Record to Your Wishlist</a><br>

        <?php if (isset($wishlistDisplay)) {
            echo $wishlistDisplay;
        } ?>



    </main>
    <footer> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/footer.php'; ?></footer>
</body>

</html>
<?php
// Unset the stored message
unset($_SESSION['message']);
?>