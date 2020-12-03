<?php
/* This is the Accounts Model */

// Get client data based on an email address
function getUser($userEmail)
{
    $db = dbConnect();
    $sql = 'SELECT username, useremail, userpassword, FROM public.user WHERE useremail = $1';
    $userData = pg_prepare($db, 'query', $sql);
    $userData = pg_execute($db, 'query', array($userEmail));
    $message = "<p>getUser() is running</p>";
    echo $message;

    
    // $stmt = $db->prepare($sql);
    // $stmt->bindValue(':email', $userEmail, PDO::PARAM_STR);
    // $stmt->execute();
    // $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    // $stmt->closeCursor();
    return $userData;
}