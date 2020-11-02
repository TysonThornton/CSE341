<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinyl Record Inventory</title>
</head>
<body>
    <h1>Browse Items</h1>
    <p>Below are vinyl records available for purchase</p>
    <p>Please select to add to cart</p>


    <div class="product">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <img src="/images/Beatles.jpg" alt="Beatles vinyl">
        <h2>The Beatles</h2>
        <h3>Abbey Road</h3>
        <span>$30.00</span>
        <input type="checkbox" value="BEATLES" name="BEATLES" id="BEATLES"> 
    </div>

    <div class="product">
        <img src="/images/Adele.jpg" alt="Adele vinyl">
        <h2>Adele</h2>
        <h3>21</h3>
        <span>$25.00</span>
        <input type="checkbox" value="ADELE" name="ADELE" id="ADELE">
    </div>

    <div class="product">
        <img src="/images/MJ.jpg" alt="Michael Jackson vinyl">
        <h2>Michael Jackson</h2>
        <h3>Thriller</h3>
        <span>$35.00</span>
        <input type="checkbox" value="MJ" name="MJ" id="MJ">
    </div>

    <div class="product">
        <img src="/images/Def.jpg" alt="Def Leppard vinyl">
        <h2>Def Leppard</h2>
        <h3>Hysteria</h3>
        <span>$20.00</span>
        <input type="checkbox" value="LEPPARD" name="LEPPARD" id="LEPPARD">
    </div>

    <div class="product">
        <img src="/images/1Direction.jpg" alt="One Direction vinyl">
        <h2>One Direction</h2>
        <h3>Made In The A.M.</h3>
        <span>$28.00</span>
        <input type="checkbox" value="ONED" name="ONED" id="ONED">
    </div>

    <div class="product">
        <img src="/images/Marley.jpg" alt="Bob Marley vinyl">
        <h2>Bob Marley</h2>
        <h3>Legend</h3>
        <span>$29.00</span>
        <input type="checkbox" value="MARLEY" name="MARLEY" id="MARLEY">
    </div>

    <div class="product">
        <img src="/images/Sinatra.jpg" alt="Frank Sinatra vinyl">
        <h2>Frank Sinatra</h2>
        <h3>Ultimate Sinatra [2 LP]</h3>
        <span>$36.00</span>
        <input type="checkbox" value="SINATRA" name="SINATRA" id="SINATRA">
    </div>

    <div class="product">
        <img src="/images/Cash.jpg" alt="Johnny Cash vinyl">
        <h2>Johnny Cash</h2>
        <h3>The Essential Johnny Cash</h3>
        <span>$22.00</span>
        <input type="checkbox" value="CASH" name="CASH" id="CASH">
    </div>
    <input type="submit" value="ADD SELECTED ITEMS TO CART">
    </form>

    <a href="viewCart.php">View Items in your cart</a>


    <?php

    $cart_items = array();


      if (isset($_POST["BEATLES"]))
      {
          $cart_item = "BEATLES";
          array_push($cart_items, $cart_item);
      }

      if (isset($_POST["ADELE"]))
      {
        $cart_item = "ADELE";
          array_push($cart_items, $cart_item);
      }

      if (isset($_POST["MJ"]))
      {
        $cart_item = "MJ";
          array_push($cart_items, $cart_item);
      }

      if (isset($_POST["LEPPARD"]))
      {
        $cart_item = "LEPPARD";
          array_push($cart_items, $cart_item);
      }

      if (isset($_POST["ONED"]))
      {
        $cart_item = "ONED";
          array_push($cart_items, $cart_item);
      }

      if (isset($_POST["MARLEY"]))
      {
        $cart_item = "MARLEY";
          array_push($cart_items, $cart_item);
      }


      

      $_SESSION['cart_items'] = $cart_items;

    //   if (isset ($_SESSION['cart_items']))
    //   {
    //       $cart_items = $_SESSION['cart_items'];
    //       foreach ($cart_items as $item) {
    //           echo $item;
    //       }
    //   }

    print_r($_SESSION);

?>

</body>
</html>