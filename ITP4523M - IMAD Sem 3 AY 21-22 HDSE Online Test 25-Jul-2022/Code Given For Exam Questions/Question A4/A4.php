<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>A4</title>
  <link rel="stylesheet" href="mystyle.css" type="text/css">
</head>
<body>
<?php
   ___(a)___   ;   // prepare a new session file or open the existing session file
$persons = array(
    array("Jack", "positive", 30), array("Mary", "negative", 21),
    array("Judy", "negative", 50), array("Alan", "positive", 28)
);
if (   ___(b)___   ) {   // if cookie named oldest is not received by the web server
  // $oldestPerson will store the information of the oldest person
  $oldestPerson = $persons[0];
  $_SESSION['positive'] = [];
  foreach (   ___(c)___    as $key => $person) {
    $name = $person[0];    $result = $person[1];    $age = $person[2];
    echo "Test result for    ___(d)___   <br>";
    if ($result == "positive") { 
      $_SESSION['positive']   ___(e)___   ;   // add the person's name to $_SESSION
    }   // end-if
    if (   ___(f)___   ) {   // if an older person is found, update variable $oldestPerson
      $oldestPerson = $person;
    }   // end-if
  }   // end of foreach loop
  setcookie("oldest", $oldestPerson[0],    ___(g)___   );  // cookie expires in 3 days
} else {
  $oldestPerson = $_COOKIE['oldest'];
  echo "The oldest person is $oldestPerson<br>";
  $positivePeople =    ___(h)___   ;  // join the names of people found in $_SESSION
  echo "People with COVID-19 positive test result : $positivePeople";
}   // end-if
?>
</body>
</html>