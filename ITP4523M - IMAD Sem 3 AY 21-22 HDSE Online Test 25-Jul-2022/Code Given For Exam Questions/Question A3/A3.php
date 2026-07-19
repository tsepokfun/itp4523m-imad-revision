<html>
<head><title>Select a plan</title>
  <style type="text/css">
    input[type="submit"] {
      margin-top: 5px;
    }
    form {
      margin-bottom: 5px;
    }
  </style>
</head>
<body>
<form    ___(a)___    action="A3.php">  <!-- provide the missing attributes -->
  Prepaid <input type="number" min="1" max="24" name="months"    ___(b)___   > 
months<br>  <!-- provide the missing attribute to enforce input in this textbox -->
  Select a mobile service plan:<br>
  <input type="radio" name="fee" value="80">4G Speed ($80 per month)<br>
  <input type="radio" name="fee" value="150">5G Speed ($150 per month)<br>
  <input type="submit" value="Display Total Fee" name="submit">
</form>
<?php
extract($_POST);
if (   ___(c)___   ) {   // check if the form is submitted
  if (   ___(d)___   ) {   // check if a plan is selected
    if (   ___(e)___   )   // check if it satisfies the condition to get a 30% discount
      $discount = 0.3;
    else if (   ___(f)___   )   // check if it satisfies the condition to get a 20% discount
      $discount = 0.2;
    else
      $discount = 0;   // no discount to be given
    printf('You have %d%% discount and total fee is $%d',   ___(g)___   ,   ___(h)___   );
  } else {
    echo "You must select a plan.";
  }
}
?>
</body>
</html>