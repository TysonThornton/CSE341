<?php
// This is a library of custom functions to perform a variety of tasks

// This function is used in Accounts Controller
function checkEmail($clientEmail)
{

    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// This function is used in Accounts Controller
function checkPassword($clientPassword)
{

    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}