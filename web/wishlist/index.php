<?php
/* This is the Wishlist Controller */

// Create or access a Session 
session_start();

// Bring the files into scope
// Get the database connection file
require_once '../library/connections.php';
// Get the functions library
require_once '../library/functions.php';
// Get the vinyls model
require_once '../model/wishlists-model.php';

// Receive and filter the Action
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

// Switch statement for the received action
switch ($action) {

    case 'wishlist':

        if (!isset($_SESSION['loggedin'])) {
            header("Location: ../accounts/index.php?action=login");
        }

        $sessionUserId = $_SESSION['userData']['userid'];
        $wishlistData = getWishlistData($sessionUserId);

        // Use if else statement to see if info was actually returned or not.
        if (!count($wishlistData)) {
            $message = "<p class='notice'>Sorry, no wishlist information could be found for your account. Please create one.</p>";
            include '../view/wishlist.php';
            exit;
        } else {
            $wishlistDisplay = buildWishlistDisplay($wishlistData);
        }

        include '../view/wishlist.php';
        break;

    case 'addWishlistItem':
        include '../view/new-wishlist-item.php';
        break;

    case 'wishlistItemInsert':
        // Filter and store the data
        $wlVinylBand = filter_input(INPUT_POST, 'wlVinylBand', FILTER_SANITIZE_STRING);
        $wlVinylAlbum = filter_input(INPUT_POST, 'wlVinylAlbum', FILTER_SANITIZE_STRING);
        $wlVinylPrice = filter_input(INPUT_POST, 'wlVinylPrice', FILTER_SANITIZE_NUMBER_INT);
        $wlVinylNotes = filter_input(INPUT_POST, 'wlVinylNotes', FILTER_SANITIZE_STRING);
        $wlVinylImage = filter_input(INPUT_POST, 'wlVinylImage', FILTER_SANITIZE_STRING);
        $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT);

        // Proper case input
        $wlVinylBand = ucwords($wlVinylBand);
        $wlVinylAlbum = ucwords($wlVinylAlbum);

        // Check for missing data
        if (empty($wlVinylBand) || empty($wlVinylAlbum) || empty($wlVinylPrice)) {
            $message = '<p>Please provide information for all empty fields.</p>';
            include '../view/new-wishlist-item.php';
            exit;
        }

        // Send the data to the model
        $wlItemOutcome = insertWlItem($wlVinylBand, $wlVinylAlbum, $wlVinylPrice, $wlVinylNotes, $wlVinylImage, $userId);

        // Check and report the result. There should be a result of 1 record added so build an if statement for that
        if ($wlItemOutcome === 1) {
            $_SESSION['message'] = "<p>Thanks for adding $wlVinylAlbum by $wlVinylBand. It has been added to your wishlist.</p>";
            header("Location: ../wishlist/index.php?action=wishlist");
            exit;
        } else {
            $message = "<p>Sorry, but adding $wlVinylAlbum to the database failed. Please try again.</p>";
            include '../view/new-wishlist-item.php';
            exit;
        }
        break;

    case 'editWlItem':

        // Filter and store data
        $wishlistId = filter_input(INPUT_GET, 'wishlistId', FILTER_VALIDATE_INT);
        // Get vinyl info
        $wishlistInfo = getWishlistInfo($wishlistId);
        $wlVinylAlbum = $wishlistInfo['wlvinylalbum'];
        $wlVinylBand = $wishlistInfo['wlvinylband'];
        $wlVinylPrice = $wishlistInfo['wlvinylprice'];
        $wlVinylNotes = $wishlistInfo['wlvinylnotes'];

        // Check to see if $wishlistInfo has any data in it, display error message if not
        if (count($wishlistInfo) < 1) {
            $_SESSION['message'] = 'Sorry, that wishlist item could not be found.';
            include '../view/wishlist.php';
            exit;
        }

        include '../view/wishlist-edit.php';
        exit;

        break;

    case 'updateWlItem':

        // This case will insert updated vinyl info into db
        // Filter and store the data
        $wlVinylBand = filter_input(INPUT_POST, 'wlVinylBand', FILTER_SANITIZE_STRING);
        $wlVinylAlbum = filter_input(INPUT_POST, 'wlVinylAlbum', FILTER_SANITIZE_STRING);
        $wlVinylPrice = filter_input(INPUT_POST, 'wlVinylPrice', FILTER_SANITIZE_NUMBER_INT);
        $wlVinylNotes = filter_input(INPUT_POST, 'wlVinylNotes', FILTER_SANITIZE_STRING);
        $wlVinylImage = filter_input(INPUT_POST, 'wlVinylImage', FILTER_SANITIZE_STRING);
        $wishlistId = filter_input(INPUT_POST, 'wishlistId', FILTER_SANITIZE_NUMBER_INT);


        // Proper case input
        $wlVinylBand = ucwords($wlVinylBand);
        $wlVinylAlbum = ucwords($wlVinylAlbum);

        // Check for missing data
        if (empty($wlVinylBand) || empty($wlVinylAlbum) || empty($wlVinylPrice)) {
            $message = '<p>Please provide information for all empty fields.</p>';
            include '../view/wishlist-edit.php';
            exit;
        }

        // Send the data to the model
        $updateResult = updateWlItem($wlVinylBand, $wlVinylAlbum, $wlVinylPrice, $wlVinylNotes, $wlVinylImage, $wishlistId);

        // Check and report the result. There should be a result of 1 record added so build an if statement for that
        if ($updateResult === 1) {
            $_SESSION['message'] = "<p>Thanks for updating $wlVinylAlbum by $wlVinylBand. Changes have been saved successfully.</p>";
            header("Location: ../wishlist/index.php?action=wishlist");
            exit;
        } else {
            $message = "<p>Sorry, but updating $wlVinylAlbum to the database failed. Please try again.</p>";
            include '../view/wishlist-edit.php';
            exit;
        }
        break;

    case 'deleteWlItem':

        // Filter and store data
        $wishlistId = filter_input(INPUT_GET, 'wishlistId', FILTER_VALIDATE_INT);
        // Get vinyl info
        $wishlistInfo = getWishlistInfo($wishlistId);
        $wlVinylAlbum = $wishlistInfo['wlvinylalbum'];
        $wlVinylBand = $wishlistInfo['wlvinylband'];

        // Call function to delete vinyl record
        $deleteResult = deleteWishlistItem($wishlistId);

        // Check and the result
        if ($deleteResult === 1) {
            $message = "<p>You have successfully deleted $wlVinylAlbum from your wishlist.</p>";

            $_SESSION['message'] = $message;
            header('location: ../wishlist/index.php?action=wishlist');
            exit;
        } else {
            $message = "<p>Error: $wlVinylAlbum was not deleted. Please try again.</p>";
            include '../view/wishlist.php';
            exit;
        }

        break;

    case 'addToCollection':

        // Filter and store data
        $wishlistId = filter_input(INPUT_GET, 'wishlistId', FILTER_VALIDATE_INT);
        // Get vinyl info
        $wishlistInfo = getWishlistInfo($wishlistId);

        $wlVinylAlbum = $wishlistInfo['wlvinylalbum'];
        $wlVinylBand = $wishlistInfo['wlvinylband'];
        $wlVinylPrice = $wishlistInfo['wlvinylprice'];
        $wlVinylNotes = $wishlistInfo['wlvinylnotes'];

        $vinylBand = $wlVinylBand;
        $vinylAlbum = $wlVinylAlbum;

        include '../view/wishlist-to-collection.php';

        break;

    case 'insertWlToCollection':

        // Filter and store the data
        $vinylBand = filter_input(INPUT_POST, 'vinylBand', FILTER_SANITIZE_STRING);
        $vinylAlbum = filter_input(INPUT_POST, 'vinylAlbum', FILTER_SANITIZE_STRING);
        $vinylYear = filter_input(INPUT_POST, 'vinylYear', FILTER_SANITIZE_NUMBER_INT);
        $vinylCondition = filter_input(INPUT_POST, 'vinylCondition', FILTER_SANITIZE_STRING);
        $vinylGenre = filter_input(INPUT_POST, 'vinylGenre', FILTER_SANITIZE_STRING);
        $vinylImage = filter_input(INPUT_POST, 'vinylImage', FILTER_SANITIZE_STRING);
        $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT);
        $wishlistId = filter_input(INPUT_POST, 'wishlistId', FILTER_VALIDATE_INT);

        // Proper case input
        $vinylBand = ucwords($vinylBand);
        $vinylAlbum = ucwords($vinylAlbum);
        $vinylCondition = ucwords($vinylCondition);
        $vinylGenre = ucwords($vinylGenre);

        // Check for missing data
        if (empty($vinylBand) || empty($vinylAlbum) || empty($vinylYear)) {
            $message = '<p>Please provide information for all empty fields.</p>';
            include '../view/wishlist-to-collection.php';
            exit;
        }

        // Send the data to the model
        $vinylOutcome = insertVinyl($vinylBand, $vinylAlbum, $vinylYear, $vinylCondition, $vinylGenre, $vinylImage, $userId);

        // Check and report the result. There should be a result of 1 record added so build an if statement for that
        if ($vinylOutcome === 1) {
            // Call function to delete vinyl record
            $deleteResult = deleteWishlistItem($wishlistId);

            // Check and the result
            if ($deleteResult === 1) {
  
                $_SESSION['message'] = "<p>Your wishlist item $vinylAlbum by $vinylBand has been added to your vinyl record collection and deleted from your wishlist.</p>";
                header("Location: ../vinyl/index.php?action=vinylCollection");
                exit;
            } else {
                $_SESSION['message'] = "<p>$wlVinylAlbum was successfully added to your vinyl collection but was not deleted from your wishlist. Please manually delete item from your wishlist.</p>";
                header("Location: ../vinyl/index.php?action=vinylCollection");
                exit;
            }
        } else {
            $message = "<p>Sorry, but adding $vinylAlbum to the database failed. Please try again.</p>";
            include '../view/wishlist-to-collection.php';
            exit;
        }
        break;



    default:

        include '../index.php';
}
