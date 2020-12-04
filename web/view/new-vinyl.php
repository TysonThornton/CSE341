<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="/css/small.css" type="text/css" rel="stylesheet" media="screen">
    <link href="/css/large.css" type="text/css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="My Vinyl Shelf is a website to digitally store your vinyl record collection">
    <title>Vinyl Record Playlist | Add A Vinyl Record</title>
</head>

<body>
    <header> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/header.php'; ?> </header>
    <nav> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/nav.php'; ?></nav>

    <main>
    <div class='formcontainer'>

<!--This php statement looks to see if there is anything in $message in the account controller (index.php) and if so it displays it -->

<div class="formHeader">
    <h1>Add a Product</h1>
    <p>Add a new product below. All fields are required!</p>
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
        <label for="band">Artist / Band </label><br>
        <input type='text' name="band" id="band" class='input' required <?php if (isset($band)) {
                                                                                    echo "value='$band'";
                                                                                }  ?>><br>
        <label for="invName">Product Name</label><br>
        <input type='text' name="invName" id="invName" class='input' required <?php if (isset($invName)) {
                                                                                    echo "value='$invName'";
                                                                                }  ?>><br>
        <label for="invDescription">Product Description</label><br>
        <textarea name="invDescription" id="invDescription" class='input' required><?php if (isset($invDescription)) {
                                                                                        echo "$invDescription";
                                                                                    }  ?></textarea><br>
        <label for="invImage">Product Image (path to image)</label><br>
        <input type="text" name="invImage" id="invImage" class='input' value="/acme/images/products/no-image.png" required <?php if (isset($invImage)) {
                                                                                                                                echo "value='$invImage'";
                                                                                                                            }  ?>><br>
        <label for="invThumbnail">Product Thumbnail (path to image)</label><br>
        <input type="text" name="invThumbnail" id="invThumbnail" class='input' value="/acme/images/products/no-image.png" required <?php if (isset($invThumbnail)) {
                                                                                                                                        echo "value='$invThumbnail'";
                                                                                                                                    }  ?>><br>
        <label for="invPrice">Product Price</label><br>
        <input type='number' step="0.01" name="invPrice" id="invPrice" class='input' required <?php if (isset($invPrice)) {
                                                                                                    echo "value='$invPrice'";
                                                                                                }  ?>><br>
        <label for="invStock">Amount in Stock</label><br>
        <input type='number' name="invStock" id="invStock" class='input' required <?php if (isset($invStock)) {
                                                                                        echo "value='$invStock'";
                                                                                    }  ?>><br>
        <label for="invSize">Shipping Size in Inches (W x H x L)</label><br>
        <input type='number' name="invSize" id="invSize" class='input' required <?php if (isset($invSize)) {
                                                                                    echo "value='$invSize'";
                                                                                }  ?>><br>
        <label for="invWeight">Weight of Product in lbs</label><br>
        <input type='number' name="invWeight" id="invWeight" class='input' required <?php if (isset($invWeight)) {
                                                                                        echo "value='$invWeight'";
                                                                                    }  ?>><br>
        <label for="invLocation">Location (City Name)</label><br>
        <input type='text' name="invLocation" id="invLocation" class='input' required <?php if (isset($invLocation)) {
                                                                                            echo "value='$invLocation'";
                                                                                        }  ?>><br>
        <label for="invVendor">Vendor Name</label><br>
        <input type='text' name="invVendor" id="invVendor" class='input' required <?php if (isset($invVendor)) {
                                                                                        echo "value='$invVendor'";
                                                                                    }  ?>><br>
        <label for="invStyle">Primary Material</label><br>
        <input type='text' name="invStyle" id="invStyle" class='input' required <?php if (isset($invStyle)) {
                                                                                    echo "value='$invStyle'";
                                                                                }  ?>><br>


        <input type='submit' name='submit' value='Add Product' class='submitCategory'>
        <!--Add the action key - value pair -->
        <input type="hidden" name="action" value="productInsert">
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