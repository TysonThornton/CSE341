<?php
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../accounts/index.php?action=Login");
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

<body>
    <header> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/header.php'; ?> </header>
    <nav> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/nav.php'; ?></nav>

    <main>
        <h1>Vinyl Record Collection</h1>
        <a href='../vinyl/index.php?action=addVinyl'>Add Vinyl Record to Collection</a><br>





        

        <!-- This will display a message if there is a message, display a heading and directions and the category list if there is one -->
        <?php
        if (isset($message)) {
            echo $message;
        }
        if (isset($categoryList)) {
            echo '<h2>Products By Category</h2>';
            echo '<p>Choose a category to see those products</p>';
            echo $categoryList;
        }
        ?>
        <!-- This will display a message that JavaScript is required if user has JavaScript disabled on browser -->
        <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
        </noscript>

        <!-- Create shell for data to be injected from JavaScript (DOM manipulation)-->
        <table id="productsDisplay"></table>


    </main>
    <footer> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/footer.php'; ?></footer>
</body>

</html>
<?php
// Unset the stored message
unset($_SESSION['message']);
?>