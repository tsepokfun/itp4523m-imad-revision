<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>HKIIT Supermarket</title>
</head>

<body>
  <form method="get" action="search.php">
    Categories <select name="category" required>
      <option value="">None</option>
      <option value="fruit">Fruit</option>
      <option value="snacks">Snacks</option>
      <option value="meat">Meat</option>
    </select>
    <input type="submit" name="submit" value="Find" />
  </form>
<?php
  if (isset($_GET['submit'])) {
    // connect the database
    $connection =  ___(a)___ or die(mysqli_connect_error());
    // write a SQL statement to select records which match the selected category
    $sql = "___(b)___";
    // execute the SQL statement
    $resultSet = ___(c)___ or die(mysqli_error($connection));
    if (mysqli_num_rows($resultSet) > 0) {
      echo '<p><table border="1" width="50%">       
                 <tr><th>Product</th><th>Unit</th><th>Price</th></tr>';
      while ($record = ___(d)___) // retrieve a record from the result set
        // display each retrieved record as shown in Figure B1c
        printf('<tr>___(e)___</tr>', ___(f)___);
      echo '</table></p>';
    }  // end if
    ___(g)___;  // free the result set
    mysqli_close($connection);
  }  // end if
?>
</body>
</html>