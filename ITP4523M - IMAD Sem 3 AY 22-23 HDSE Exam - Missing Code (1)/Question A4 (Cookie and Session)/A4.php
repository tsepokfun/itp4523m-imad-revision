<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>A4</title>
  <link rel="stylesheet" href="mystyle.css" type="text/css">
</head>

<body>
<?php
___(a)___;   // prepare a new session file or open the existing session file
// promotion of the same product by each shop is represented by
// an array("shop name", quantity, total price)
// e.g. Shop C sells 2 units of product for $20. Thus, the unit price is $20 / 2 = $10
$promotions = array(
    array("Shop A", 1, 11), array("Shop B", 3, 27),
    array("Shop C", 2, 20), array("Shop D", 4, 38)
);
if (___(b)___) {   // if cookie named cheapest is not sent from the browser
  $lowestPrice = $promotions[0][2] / $promotions[0][1];
  $_SESSION['expensive'] = [];   // array to store shop names
  foreach (___(c)___ as $key => $promo) {
    $shop = $promo[0];
    $quantity = $promo[1];
    $totalPrice = $promo[2];
    $unitPrice = ___(d)___;
    echo "Unit price given by $shop is \$$unitPrice<br>";
    if ($unitPrice < $lowestPrice) {
      ___(e)___;
    }
    if ($unitPrice >= 10) {
      ___(f)___ = $shop;   // add the shop name to $_SESSION
    }
  }  // end of foreach loop
  // Create a cookie named cheapest to store the lowest unit price
  ___(g)___;  // cookie expires in 1 week
} else {
  $expensiveShops = ___(h)___;
  echo "You will pay more from : $expensiveShops<br>";
  $lowest = $_COOKIE['cheapest'];
  echo "The lowest unit price is \$$lowest amongst all promotions";
}
?>
</body>
</html>