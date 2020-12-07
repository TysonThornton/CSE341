<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="/css/small.css" type="text/css" rel="stylesheet" media="screen">
    <link href="/css/large.css" type="text/css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="My Vinyl Shelf is a website to digitally store your vinyl record collection">
    <title>Vinyl Record Playlist | Create Account</title>
</head>

<body>
    <header> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/header.php'; ?> </header>
    <nav> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/nav.php'; ?></nav>


    <main>
        <div class="formHeader">
            <h1>Create an Account</h1>
            <p>All fields are required.</p>
        </div>

        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>

        <form class='form' action="../accounts/index.php" method="post">
            <fieldset>
                <label for="userName">Username</label><br>
                <input type='text' name="userName" id="userName" class='input' required <?php if (isset($userName)) {
                                                                                            echo "value='$userName'";
                                                                                        }  ?>><br>
                <label for="userEmail">Email Address</label><br>
                <input type='email' name="userEmail" id="userEmail" placeholder="example@gmail.com" class='input' required <?php if (isset($userEmail)) {
                                                                                                                                echo "value='$userEmail'";
                                                                                                                            }  ?>><br>
                <label for="userPassword">Password</label><br>
                <span id="registrationInstructions">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
                <input type='password' name="userPassword" id="userPassword" class='input' required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                <br>
                <input type='submit' name='submit' value='Create Account' class='inputButton'>
                <!--Add the action key - value pair -->
                <input type="hidden" name="action" value="register">
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