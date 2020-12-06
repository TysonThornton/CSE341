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

// Build dispaly of vinyl record collection
function buildVinylDisplay($vinylData) 
{
        $vr = '<div id="vinyl-display">';
        foreach ($vinylData as $vinyl) {
            //$vr .= "<div id='vinyl-image'><img src='$vinyl[imagepath]' alt='Image of $vinyl[vinylalbum]'></div>";
            $vr .= "<div id='vinyl-detail'><p>Band / Artist: $vinyl[vinylband]</p>";
            $vr .= "<p>Album: $vinyl[vinylalbum]</p>";
            $vr .= "<p>Release Year: $vinyl[vinylyear]</p>";
            $vr .= "<p>Record Condition: $vinyl[vinylcondition]</p>";
            $vr .= "<p>Genre: $vinyl[vinylgenre]</p><br></div>";
            $vr .= "<div id='vinyl-options'>";
            $vr .= "a href='../vinyl/index.php?action=edit&vinylId=$vinyl[vinylid]' title='Click to edit'>Edit</a>";
            $vr .= "a href='../vinyl/index.php?action=delete&vinylId=$vinyl[vinylid]' title='Click to delete'>Delete</a>";
            $vr .= "</div>";
        }
        $vr .= '</div>';
        return $vr;

}