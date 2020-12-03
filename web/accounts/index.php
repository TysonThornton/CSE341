<?php
/* This is the Accounts Controller */

// Create or access a Session 
session_start();

// Bring the files into scope
// Get the database connection file
require_once '../library/connections.php';
// Get the functions.php library
require_once '../library/functions.php';
// Get the accounts model
require_once '../model/accounts-model.php';



// Receive and filter the Action
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
   $action = filter_input(INPUT_GET, 'action');
}

// Switch statement for the received action
switch ($action) {

    case 'Login':
        // Filter and store the data
        $userEmail = filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_EMAIL);
        $userPassword = filter_input(INPUT_POST, 'userPassword', FILTER_SANITIZE_STRING);
  
  
  
        // Recreate the $clientEmail variable and assign it to the value returned from checkEmail() in the functions.php library
        $userEmail = checkEmail($userEmail);
  
        // Store the value returned from checkPassword() in functions.php library to a new variable $checkPassword
        // The checkPassword() function returns a 1 if password matches format or a 0 if it doesnt.
        $checkPassword = checkPassword($userPassword);
  
        // Check for missing data   ----  added later > $clientPassword was changed to $checkPassword for data validation
        if (empty($userEmail) || empty($checkPassword)) {
           $message = '<p><b><i>Please provide information for all empty form fields.</i></b></p>';
           include '../view/home.php';
           exit;
        }
        // A valid password exists, proceed with the login process

        // Query the client data based on the email address
        $userData = getUser($userEmail);
        echo $userData;
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($userPassword, $userData['userPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
           $message = '<p class="notice">Please check your password and try again.</p>';
           include '../view/home.php';
           exit;
        }
  
  
  
  
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($userData);
        // Store the array into the session
        $_SESSION['userData'] = $userData;

        $message = '<p class="notice">YOU ARE LOGGED IN.</p>';
  
        // Send them to the admin view
        header('location: ../index.php');
        
        exit;

    default:
        include '../index.php';






}



















