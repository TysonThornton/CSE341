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


    default:

        include '../view/vinyl-collection.php';
        break;
}
