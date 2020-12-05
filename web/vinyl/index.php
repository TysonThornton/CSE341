<?php
/* This is the Vinyl Collection Controller */

// Create or access a Session 
session_start();

// Bring the files into scope
// Get the database connection file
require_once '../library/connections.php';
// Get the functions library
require_once '../library/functions.php';
// Get the vinyls model
require_once '../model/vinyls-model.php';


// Receive and filter the Action
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

// Switch statement for the received action
switch ($action) {

    case 'addVinyl':
        include '../view/new-vinyl.php';
        break;

    case 'vinylInsert':
        // Filter and store the data
        $vinylBand = filter_input(INPUT_POST, 'vinylBand', FILTER_SANITIZE_STRING);
        $vinylAlbum = filter_input(INPUT_POST, 'vinylAlbum', FILTER_SANITIZE_STRING);
        $vinylYear = filter_input(INPUT_POST, 'vinylYear', FILTER_SANITIZE_NUMBER_INT);
        $vinylCondition = filter_input(INPUT_POST, 'vinylCondition', FILTER_SANITIZE_STRING);
        $vinylGenre = filter_input(INPUT_POST, 'vinylGenre', FILTER_SANITIZE_STRING);
        $vinylImage = filter_input(INPUT_POST, 'vinylImage', FILTER_SANITIZE_STRING);
        $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT);

        // Proper case input
        $vinylBand = ucwords($vinylBand);
        $vinylAlbum = ucwords($vinylAlbum);
        $vinylCondition = ucwords($vinylCondition);
        $vinylGenre = ucwords($vinylGenre);

        // Check for missing data
        if (empty($vinylBand) || empty($vinylAlbum) || empty($vinylYear)) {
            $message = '<p>Please provide information for all empty fields.</p>';
            include '../view/new-vinyl.php';
            exit;
        }

        // Send the data to the model
        $vinylOutcome = insertProd($vinylBand, $vinylAlbum, $vinylYear, $vinylCondition, $vinylGenre, $vinylImage, $userId);

        // Check and report the result. There should be a result of 1 record added so build an if statement for that
        if ($vinylOutcome === 1) {
            $message = "<p>Thanks for adding $vinylAlbum by $vinylBand. It has been added to your collection.</p>";
            include '../view/vinyl-collection.php';
            exit;
        } else {
            $message = "<p>Sorry, but adding $vinylAlbum to the database failed. Please try again.</p>";
            include '../view/new-vinyl.php';
            exit;
        }
        break;


    default:

        include '../view/vinyl-collection.php';
        break;
}
