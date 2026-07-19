<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Coffee Match</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
<?php
  function getConnection($db) {
    $conn = ___(a)___ or die(mysqli_connect_error());  // connect the database
    return $conn;
  }

  $matchForm = <<<EOD
    <form method="get" action="coffeeMatch.php">
    <fieldset><legend>Caffeine Level</legend>
      <input type="radio" name="CL" value="1" checked /> Decaf
      <input type="radio" name="CL" value="2" /> Regular
      <input type="radio" name="CL" value="3" /> Extra </fieldset>
    <fieldset><legend>Roast Level</legend>
      <input type="radio" name="RL" value="1" checked /> Light
      <input type="radio" name="RL" value="2" /> Medium
      <input type="radio" name="RL" value="3" /> Dark </fieldset>
    <input type="submit" name="submit" value="Match" />
  </form>
EOD;
  if (isset($_GET['submit'])) {
    extract($_GET);
    $conn = getConnection(___(b)___);
    // write a SQL statement to select record which match the selected criteria
    $sql = "___(c)___";
    $rs = ___(d)___ or die(mysqli_error($conn));  // execute the SQL statement
    if (___(e)___ == 0) {  // if no record found in result set
      echo '<h2>___(f)___</h2>';  // refer to Figure B1(c)
    } else {
      $rc = ___(g)___;   // retrieve a record from the result set
      printf("<h2>___(h)___</h2>", ___(i)___);  // refer to Figure B1(b)
    }
    mysqli_free_result($rs);
    mysqli_close($conn);
  } else {
    echo $matchForm;  // refer to Figure B1(a)
  }  // end-if
?>

</body>
</html>