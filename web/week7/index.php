<?php
//start session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome
        <?php
        if (array_key_exists('user', $_SESSION) and isset($_SESSION['user'])) {
            echo " ".$_SESSION['user'];
        }
        else {
            header('Location: sign-in.php');
            die();
        }
        ?>
    </h1>

</body>
</html>