<?php
/* This is the Accounts Model */

// Get client data based on an email address
function getUser($userEmail)
{
    $db = dbConnect();
    echo '1';
    $sql = 'SELECT username, useremail, userpassword, FROM public.user WHERE useremail = $1';
    echo '2';
    $userData = pg_prepare($db, 'query', $sql);
    echo '3';
    $userData = pg_execute($db, 'query', array($userEmail));
    echo '4';
    $userData = "This is user data";
    echo '5';

    
    // $stmt = $db->prepare($sql);
    // $stmt->bindValue(':email', $userEmail, PDO::PARAM_STR);
    // $stmt->execute();
    // $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    // $stmt->closeCursor();
    return $userData;
}