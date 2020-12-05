<?php
/* This is the Vinyl Records Model */


// Insert a new product to the database
function insertProd($vinylBand, $vinylAlbum, $vinylYear, $vinylCondition, $vinylGenre, $vinylImage, $userId)
{
    // Create a connection object using the acme connection function
    $db = dbConnect();
    // The SQL statement
    $sql = 'INSERT INTO public.vinyl (vinylBand, vinylAlbum, vinylYear, vinylCondition, vinylGenre, userid)
     VALUES (:vinylBand, :vinylAlbum, :vinylYear, :vinylCondition, :vinylGenre, :userId)';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':vinylBand', $vinylBand, PDO::PARAM_STR);
    $stmt->bindValue(':vinylAlbum', $vinylAlbum, PDO::PARAM_STR);
    $stmt->bindValue(':vinylYear', $vinylYear, PDO::PARAM_INT);
    $stmt->bindValue(':vinylCondition', $vinylCondition, PDO::PARAM_STR);
    $stmt->bindValue(':vinylGenre', $vinylGenre, PDO::PARAM_STR);
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
  
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Get vinyl collection info to display
function getVinylData($userId) {

    $db = dbConnect();
    $sql = 'SELECT vinylband, vinylalbum, vinylyear, vinylcondition, vinylgenre FROM public.vinyl WHERE userid = :userId';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':userId', $userId, PDO::PARAM_STR);
    $stmt->execute();
    $vinylData = $stmt->fetch(PDO::FETCH_ASSOC);
    // Close the database interaction
    $stmt->closeCursor();
    return $vinylData;
}