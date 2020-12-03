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
  
  
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($userData);
        // Store the array into the session
        $_SESSION['userData'] = $userData;
        // echo $_SESSION['userData']['username'];

        $message = '<p class="notice">Well done! ' . $_SESSION['userData']['username'] . ', you are logged in.</p>';
  
        // Send them to the admin view
        include '../view/home.php';
        
        exit;

    case 'registration':
        include '../view/registration.php';
        break;


    case 'register':
        // Filter and store the data
        $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
        $userEmail = filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_EMAIL);
        $userPassword = filter_input(INPUT_POST, 'userPassword', FILTER_SANITIZE_STRING);
    
        // Check that email is valid format
        $userEmail = checkEmail($userEmail);
    
        // Store the value returned from checkPassword() in functions.php library to a new variable $checkPassword
        // The checkPassword() function returns a 1 if password matches format or a 0 if it doesnt.
        $checkPassword = checkPassword($userPassword);
    
        // Check if email address used already exists in the database. Function is in the account-model.php which returns a 1 or 0
        $existingEmail = checkExistingEmail($userEmail);
        if ($existingEmail) {
            $message = '<p class="notice">That email address already exists. Please login or choose a different email address to create a new account</p>';
            include '../view/registration.php';
            exit;
        }
    
        // Check for missing data 
        if (empty($userName) || empty($userEmail) || empty($checkPassword)) {
            $message = '<p><b><i>Please provide information for all empty form fields.</i></b></p>';
            include '../view/registration.php';
            exit;
        }
    
        // Send the data to the accounts-model
        $regOutcome = regClient($userName, $userEmail, $checkPassword);
    
        // Check and report the result.
        if ($regOutcome === 1) {
            $message = "<p>Thanks for registering $userName. Please use your email and password to login.</p>";
            include '../view/login.php';
            exit;
        } else {
            $message = "<p>Sorry $userName, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
    
        break;


        case 'Logout':
            // Clear the session data
            $_SESSION['userData'] = [];
      
            // If the user logs out, then the session is destroyed.
            // Commenting out session_unset() because per php.net "Only use session_unset() for older deprecated code that does not use $_SESSION."
            // session_unset();
            session_destroy();
      
            // include 'C:\xampp\htdocs\acme\index.php';
            header('location: /web/');
            exit;

    default:
        include '../index.php';






}



















