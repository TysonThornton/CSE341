<?php

// Database Connection
function dbConnect() {
    $dbUrl = getenv('DATABASE_URL');

    $dbopts = parse_url($dbUrl);

    $dbHost = $dbopts["host"];
    $dbPort = $dbopts["port"];
    $dbUser = $dbopts["user"];
    $dbPassword = $dbopts["pass"];
    $dbName = ltrim($dbopts["path"],'/');

    
    try {
        
        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

        echo 'db connect worked successfully <br>';
        return $db;
    } catch (PDOException $exc) {
        header('location: /view/500.php');
        exit;
    }
}

dbConnect();


?>
