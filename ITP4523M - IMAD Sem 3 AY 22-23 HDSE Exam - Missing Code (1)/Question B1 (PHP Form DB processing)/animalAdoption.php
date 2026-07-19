<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Animal Adoption</title>
<style>
  body, input[type="submit"] { font-family: Georgia; }
  table { border: 1px solid black; width: 400px; }
  th { border: 1px; text-align: left; width: 50px; }
  td { width: 100px; }
  img { width: 100%; height: 100%; }
  input[type="radio"]:not(:first-of-type) { margin-left: 15px; }
  input[type="submit"] { font-size: 1em; margin-left: 15px; }
</style>
</head>

<body>
<?php
  function createSQL($table, $species) {
    $sql = "___(a)___";   // write a SQL statement to select records from table
    if($species != 'all')
      $sql .= "___(b)___";   // append a condition to match species
    return $sql;
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = ___(c)___;   // connect the database
    $rs = ___(d)___;   // execute the SQL statement returned by function createSQL
    if (___(e)___) {   // if number of records in result set is greater than zero
      while ($rc = ___(f)___) {  // retrieve a record from the result set
        // display each retrieved record as shown in Figure B1(b)
        printf('<table><tr><th>No.</th><td>%s</td><td rowspan="3"><img src="%s"/></td></tr>
                     <tr><th>Name</th><td>%s</td></tr>
                     <tr><th>Breed</th><td>%s</td></tr></table>',
          ___(g)___);   // provide argument values for the formatted string
        }   // end-while
      } else   // refer to Figure B1(c)
        echo "<b>___(h)___</b>";   // display a message for species not found
    echo '<br><a href="animalAdoption.php">Back</a>' ;
  } else {   // display a form as shown in Figure B1(a)
    echo '<form method="post" action="animalAdoption.php">
            Species: <input type="radio" name="species" value="all" checked="checked"/> All
             <input type="radio" name="species" value="dog" /> Dog
             <input type="radio" name="species" value="cat" /> Cat
             <input type="radio" name="species" value="rabbit" /> Rabbit
             <input type="submit" value="Search" /></form>';
  }
?>
</body>
</html>