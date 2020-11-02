<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
</head>
<body>
    <h1>View Items in Cart</h1>
    <p>Below are all the vinyl records currently in your cart</p>

    <?php

if (isset ($_SESSION['cart_items']))
    {
        
        $cart_items = $_SESSION['cart_items'];

        $vinyl1 = $cart_items[0];
        $vinyl2 = $cart_items[1]; 
        $vinyl3 = $cart_items[2]; 
        $vinyl4 = $cart_items[3]; 
        $viny15 = $cart_items[4]; 
        $vinyl6 = $cart_items[5]; 

        
        // echo $vinyl1;
        // echo $vinyl2;
        // echo $vinyl3;
        // echo $vinyl4;
        // echo $vinyl5;
        // echo $vinyl6;


    }


    

    ?>
    
</body>
</html>