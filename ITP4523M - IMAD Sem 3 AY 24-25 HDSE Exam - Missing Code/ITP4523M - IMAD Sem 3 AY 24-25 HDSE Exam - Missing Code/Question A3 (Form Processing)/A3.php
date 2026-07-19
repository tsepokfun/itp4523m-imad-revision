<html>
<head><title>Add New Item</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h3>Add Items Form (ABC Canteen)</h3>
<form method="post" action="A3.php">
  <div>Item Name <input type="text" name="name" required></div>
  <div>Item Price (HK$) <input type="number" name="price" required></div>
  <div>Item Type 
    <input type="radio" name="type" value="Food">Food
    <input type="radio" name="type" value="Drink">Drink</div>
  <div><input type="submit" name="submit" value="Confirm"></div>
</form>
<?php
  $formSubmitted = ___(a)___;  // check if the form is submitted
  if ($formSubmitted) {  // if the form is submitted
    extract($_POST);
    $typeNotSelected = !___(b)___;  // check if Item Type is not selected
    if ($typeNotSelected)
      echo "<div>ERROR : Must select an item type</div>";

    $priceIsTooHigh = ___(c)___;    // check if Item Price is greater than 100
    if ($priceIsTooHigh)
      echo "<div>ERROR : Item price HK\$ $price is too high</div>";

    if (!($typeNotSelected || ___(d)___))   // if no input error
      echo "<div>Item ___(e)___ (HK\$ ___(f)___) will be added to system</div>";
  }
?>

<!--
Sample output messages :
ERROR : Must select an item type
ERROR : Item price HK$ 300 is too high

Item Noodle (HK$ 30) will be added to system
-->
</body>
</html>