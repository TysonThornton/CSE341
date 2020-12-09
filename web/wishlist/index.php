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
        $wishlistlData = getWishlistData($sessionUserId);

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




    default:

        include '../index.php';
}
