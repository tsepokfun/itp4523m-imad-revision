<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>B1</title>
</head>

<body>
<?php
  $enqForm = <<< EOD
  <form method="get" action="spendEnquiry.php">
    <p>Card ID <input type="text" name="cNum" /></p>
    <input type="submit" value="Submit" /></form>
EOD;   
  extract($_GET);
  if (!isset($_GET['cNum']))
    echo      ___(a)___     ;  // display the enquiry form shown in Figure B1(a)
  if (isset($_GET['cNum'])) {
    // connect the database
    $conn =      ___(b)___      or die(mysqli_connect_error());
    // write a SQL statement to select records which match the entered Card ID
    $sql = "     ___(c)___     ";
    $rs =    ___(d)___    or die(mysqli_error($conn)); // execute the SQL statement
    # initialze 3 variables to store the cumulated spending for each category
    $cat1 =    ___(e)___   ;  $cat2 =    ___(e)___   ;  $cat3 =    ___(e)___   ;
    while ($rc =      ___(f)___     ) {  // retrieve a record from result set
      // calculate the amount of spending for each category
      switch (     ___(g)___     ) {
        case 1:      ___(h)___     ; break;
        case 2:      ___(i)___     ; break;
        case 3:      ___(j)___     ; break;
      }  // end-switch case
    }  // end-while loop
    echo '<table border="0" width="200">';
    // refer to Figure B1(c)
    // part (k), (l), (m): create a hyperlink has query string appended 
    // part (n): provide the four argument values for the formatted string 
    printf("<tr><td>     ___(k)___     </td><td align='right'>%.1f</td></tr>
            <tr><td>     ___(l)___     </td><td align='right'>%.1f</td></tr>
            <tr><td>     ___(m)___     </td><td align='right'>%.1f</td></tr>
            <tr><td><b>Total Spending</b></td>
                <td align='right'><b>%.1f</b></td></tr>",      ___(n)___     );
    echo '</table><br />';   
  }  // end-if
  if (isset($_GET['sCat'])) {
    // write a SQL statement to select records which match the Card ID and Category
    $sql = "     ___(o)___     ";
    $rs =    ___(d)___    or die(mysqli_error($conn)); // execute the SQL statement
    // display the table heading according to Figure B1(d)
    echo '<table border="1" width="80%">     ___(p)___     ';
    while ($rc =      ___(f)___     )   // retrieve a record from result set
      // provide the three argument values for the formatted string
      printf("<tr><td>%s</td><td>%s</td>
                  <td align='right'>%.1f</td></tr>",    ___(q)___   );
    echo '</table>';
  }  // end-if
?>
</body>
</html>