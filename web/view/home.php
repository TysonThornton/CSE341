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
        <div>
            <p>Welcome to Vinyl Record Playlist</p>
        </div>

        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>

        <?php
        if (!isset($_SESSION['loggedin'])) {

            if (isset($_SESSION['userData']['userEmail'])) {

                $sessionEmail = $_SESSION['userData']['userEmail'];
            }

            echo
                "<div>
            
            <h2>Login</h2>
            <form action='/accounts/index.php' method='post' class='loginform'>
                <label>Email Address</label><br>
                <input type='email' name='userEmail' placeholder='example@gmail.com' class='input' required"
                    . $sessionEmail .
                    "><br><br>
                <label>Password</label><br>
                <span id='loginInstructions'>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
                <input type='password' name='userPassword' class='input' required pattern='(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$'>
                <br><br>
                <input type='submit' value='Login' class='inputButton'><br><br>

                <!--Add the action key - value pair -->
                <input type='hidden' name='action' value='Login'>
            </form>
        </div>
        <div>
            <a href='/accounts/index.php?action=registration'>Create an Account</a>
        </div>";
        } elseif (isset($_SESSION['loggedin'])) {

            if (!isset($_SESSION['username'])) {

                $un = $_SESSION['userData']['username'];
            }

            echo "<a id='profile' href='../accounts/index.php?action=Profile'>Account Profile</a><br>";
            echo "<a id='logout' href='../accounts/index.php?action=Logout'>Logout</a>";
        };
        ?>

    </main>
    <footer> <?php include $_SERVER['DOCUMENT_ROOT'] . '/pageSections/footer.php'; ?></footer>
</body>

</html>