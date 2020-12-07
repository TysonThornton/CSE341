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
?>
<script src="../js/vinyl.js"></script>
<?php

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
            $_SESSION['message'] = "<p>Thanks for adding $vinylAlbum by $vinylBand. It has been added to your collection.</p>";
            header("Location: ../vinyl/index.php?action=vinylCollection");
            // include '../vinyl/index.php?action=vinylCollection';
            exit;
        } else {
            $message = "<p>Sorry, but adding $vinylAlbum to the database failed. Please try again.</p>";
            include '../view/new-vinyl.php';
            exit;
        }
        break;

    case 'deleteVinyl':
        // Filter and store data
        $vinylId = filter_input(INPUT_POST, 'vinylId', FILTER_SANITIZE_NUMBER_INT);

        // Get vinyl info
        $vinylInfo = getVinylInfo($vinylId);
        // Check to see if $vinylInfo has any data in it, display error message if not
        if (count($vinylInfo) < 1) {
            $message = 'Sorry, no vinyl record information could be found.';
        }
        $vinylName = $vinylInfo['vinylname'];

        
        ?>
            <script>
                let vinylName = '<?php echo  $vinylName;?>';
                $confirmDeleteResp = confirmDelete(vinylName);
            </script>
        <?php

        if ($confirmDeleteResp) {
            echo 'This message means you confirmed the deletion';
        } else {
            echo 'This message means you canceled the deleteion';
        }


        include '../view/vinyl-collection.php';
        break;

    case 'editVinyl':
        include '../view/vinyl-collection.php';
        break;


    default:

        include '../index.php';
}
