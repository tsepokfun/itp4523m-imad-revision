<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>A4 - Statistics for Canteen Order</title>
  <link rel="stylesheet" href="mystyle.css" type="text/css">
</head>

<body>
<?php
___(a)___;  // prepare a new session file or open the existing session file
// each item in an order is represented by an array :
// array("item name", item price (HK$), "item type")
// e.g. array("Noodle", 30, "Food") means an item "Noodle" of "Food" type sells for HK$ 30.
$order = array(
  array("Noodle", 30, "Food"), array("Toast", 12, "Food"),
  array("Coffee", 20, "Drink"), array("Pudding", 25, "Food")
);
if (!___(b)___) {  // if cooke named lowestPrice is not sent from the browser
  // variable $lowestPrice is created to store the lowest price found in the order
  $lowestPrice = $order___(c)___;  // assume the first item has the lowest price
  $foodNames = [];   // array $foodNames is to store item names with item type is "Food"
  foreach ($order as $index => $item) {  // loop through each item in the order
    $name = $item[0];   // get item name from array $item
    $price = $item[1];  // get item price from array $item
    $type = $item[2];   // get item type from array $item

    if ($type == "Food")  // check if the item type is "Food"
      $foodNames[] = $name;  // add the item name to $foodNames array
    if ($price < $lowestPrice)  // check if the variable $lowestPrice should be updated
      ___(d)___;  // update $lowestPrice if a lower price is found
  }  // end of foreach loop
  $_SESSION['Food'] = $foodNames;  // store the food item names in session variable
  // create a cookie named lowestPrice to store the lowest price found. Cookie expires in 30 minute
  ___(e)___("lowestPrice", $lowestPrice, time() + ___(f)___);  
  echo "<div>Statistics has been saved in a cookie and a session file</div>";
} else {
  $lowestPrice = $_COOKIE['lowestPrice'];
  echo "<div>The lowest price is HK\$ $lowestPrice amongst all items</div>";
  $item_names = implode(___(g)___);
  echo "<div>Food items ($item_names) are included in the order</div>";
}
?>
<!--
1st execution output :
Statistics has been saved in a cookie and a session file

2nd execution output :
The lowest price is HK$ 12 amongst all items
Food items (Noodle, Toast, Pudding) are included in the order
-->
</body>
</html>