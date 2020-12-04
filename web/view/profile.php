<?php
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php");
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
    <title>Vinyl Record Playlist | Profile</title>
</head>

<body>
    <header>
        <h1>Vinyl Record Playlist</h1>
    </header>
    <nav>
        <a href="#">Home</a>
        <a href="#">Vinyl Collection</a>
        <a href="#">Wishlist</a>
        <a href="#">Favorites</a>
    </nav>

    <main>
        <h1><?php echo $_SESSION['userData']['username']; ?></h1>
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
        }
        ?>
        <p>You are currently logged in.</p>
        <ul>
            <li>Username: <?php echo $_SESSION['userData']['username'];  ?></li>
            <li>Email: <?php echo $_SESSION['userData']['useremail'];  ?></li>
        </ul>

        <div class="formHeader">
            <h2>Update Account Info</h2>
            <p>Use this form to update your name or email information.</p>
            <form class='form' action="../accounts/index.php" method="post">
            <fieldset>
                <label for="updatedUserName">Username</label><br>
                <input type='text' name="updatedUserName" id="updatedUserName" class='input' required <?php
                                                                                                        $sessionUserName = $_SESSION['userData']['username'];
                                                                                                        echo "value='$sessionUserName'";
                                                                                                        ?>><br>
                <label for="updatedUserEmail">Email Address</label><br>
                <input type='email' name="updatedUserEmail" id="updatedUserEmail" placeholder="example@gmail.com" class='input' required <?php
                                                                                                                                $sessionEmail = $_SESSION['userData']['userEmail'];
                                                                                                                                echo "value='$sessionEmail'";
                                                                                                                                ?>><br>
                <input type='submit' name='submit' value='Update Account' class='inputButton'>
                <!--Add the action key - value pair -->
                <input type="hidden" name="action" value="updateAccountInfo">
                <!-- Adding a second hidden name value to store primary key value for the client being updated -->
                <input type="hidden" name="userId" value="<?php $sessionUserId = $_SESSION['userData']['userid'];
                                                            echo $sessionUserId;
                                                            ?>">
            </fieldset>
            </form>
        </div>
        <div class="formHeader">
            <h2>Change Password</h2>
            <form class='form' action="../accounts/index.php" method="post">
            <fieldset>
                <label for="updatedUserPassword">New Password</label><br>
                <span id="registrationInstructions">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
                <input type='password' name="updatedUserPassword" id="updatedUserPassword" class='input' required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                <br>

                <input type='submit' name='submit' value='Change Password' class='inputButton'>
                <!--Add the action key - value pair -->
                <input type="hidden" name="action" value="updatePassword">
                <!-- Adding a second hidden name value to store primary key value for the client being updated -->
                <input type="hidden" name="userId" value="<?php $sessionUserId = $_SESSION['userData']['userid'];
                                                            echo $sessionUserId;
                                                            ?>">
            </fieldset>
        </form>
        </div>


        <div>
            <a href="../vinyl/index.php"><h3>Access your vinyl collection</h3></a>
        </div>


        <?php
        $clientLevel = $_SESSION['clientData']['clientLevel'];
        if ($clientLevel > '1') {
            $authorizedHeading = '<h2>Administrative Functions</h2>';
            $authorizedInstructions = '<p>Use the link below to manage products</p>';
            $authorizedLevel = '<p><a href="/acme/products/index.php?action=products" id="adminFunctionLink">Click here</a> to go to the Prodcuts Management page</p>';

            echo $authorizedHeading;
            echo $authorizedInstructions;
            echo $authorizedLevel;
        }
        ?>

    </main>
    <footer>
        <p>
            &copy;2020 Vinyl Record Playlist
        </p>
    </footer>
</body>

</html>
<?php
// Unset the stored message
unset($_SESSION['message']);
?>