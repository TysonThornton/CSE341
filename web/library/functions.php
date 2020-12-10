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

function passwordMatch($userPassword, $enteredPassword)
{

    if ($userPassword === $enteredPassword) {
        return true;
    } else {
        return false;
    }
}

// Build display of vinyl record collection
function buildVinylDisplay($vinylData)
{
    $vr = '<div id="vinyl-display">';
    foreach ($vinylData as $vinyl) {
        //$vr .= "<div id='vinyl-image'><img src='$vinyl[imagepath]' alt='Image of $vinyl[vinylalbum]'></div>";
        $vr .= "<div id='vinyl-detail'>";
        if (isset($vinyl['imageurl'])) {
            $image = $vinyl['imageurl'];
            $vr .= "<img src='$image'>";
        }
        $vr .= "<p>Band / Artist: $vinyl[vinylband]</p>";
        $vr .= "<p>Album: $vinyl[vinylalbum]</p>";
        $vr .= "<p>Release Year: $vinyl[vinylyear]</p>";
        $vr .= "<p>Record Condition: $vinyl[vinylcondition]</p>";
        $vr .= "<p>Genre: $vinyl[vinylgenre]</p><br></div>";
        $vr .= "<div id='vinyl-options'>";
        $vr .= "<a href='../vinyl/index.php?action=editVinyl&vinylId=$vinyl[vinylid]' title='Click to edit'>Edit</a><br>";
        $vr .= "<a href='../vinyl/index.php?action=deleteVinyl&vinylId=$vinyl[vinylid]' title='Click to delete'>Delete</a>";
        $vr .= "</div>";
    }
    $vr .= '</div>';
    return $vr;
}

// Build display of wishlist
function buildWishlistDisplay($wishlistData)
{

    $wl = '<div id="wishlist-display">';
    foreach ($wishlistData as $wishlistItem) {
        //$wl .= "<div id='wishlistItem-image'><img src='$wishlistItem[imagepath]' alt='Image of $wishlistItem[wlvinylalbum]'></div>";
        $wl .= "<div id='wishlist-item-detail'><p>Band / Artist: $wishlistItem[wlvinylband]</p>";
        $wl .= "<p>Album: $wishlistItem[wlvinylalbum]</p>";
        $wl .= "<p>Notes: $wishlistItem[wlvinylnotes]</p>";
        $wl .= "<p>Price: $$wishlistItem[wlvinylprice]</p>";
        $wl .= "<div id='wishlist-vinyl-options'>";
        $wl .= "<a href='../wishlist/index.php?action=editWlItem&wishlistId=$wishlistItem[wishlistid]' title='Click to edit'>Edit</a><br>";
        $wl .= "<a href='../wishlist/index.php?action=deleteWlItem&wishlistId=$wishlistItem[wishlistid]' title='Click to delete'>Delete</a><br>";
        $wl .= "<a href='../wishlist/index.php?action=addToCollection&wishlistId=$wishlistItem[wishlistid]' title='Click to add to your collection'>Add to Collection</a>";
        $wl .= "</div>";
    }
    $wl .= '</div>';
    return $wl;
}

// Get each price of wishlist item
function getPrices($wishlistData)
{
    $wishlistPrices = array();
    foreach ($wishlistData as $wishlistItem) {
        $wishlistPrices[] = $wishlistItem['wlvinylprice'];
    }
    return $wishlistPrices;
}

// Calculate total wishlist item prices
function calculatePriceTotal($priceArray)
{

    $total = array_sum($priceArray);
    return $total;
}
