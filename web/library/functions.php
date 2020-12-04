<?php
// This is a library of custom functions to perform a variety of tasks

// This function is used in Accounts Controller
function checkEmail($userEmail)
{

    $valEmail = filter_var($userEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// This function is used in Accounts Controller
function checkPassword($userPassword)
{

    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $userPassword);
}

function passwordMatch($userPassword, $enteredPassword) {

    if ($userPassword === $enteredPassword) {
        return true;
    } else {
        return false;
    }

}