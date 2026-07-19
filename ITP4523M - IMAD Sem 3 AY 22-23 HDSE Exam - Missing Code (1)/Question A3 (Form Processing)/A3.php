<html>
<head><title>Call a taxi service</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h3>Kuba Taxi</h3>
<form method="post" action="A3.php">
  I need a taxi for <input type="number" min="1" name="passengers" required> passengers<br>
  Select a taxi service type:<br>
  <input type="radio" name="service" value="economic" checked>Economic ($10 per km)<br>
  <input type="radio" name="service" value="comfortable">Comfortable ($12 per km)<br>
  <input type="checkbox" name="agree" value="yes">I confirm I have read and agree to the policy.<br>
  <input type="submit" value="Request Now" name="submit">
</form>
<?php
  extract($_POST);
  // check if the form is submitted
  if (___(a)___) {   // check if the form is submitted
    $error = false;
    $error_message = "";
    if (___(b)___) {
      $error_message .= "Maximum capacity of a taxi is 6";
      $error = true;
    }
    if (___(c)___) {
      $error_message .= (___(d)___) . "You must agree to the policy";
      $error = true;
    }
    if (___(e)___) {
      echo "System is finding a taxi to provide ___(f)___ service for you .....";
    } else {
      echo "ERROR : ___(g)___";
    }
  }
?>
</body>
</html>