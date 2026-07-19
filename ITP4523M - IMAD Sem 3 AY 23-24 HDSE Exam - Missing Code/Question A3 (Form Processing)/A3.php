<html>
<head><title>Redeem Movie Tickets</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h3>Movie Club</h3>
<form method="post" action="A3.php">
  <!-- for the "reward points" textbox :
  Set 700 as the default value. Input field must not be empty. Input value must be at least 500.
  -->
  Use <input type="number" name="points" min="500" value="700" required> reward points (minimum is 500)<br>
  To redeem tickets of the following movies:<br>
  <!-- name="movie[]" stores all values of checked checkboxes in an PHP array -->
  <input type="checkbox" name="movie[]" value="Titanic">Titanic<br>
  <input type="checkbox" name="movie[]" value="Star Wars">Star Wars<br>
  <input type="submit" value="Redeem Now" name="submit">
</form>
<?php
  // check if the form is submitted
  if (___(a)___) {
    // var_dump($_POST);
    extract($_POST);
    // $numMovies = count($movie);  # find number of movies selected
    $numMovies = ___(b)___ ? ___(c)___ : 0;  # find number of movies selected
    if (___(d)___)
      // reward points ≥ 1000 can select TWO movies, otherwise can select ONE movie only
      echo "ERROR : You must select at least 1 movie";
    else if ($_POST["points"] < 1000 ___(e)___)
      echo "ERROR : {$_POST["points"]} points can redeem a ticket of ONE movie only";
    else
      echo "You have redeemed $numMovies ticket(s) for : ". ___(f)___;
  }
?>
<!--
Same output messages :
ERROR : You must select at least 1 movie
ERROR : 700 points can redeem a ticket of ONE movie only
You have redeemed 1 ticket(s) for : Star Wars
You have redeemed 2 ticket(s) for : Titanic and Star Wars
-->
</body>
</html>