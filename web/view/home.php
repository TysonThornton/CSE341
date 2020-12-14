<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="/css/small.css" type="text/css" rel="stylesheet" media="screen">
    <link href="/css/large.css" type="text/css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="My Vinyl Shelf is a website to digitally store your vinyl record collection">
    <title>Vinyl Record Playlist | Home</title>
</head>

<body>
    <header> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/header.php'; ?> </header>
    <nav> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/nav.php'; ?></nav>


    <main>

        <div id="hero">
            <img src="https://vinyl-record-playlist.s3-us-west-1.amazonaws.com/records.jpg" alt="Picture of a lot of vinyl records">
        </div>
        <div>
            <h1>Welcome to Vinyl Record Playlist</h1>
        </div>
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <div id="intro">
            <p>Make your vinyl record collection digital! Create an account, add your vinyl records to your collection 
                and then you'll have them availble to easily scroll through and choose the best one to put on. You can also
                make a wishlist of all the vinyl records you want to add to your collection.
            </p>
        </div>

 

        <?php
        if (!isset($_SESSION['loggedin'])) {

            if (isset($_SESSION['userData']['userEmail'])) {

                $sessionEmail = $_SESSION['userData']['userEmail'];
            }

            echo
                "<div>
            
            <h2>Login</h2>
            <p>Please login or create an account below.</p>
            <form action='/accounts/index.php' method='post' class='loginform'>
                <label>Email Address</label><br>
                <input type='email' name='userEmail' placeholder='example@gmail.com' class='input' required"
                    . $sessionEmail .
                    "><br><br>
                <label>Password</label><br>
                <span id='loginInstructions'>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
                <input type='password' name='userPassword' class='input' required pattern='(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$'>
                <br><br>
                <input type='submit' value='Login' class='inputButton'><br>

                <!--Add the action key - value pair -->
                <input type='hidden' name='action' value='Login'>
            </form>
        </div>
        <div id='accountLink'>
            <a href='/accounts/index.php?action=registration'>Create an Account</a>
        </div>";
        }
        ?>

    </main>
    <footer> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/footer.php'; ?></footer>
</body>

</html>