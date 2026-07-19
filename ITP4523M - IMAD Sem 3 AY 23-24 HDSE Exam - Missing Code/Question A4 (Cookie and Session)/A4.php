<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>A4 - Box Office Sales of Movies</title>
  <link rel="stylesheet" href="mystyle.css" type="text/css">
</head>

<body>
<?php
___(a)___;  // prepare a new session file or open the existing session file
// box office sales of each movie is represented by
// an array("movie name", ticket price ($), tickets sold)
// e.g. 100 tickets are sold for movie "Start Wars" with a ticket price $180.
// Thus, total sales is $180 * 100 = $18000

$movies = array(
  array("Star Wars", 180, 100), array("Superman", 100, 190),
  array("Doraemon", 120, 150), array("James Bond", 70, 200)
);

if (!___(b)___) {  // if cooke named bestSales is not sent from the browser
  $first_movie = $movies[0];
  $bestSales = $first_movie[1] * $first_movie[2];  // find total sales of first movie
  $_SESSION['economic'] = [];   // array to store movie names for ticket price is between 90 and 150 inclusively
  foreach (___(c)___) {
    // list($movie_name, $price, $numTickets) = $movie;  // array destructuring syntax
    $movie_name = $movie[0];  // find movie name from the movie record $movie
    $price = $movie[1];  // find ticket price from the movie record $movie
    $numTickets = ___(d)___;  // find tickets sold from the movie record $movie
    $sales = $price * $numTickets; ;
    if (90 <= $price && $price <= 150) {  // check ticket price is between 90 and 150 inclusively
      $_SESSION['economic']___(e)___;  // add the movie name to $_SESSION
    }
    echo "Total sales of movie $movie_name is \$$sales<br>";
    if ($sales > $bestSales) {  // check if the variable $bestSales should be updated
      $bestSales = $sales;
    }
  }  // end of foreach loop
  // create a cookie named bestSales to store the highest total sales. Cookie should expire in 3 hours
  ___(f)___;  // cookie expires in 3 hours
} else {
  $bestSales = ___(g)___;
  echo "The best total sales is \$$bestSales amongst all movies<br>";
  $movie_names = ___(h)___;
  echo "Movie(s) with ticket price is between 90 and 150 inclusively : $movie_names";
}
?>
<!--
1st execution output :
Total sales of movie Star Wars is $18000
Total sales of movie Superman is $19000
Total sales of movie Doraemon is $18000
Total sales of movie James Bond is $14000

2nd execution output :
The best total sales is $19000 amongst all movies
Movie(s) with ticket price is between 90 and 150 inclusively : Superman and Doraemon
-->
</body>
</html>