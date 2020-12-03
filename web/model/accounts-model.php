<?php
/* This is the Accounts Model */

// Get client data based on an email address
function getUser($userEmail)
{
    $db = dbConnect();
    $sql = "SELECT username, useremail, userpassword, FROM public.user WHERE useremail = '$userEmail'";

    
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $userEmail, PDO::PARAM_STR);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $userData;
}