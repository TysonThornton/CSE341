<?php
session_start();
// connect to the database
try
{
  $dbUrl = getenv('DATABASE_URL');

  $dbOpts = parse_url($dbUrl);

  $dbHost = $dbOpts["host"];
  $dbPort = $dbOpts["port"];
  $dbUser = $dbOpts["user"];
  $dbPassword = $dbOpts["pass"];
  $dbName = ltrim($dbOpts["path"],'/');

  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}

function console_log( $data ){  echo '<script>';    echo 'console.log("'. $data .'")';    echo '</script>';    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

</head>
<body>
    <h1>Sign Up</h1>
    <?php
    if(isset($_SESSION['message'])) {
        echo "<p style='color:red;'>".$_SESSION['message']."</p>";
    }?>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <br>
        <label for="password">Password:</label><?php
    if(isset($_SESSION['message'])) {
        echo "<p style='color:red;'>*</p>";
    }?>
        <input type="password" id="password" name="password">
        <br>
        <label for="passwordConf">Confirm Password:</label><?php
    if(isset($_SESSION['message'])) {
        echo "<p style='color:red;'>*</p>";
        
    }?>
        <input type="password" id="passwordConf" name="passwordConf">
        <br>
        <input type="submit" value="Sign Up">
    </form>

    <?php
    print_r($_SESSION);
    if (!empty($_POST)) {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $passwordConf = filter_input(INPUT_POST, 'passwordConf', FILTER_SANITIZE_STRING);

        $pattern = '/.{7,}/';
        $pattern2 = '/\d/';
        if(preg_match($pattern, $password) and preg_match($pattern2, $password)) {
            console_log("first if");
        
            if($password != $passwordConf){
                console_log("second if");
                $_SESSION['message'] = "Passwords don't match";
                header('Location: sign-up.php');
                die();
            }
            else {
                console_log("second if's else");
                unset($_SESSION['message']);
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                try {
                    $stmt = $db->prepare('INSERT INTO team_user (username, userpassword) VALUES (:username, :userpassword)');
                    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
                    $stmt->bindValue(':userpassword', $hashedPassword, PDO::PARAM_STR);
                    $stmt->execute();

                    header('Location: sign-in.php');
                    die();
                }
                catch(PDOException $e) {
                    echo "Error: ".$e->getMessage();
                }
            }
        }
        else {
            console_log("first if's else");
            $_SESSION['message'] = "Password must be at least 7 characters and contain one number.";
            header('Location: sign-up.php');
            die();
        }

        
    }
    ?>
</body>
</html>