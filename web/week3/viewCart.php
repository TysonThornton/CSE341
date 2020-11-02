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

    echo $_SESSION['cart_items'];

      if (isset ($_SESSION['cart_items']))
      {
          
          $cart_items = $_SESSION['cart_items'];
          $array_length = count($cart_items);
          $count = 1;
          foreach ($cart_items as $item) {
            $x = 'vinyl'.$count;
            $$x = $item; 
            $count++;
          }

          echo $vinyl1;
          echo $vinyl2;
          echo $vinyl3;
          echo $vinyl4;
          echo $vinyl5;
          echo $vinyl6;

      }

    ?>
    
</body>
</html>