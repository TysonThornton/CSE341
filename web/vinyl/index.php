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

        // Grab the image url
        $imageURL = filter_input(INPUT_GET, 'imageURL', FILTER_SANITIZE_STRING);
        echo var_dump($imageURL);
        
        include '../view/new-vinyl.php';
        break;

    case 'vinylCollection':

        if (!isset($_SESSION['loggedin'])) {
            header("Location: ../accounts/index.php?action=login");
        }

        $sessionUserId = $_SESSION['userData']['userid'];
        $vinylData = getVinylData($sessionUserId);



        // $p = print_r($vinylData);
        // echo $p;
        // foreach($vinylData as $vinyl) {
        //     echo $vinyl[1]["vinylalbum"];

        // }


        // Use if else statement to see if info was actually returned or not.
        if (!count($vinylData)) {
            $message = "<p class='notice'>Sorry, no vinyl record information could be found for your account.</p>";
            include '../view/vinyl-collection.php';
            exit;
        } else {
            $vinylDisplay = buildVinylDisplay($vinylData);
        }

        include '../view/vinyl-collection.php';
        break;

    case 'vinylInsert':
        // Filter and store the data
        $vinylBand = filter_input(INPUT_POST, 'vinylBand', FILTER_SANITIZE_STRING);
        $vinylAlbum = filter_input(INPUT_POST, 'vinylAlbum', FILTER_SANITIZE_STRING);
        $vinylYear = filter_input(INPUT_POST, 'vinylYear', FILTER_SANITIZE_NUMBER_INT);
        $vinylCondition = filter_input(INPUT_POST, 'vinylCondition', FILTER_SANITIZE_STRING);
        $vinylGenre = filter_input(INPUT_POST, 'vinylGenre', FILTER_SANITIZE_STRING);
        $imageURL = filter_input(INPUT_POST, 'imageURL', FILTER_SANITIZE_STRING);
        $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT);


        // Proper case input
        $vinylBand = ucwords($vinylBand);
        $vinylAlbum = ucwords($vinylAlbum);
        $vinylCondition = ucwords($vinylCondition);
        $vinylGenre = ucwords($vinylGenre);

        // Check for missing data
        if (empty($vinylBand) || empty($vinylAlbum) || empty($vinylYear)) {
            $message = '<p class="notice">Please provide information for all empty fields.</p>';
            include '../view/new-vinyl.php';
            exit;
        }

        // Add image to database
        if (isset($imageURL)) {
            $imageOutcome = insertImage($imageURL);
            if ($imageOutcome !== 1) {

                $message = "<p class='notice'>Sorry, but adding the Vinyl Record Image to the database failed. Please try again.</p>";
                include '../view/new-vinyl.php';
                exit;
            } else {

                $imageResult = getLastImageId();
                $imageId = $imageResult['imageid'];
            }
        }

            // Send the data to the model
            $vinylOutcome = insertVinyl($vinylBand, $vinylAlbum, $vinylYear, $vinylCondition, $vinylGenre, $imageId, $userId);

            // Check and report the result. There should be a result of 1 record added so build an if statement for that
            if ($vinylOutcome === 1) {

                $_SESSION['message'] = "<p class='notice'>Thanks for adding $vinylAlbum by $vinylBand. It has been added to your collection.</p>";
                header("Location: ../vinyl/index.php?action=vinylCollection");
                // include '../vinyl/index.php?action=vinylCollection';
                exit;
            } else {

                $message = "<p class='notice'>Sorry, but adding $vinylAlbum to the database failed. Please try again.</p>";
                include '../view/new-vinyl.php';
                exit;
            }
        break;

    case 'deleteVinyl':
        // Filter and store data
        $vinylId = filter_input(INPUT_GET, 'vinylId', FILTER_VALIDATE_INT);
        // Get vinyl info
        $vinylInfo = getVinylInfo($vinylId);
        $vinylAl = $vinylInfo['vinylalbum'];
        $vinylBa = $vinylInfo['vinylband'];



        // Check to see if $vinylInfo has any data in it, display error message if not
        if (count($vinylInfo) < 1) {
            $_SESSION['message'] = '<p class="notice">Sorry, no vinyl record information could be found.</p>';
            include '../view/vinyl-collection.php';
            exit;
        }

        include '../view/vinyl-delete.php';
        exit;
        break;


    case 'deleteVinylConfirmed':

        // Filter and store data
        $vinylId = filter_input(INPUT_POST, 'vinylId', FILTER_SANITIZE_NUMBER_INT);
        $vinylAl = filter_input(INPUT_POST, 'vinylAl', FILTER_SANITIZE_STRING);

        // Call function to delete vinyl record
        $deleteResult = deleteVInyl($vinylId);

        // Check and the result
        if ($deleteResult === 1) {
            $message = "<p class='notice'>You have successfully deleted $vinylAl from your collection.</p>";

            $_SESSION['message'] = $message;
            header('location: ../vinyl/index.php?action=vinylCollection');
            exit;
        } else {
            $message = "<p class='notice'>Error: $vinylAl was not deleted.</p>";
            include '../view/vinyl-delete.php';
            exit;
        }

        break;

    case 'editVinyl':

        // Filter and store data
        $vinylId = filter_input(INPUT_GET, 'vinylId', FILTER_VALIDATE_INT);
        // Get vinyl info
        $vinylInfo = getVinylInfo($vinylId);

        $vinylAlbum = $vinylInfo['vinylalbum'];
        $vinylBand = $vinylInfo['vinylband'];
        $vinylYear = $vinylInfo['vinylyear'];
        $vinylCondition = $vinylInfo['vinylcondition'];
        $vinylGenre = $vinylInfo['vinylgenre'];
        $imageURL = $vinylInfo['imageurl'];

        $_SESSION['vinylEditInfo'] = [];
        $_SESSION['vinylEditInfo'] = $vinylInfo;


        // Check to see if $vinylInfo has any data in it, display error message if not
        if (count($vinylInfo) < 1) {
            $_SESSION['message'] = '<p class="notice">Sorry, no vinyl record information could be found.</p>';
            include '../view/vinyl-collection.php';
            exit;
        }

        include '../view/vinyl-edit.php';
        exit;

        break;

    case 'editVinylNewPhoto':

        // Filter and store data
        $vinylId = $_SESSION['vinylEditInfo']['vinylid'];
        $imageURL = filter_input(INPUT_GET, 'imageURL', FILTER_SANITIZE_STRING);
        // Get vinyl info
        $vinylInfo = getVinylInfo($vinylId);

        $vinylAlbum = $vinylInfo['vinylalbum'];
        $vinylBand = $vinylInfo['vinylband'];
        $vinylYear = $vinylInfo['vinylyear'];
        $vinylCondition = $vinylInfo['vinylcondition'];
        $vinylGenre = $vinylInfo['vinylgenre'];


        $_SESSION['vinylEditInfo'] = [];
        $_SESSION['vinylEditInfo'] = $vinylInfo;

        // Check to see if $vinylInfo has any data in it, display error message if not
        if (count($vinylInfo) < 1) {
            $_SESSION['message'] = '<p class="notice">Sorry, no vinyl record information could be found.</p>';
            include '../view/vinyl-collection.php';
            exit;
        }

        include '../view/vinyl-edit.php';
        exit;

        break;


    case 'updateVinyl':

        // This case will insert updated vinyl info into db
        // Filter and store the data
        $vinylBand = filter_input(INPUT_POST, 'vinylBand', FILTER_SANITIZE_STRING);
        $vinylAlbum = filter_input(INPUT_POST, 'vinylAlbum', FILTER_SANITIZE_STRING);
        $vinylYear = filter_input(INPUT_POST, 'vinylYear', FILTER_SANITIZE_NUMBER_INT);
        $vinylCondition = filter_input(INPUT_POST, 'vinylCondition', FILTER_SANITIZE_STRING);
        $vinylGenre = filter_input(INPUT_POST, 'vinylGenre', FILTER_SANITIZE_STRING);
        $vinylImage = filter_input(INPUT_POST, 'vinylImage', FILTER_SANITIZE_STRING);
        $imageURL = filter_input(INPUT_POST, 'imageURL', FILTER_SANITIZE_STRING);
        $vinylId = filter_input(INPUT_POST, 'vinylId', FILTER_SANITIZE_NUMBER_INT);

        $imageId = $_SESSION['vinylEditInfo']['imageid'];


        // Proper case input
        $vinylBand = ucwords($vinylBand);
        $vinylAlbum = ucwords($vinylAlbum);
        $vinylCondition = ucwords($vinylCondition);
        $vinylGenre = ucwords($vinylGenre);

        // Check for missing data
        if (empty($vinylBand) || empty($vinylAlbum) || empty($vinylYear) || empty($vinylCondition) || empty($vinylGenre)) {
            $message = '<p class="notice">Please provide information for all empty fields.</p>';
            include '../view/vinyl-edit.php';
            exit;
        }

        // Update image URL
        if (isset($imageId)) {
            $imageOutcome = updateImage($imageId, $imageURL);
            if ($imageOutcome !== 1) {

                $message = "<p class='notice'>Sorry, but updating the Vinyl Record Image to the database failed. Please try again.</p>";
                include '../view/vinyl-edit.php';
                exit;
            }
        }

        // Send the data to the model
        $updateResult = updateVinyl($vinylBand, $vinylAlbum, $vinylYear, $vinylCondition, $vinylGenre, $imageId, $vinylId);

        // Check and report the result. There should be a result of 1 record added so build an if statement for that
        if ($updateResult === 1) {
            $message = "<p class='notice'>Thank you for updating $vinylAlbum by $vinylBand. All changes have been saved successfully.</p>";
            $_SESSION['message'] = $message;
            header('location: ../vinyl/index.php?action=vinylCollection');
            exit;
        } else {
            $message = "<p class='notice'>Sorry, but saving changes for $vinylAlbum by $vinylBand to the database failed. Please try again.</p>";
            include '../view/vinyl-edit.php';
            exit;
        }

        break;




    default:

        include '../index.php';
}
