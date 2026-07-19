# ITP4523M 23-24 Past Paper — Question-by-Question Explanation

> **Exam**: ITP4523M IMAD Sem 3 AY 2023-24 HDSE Exam (Missing Code)  
> **Note**: A1/A2 are Python — excluded from current syllabus. Focus on A3–B3.

---

## A3 · PHP Form Processing — Redeem Movie Tickets [11 marks, Blanks a–f]

### Scenario
User enters reward points and selects movies via checkboxes (`name="movie[]"`).

### Complete Code with Answers

```php
<?php
  if (isset($_POST["submit"])) {                      // (a) check form submitted
    extract($_POST);
    $numMovies = isset($movie) ? count($movie) : 0;   // (b)(c) count checked movies
    if ($numMovies == 0)                              // (d) no movie selected?
      echo "ERROR : You must select at least 1 movie";
    else if ($_POST["points"] < 1000 && $numMovies > 1)  // (e) insufficient points?
      echo "ERROR : {$_POST["points"]} points can redeem a ticket of ONE movie only";
    else
      echo "You have redeemed $numMovies ticket(s) for : " . implode(" and ", $movie);
      //                                                                     (f) join names
  }
?>
```

### Reasoning Per Blank

| Blank | Answer | Why |
|-------|--------|-----|
| **(a)** | `isset($_POST["submit"])` | Submit button `name="submit"`. When clicked, `$_POST["submit"]` exists. `isset()` checks this. **Universal A3 first blank.** |
| **(b)** | `isset($movie)` | `extract($_POST)` creates `$movie` from `name="movie[]"`. But if NO checkbox checked, `$_POST` has no `movie` key → `$movie` undefined → `isset()` returns false. |
| **(c)** | `count($movie)` | If `$movie` exists, it's an array. `count()` returns number of checked items. Ternary: `condition ? true_value : false_value`. |
| **(d)** | `$numMovies == 0` | Comment says "at least 1 movie" — if 0 selected, show error. |
| **(e)** | `&& $numMovies > 1` | `points < 1000` means insufficient for 2+ movies. Error only if user ALSO selected >1 movie. Single movie with low points is allowed. |
| **(f)** | `implode(" and ", $movie)` | `implode(glue, array)` joins with separator. `["Titanic","Star Wars"]` → `"Titanic and Star Wars"`. |

### Key Takeaways
- `extract($_POST)` turns every form `name` into a PHP variable
- Checkbox arrays: `isset()` first, then `count()` (unchecked checkboxes don't appear in `$_POST`)
- Ternary: `condition ? value_if_true : value_if_false`
- `implode(glue, array)` — glue FIRST (opposite of JS `.join()`)

---

## A4 · Cookie & Session — Movie Box Office [11 marks, Blanks a–h]

### Scenario
Movie sales data in a hardcoded array. First visit: calculates best sales, lists "economic" movies (price $90–150), stores in cookie + session. Second visit: reads from cookie/session.

**Data**: `array("MovieName", ticketPrice, ticketsSold)`
```
Star Wars: $180 × 100 = $18,000
Superman:  $100 × 190 = $19,000  ← best
Doraemon:  $120 × 150 = $18,000
James Bond: $70 × 200 = $14,000
```

### Complete Code with Answers

```php
<?php
session_start();                                           // (a) ALWAYS first line for session

$movies = array(
  array("Star Wars", 180, 100), array("Superman", 100, 190),
  array("Doraemon", 120, 150), array("James Bond", 70, 200)
);

if (!isset($_COOKIE["bestSales"])) {                       // (b) first visit check
  $first_movie = $movies[0];
  $bestSales = $first_movie[1] * $first_movie[2];
  $_SESSION["economic"] = [];

  foreach ($movies as $movie) {                            // (c) iterate movies
    $movie_name = $movie[0];
    $price = $movie[1];
    $numTickets = $movie[2];                               // (d) tickets sold
    $sales = $price * $numTickets;

    if (90 <= $price && $price <= 150) {
      $_SESSION["economic"][] = $movie_name;               // (e) append to array
    }
    echo "Total sales of movie $movie_name is \$$sales<br>";
    if ($sales > $bestSales) {
      $bestSales = $sales;
    }
  }
  setcookie("bestSales", $bestSales, time() + 10800);      // (f) 3 hours
} else {
  $bestSales = $_COOKIE["bestSales"];                      // (g) read cookie
  echo "The best total sales is \$$bestSales amongst all movies<br>";
  $movie_names = implode(" and ", $_SESSION["economic"]);  // (h) join names
  echo "Movie(s) with ticket price is between 90 and 150 inclusively : $movie_names";
}
?>
```

### Reasoning Per Blank

| Blank | Answer | Why |
|-------|--------|-----|
| **(a)** | `session_start()` | Must be called before any output. Opens/creates session file. **Always the first A4 blank.** |
| **(b)** | `isset($_COOKIE["bestSales"])` | Cookie name "bestSales" given in comment. `!isset(...)` = cookie doesn't exist = first visit. |
| **(c)** | `$movies as $movie` | Comment says "foreach loop". `$movies` is the array, `$movie` is each element. |
| **(d)** | `$movie[2]` | `$movie` = `array("Star Wars", 180, 100)`. Index `[0]`=name, `[1]`=price, `[2]`=tickets. |
| **(e)** | `[] = $movie_name` | `$arr[] = $val` appends to array. Adds movie name to `$_SESSION["economic"]` if price is between 90–150. |
| **(f)** | `setcookie("bestSales", $bestSales, time() + 10800)` | `setcookie(name, value, expire)`. 3 hours = 3×60×60 = 10800 seconds. |
| **(g)** | `$_COOKIE["bestSales"]` | Reading the cookie back on second visit. |
| **(h)** | `implode(" and ", $_SESSION["economic"])` | `implode(glue, array)`. `["Superman","Doraemon"]` → `"Superman and Doraemon"`. |

### Time Constants (MUST Memorise)
| Duration | Seconds | `time() + ...` |
|----------|---------|-----------------|
| 30 min | 1,800 | `time() + 1800` |
| 1 hour | 3,600 | `time() + 3600` |
| 3 hours | 10,800 | `time() + 10800` |
| 1 day | 86,400 | `time() + 86400` |
| 1 week | 604,800 | `time() + 604800` |

---

## A5 · AJAX + JSON — Movie Actors Statistics [11 marks, Blanks i–vi]

### Scenario
jQuery AJAX fetches movie JSON, then counts male/female actors and computes average age.

**getJSON.php returns**:
```json
{
  "movie": "Star Wars: The Force Awakens",
  "actors": [
    {"name":"Harrison Ford","gender":"M","age":73},
    {"name":"Carrie Fisher","gender":"F","age":59},
    {"name":"Mark Hamill","gender":"M","age":64},
    {"name":"Daisy Ridley","gender":"F","age":23}
  ]
}
```

### Complete Code with Answers

```javascript
$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "getJSON.php",                // (i) URL to fetch
    dataType: "json",                  // (ii) auto-parse JSON
    success: function (movieObj) {
      var statistics = {
        numMale: 0,
        numFemale: 0,
        totalAge: 0
      };
      display(movieObj, statistics);
    }
  });
});

function display(movieObj, statistics) {
  actors = movieObj.actors;
  for (i = 0; i < actors.length; i++) {
    actor = actors[i];
    if (actor.gender == "M") {         // (iii) check gender
      statistics.numMale++;
    } else {
      statistics.numFemale++;
    }
    statistics.totalAge += actor.age;  // (iv)(v) accumulate age
  }

  message = "Statistics for movie '" + movieObj.movie + "' :\n";
  message += statistics.numMale + " male and " + statistics.numFemale
          + " female actors participated in this movie\n";
  message += "Average age of all actors is "
          + (statistics.totalAge / actors.length);  // (vi) average

  alert(message);
}
```

### Reasoning Per Blank

| Blank | Answer | Why |
|-------|--------|-----|
| **(i)** | `url: "getJSON.php"` | First missing AJAX property — where to fetch from. |
| **(ii)** | `dataType: "json"` | Second missing AJAX property — tells jQuery to auto-parse response as JSON. |
| **(iii)** | `actor.gender == "M"` | `actor` = `{"name":"...","gender":"M","age":N}`. Check if male → count++. |
| **(iv)** | `actor.age` | Each actor's age to add to total. `statistics.totalAge += actor.age`. |
| **(v)** | `statistics.totalAge` | The accumulator variable being added to. |
| **(vi)** | `/ actors.length` | Average = total / count. `(statistics.totalAge / actors.length)`. |

### AJAX Boilerplate (MUST Memorise)
```javascript
$.ajax({
    type: "GET",           // or "POST"
    url: "target.php",     // endpoint
    dataType: "json",      // auto-parse
    success: function(obj) {
        // obj is already a JS object
        // access: obj.key, obj.array[i].subkey
    }
});
```

---

## ⭐ B1 · PHP + MySQL — Coffee Match [15 marks, Blanks a–i]

### Scenario
Radio buttons select Caffeine Level (1/2/3) and Roast Level (1/2/3). Query matches to a coffee bean in the database.

**DB**: `coffeeStock` → table `coffeeBean`  
**Host**: 127.0.0.1, **User**: admin, **Pass**: admin

| cbID | cbName | caLevel | roLevel |
|------|--------|---------|---------|
| c1101 | Decaf Peru | 1 | 1 |
| c2201 | Tanzania Isaiso | 2 | 2 |
| c2301 | Peru Norandino | 2 | 3 |
| c3301 | Bali Kintamani | 3 | 3 |
| c3201 | Java Dadar | 3 | 2 |

### Complete Code with Answers

```php
<?php
  function getConnection($db) {
    $conn = mysqli_connect("127.0.0.1", "admin", "admin", $db)  // (a) connect
            or die(mysqli_connect_error());
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

  if (isset($_GET["submit"])) {
    extract($_GET);
    $conn = getConnection("coffeeStock");                   // (b) DB name
    $sql = "SELECT * FROM coffeeBean WHERE caLevel=$CL AND roLevel=$RL";  // (c)
    $rs = mysqli_query($conn, $sql)                        // (d) execute
          or die(mysqli_error($conn));

    if (mysqli_num_rows($rs) == 0) {                       // (e) check empty
      echo "<h2>No coffee matched</h2>";                   // (f) error message
    } else {
      $rc = mysqli_fetch_assoc($rs);                       // (g) fetch row
      printf("<h2>%s is the best match for you</h2>",     // (h) format string
             $rc["cbName"]);                                // (i) coffee name
    }
    mysqli_free_result($rs);
    mysqli_close($conn);
  } else {
    echo $matchForm;
  }
?>
```

### Reasoning Per Blank

| Blank | Answer | Why |
|-------|--------|-----|
| **(a)** | `mysqli_connect("127.0.0.1", "admin", "admin", $db)` | `mysqli_connect(host, user, pass, dbName)`. `$db` is the function parameter. |
| **(b)** | `"coffeeStock"` | Database name from the SQL file: `create database coffeeStock`. |
| **(c)** | `SELECT * FROM coffeeBean WHERE caLevel=$CL AND roLevel=$RL` | SQL: `caLevel` and `roLevel` are INT columns — no quotes needed! `$CL` and `$RL` are from `extract($_GET)`. |
| **(d)** | `mysqli_query($conn, $sql)` | Execute SQL. Returns result set or false on error. |
| **(e)** | `mysqli_num_rows($rs)` | Returns number of rows in result set. `== 0` means no match found. |
| **(f)** | `No coffee matched` | Exact message from Figure B1(c) in the question paper. |
| **(g)** | `mysqli_fetch_assoc($rs)` | Fetches one row as associative array. `$rc["cbName"]` accesses column value. |
| **(h)** | `%s is the best match for you` | `printf` format string. `%s` is placeholder for the coffee name (string). |
| **(i)** | `$rc["cbName"]` | The coffee name column from the fetched row. e.g. "Tanzania Isaiso". |

### 💀 mysqli 4-Step Mantra (15 marks — MUST memorise)
```
① mysqli_connect("host","user","pass","db")
② mysqli_query($conn, $sql)
③ mysqli_fetch_assoc($rs)  ← in while() loop
④ mysqli_free_result($rs) + mysqli_close($conn)
```
> **SQL trap**: INT columns don't need quotes (`WHERE caLevel=$CL`). String columns DO (`WHERE name='$name'`).

---

## B2 · AJAX + DOM — Movie Box Office [15 marks, Blanks a–i]

### Scenario
jQuery loads `movie.json`, displays cinema name and movie table. Clicking "Show Detail" shows attendance/fare/total for that movie.

**movie.json**:
```json
{
  "cinema": "Paradise Cinema",
  "movies": [
    {"id":1, "movie":"Despicable Me 4", "attendance":564, "fare":140},
    {"id":2, "movie":"The Fall Guy", "attendance":486, "fare":130},
    {"id":3, "movie":"Star Wars", "attendance":278, "fare":105}
  ]
}
```

### Complete Code with Answers

```javascript
jsonData = null;

$(document).ready(function() {
  $.ajax({
    url: "movie.json", type: "GET", dataType: "json",   // (a) 3 properties
    success: function(movieSales) {
      jsonData = movieSales;
      showAllMovies(movieSales);
    }
  });
});

function showAllMovies(movieSales) {
  cinema = document.getElementById("cinema");             // (b) get element
  cinema.innerHTML += movieSales.cinema;

  movieTable = document.getElementById("movieTable");
  movies = movieSales.movies;
  for (var i = 0; i < movies.length; i++) {
    movieTable.innerHTML += trCode(movies[i].id,          // (c) movie id
                                    movies[i].movie);     // (d) movie name
  }
}

function trCode(id, name) {
  return "<tr>" +
    '<td><button onclick="searchByID(' + id + ')">Show Detail</button></td>' +
    "<td>" + name + " (ID : " + id + ")</td>" +
    "</tr>";
}

function searchByID(id) {
  detail = document.getElementById("detail");
  detail.style.backgroundColor = "lightyellow";           // (e) set CSS

  attrValue = document.getElementById("movieTable").className;  // (f) get class
  detail.setAttribute("class", attrValue);                // (g) set attribute

  for (var i = 0; i < jsonData.movies.length; i++) {      // (h) loop movies
    m = jsonData.movies[i];
    if (m.id == id) {                                     // (i) match ID
      detail.innerHTML = "Movie ID : " + m.id
        + ", Attendance : " + m.attendance
        + ", Fare : $" + m.fare
        + ", Total = $" + (m.attendance * m.fare);
      break;
    }
  }
}
```

### Reasoning Per Blank

| Blank | Answer | Why |
|-------|--------|-----|
| **(a)** | `url: "movie.json", type: "GET", dataType: "json"` | Comment: "three properties are missing". Standard $.ajax needs url, type, dataType. |
| **(b)** | `document.getElementById("cinema")` | HTML has `<h2 id="cinema">`. Gets the element to update its content. |
| **(c)** | `movies[i].id` | `trCode(id, name)` needs two args. First = movie ID from JSON. |
| **(d)** | `movies[i].movie` | Second arg = movie name from JSON. |
| **(e)** | `style.backgroundColor = "lightyellow"` | CSS `background-color` → JS camelCase `backgroundColor`. **Common trap!** |
| **(f)** | `className` | Gets the `class` attribute value of `<table>`. In DOM, `class` attribute is accessed via `.className` (because `class` is a reserved word in JS). |
| **(g)** | `detail.setAttribute` | `setAttribute("class", val)` sets the class attribute on the detail div. |
| **(h)** | `jsonData.movies` | Loop through all movies to find the one matching `id`. `jsonData` is the global variable storing the JSON. |
| **(i)** | `m.id == id` | Compare each movie's id with the parameter id. When found, display details and `break`. |

### DOM Methods Cheat Sheet

| Method/Property | Use |
|----------------|-----|
| `document.getElementById("id")` | Get element by ID |
| `.innerHTML = "..."` | Set HTML content (overwrites) |
| `.innerHTML += "..."` | Append HTML content |
| `.style.backgroundColor = "..."` | Set CSS (camelCase!) |
| `.className` | Get/set CSS class |
| `.setAttribute("attr", val)` | Set any HTML attribute |
| `.src = "path/file"` | Set image source |

---

## B3 · JS Canvas — Tetris Brick [15 marks, Blanks a–i]

### Scenario
Draws a Tetris brick shape on canvas using a 2D array `[[1,1,1],[0,0,1]]`. Supports rotation (clockwise/counter-clockwise) and slider for square size.

### Complete Code with Answers

```javascript
var ctx = null;
var angle = 0;
var sideLen = null;
var brickArray = [[1, 1, 1], [0, 0, 1]];

function init() {
  var canvas = document.getElementById("canvas");
  ctx = canvas.getContext("2d");
  sideLen = parseInt(document.getElementById("squareLen").value);  // (a) slider value
  drawBrick();
}

function drawBrick() {
  ctx.save();
  var w = ctx.canvas.width;
  var h = ctx.canvas.height;
  ctx.clearRect(0, 0, w, h);                            // (b) erase canvas

  ctx.fillStyle = "black";
  ctx.textAlign = "center";
  ctx.font = "bold 20px Georgia";
  ctx.fillText("Tetris Game", w/2, 30);                 // (c) draw title

  ctx.translate(w/2, h/2);
  ctx.rotate(toRadian(angle));                          // (d) rotate by angle

  brickWidth = brickArray[0].length * sideLen;
  brickHeight = brickArray.length * sideLen;
  startX = (0 - brickWidth) / 2;
  startY = (0 - brickHeight) / 2;
  y = startY;

  ctx.beginPath();
  for (r = 0; r < brickArray.length; r++) {             // (e) iterate rows
    x = startX;
    row = brickArray[r];
    for (c = 0; c < row.length; c++) {                  // (f) iterate columns
      if (row[c] == 1)
        drawSquare(ctx, x, y, sideLen);
      x += sideLen;
    }
    y += sideLen;                                       // (g) move to next row
  }
  ctx.restore();
}

function drawSquare(ctx, x, y, sideLen) {
  ctx.fillStyle = "yellow";
  ctx.fillRect(x, y, sideLen, sideLen);
  ctx.strokeRect(x, y, sideLen, sideLen);               // (h) black border
}

function rotateBrick(rotateMore) {
  angle = (angle + rotateMore) % 360;                   // (i) update angle
  drawBrick();
}

function toRadian(degree) { return degree * Math.PI / 180; }
```

### Reasoning Per Blank

| Blank | Answer | Why |
|-------|--------|-----|
| **(a)** | `getElementById("squareLen").value` | Gets slider value. `parseInt()` converts string → int. Slider `id="squareLen"`. |
| **(b)** | `clearRect(0, 0, w, h)` | Erases entire canvas. Always `(0, 0, width, height)`. |
| **(c)** | `fillText` | `fillText(text, x, y)` draws filled text on canvas. |
| **(d)** | `rotate(toRadian(angle))` | Rotates coordinate grid. `toRadian()` converts degrees → radians. |
| **(e)** | `brickArray.length` | Outer loop: iterates over rows. `brickArray` has 2 rows. |
| **(f)** | `row.length` | Inner loop: iterates over columns in current row. |
| **(g)** | `y += sideLen` | After finishing a row, move Y down by one square height so next row starts below. |
| **(h)** | `strokeRect(x, y, sideLen, sideLen)` | Draws black outline. `fillRect` fills interior, `strokeRect` outlines. |
| **(i)** | `(angle + rotateMore)` | Adds rotation amount (90° or -90°). `% 360` wraps around to keep 0–359. |

### Canvas Quick Reference

| Method | Purpose |
|--------|---------|
| `canvas.getContext("2d")` | Get 2D drawing context |
| `ctx.clearRect(0, 0, w, h)` | Erase canvas |
| `ctx.fillText("text", x, y)` | Draw filled text |
| `ctx.fillRect(x, y, w, h)` | Filled rectangle |
| `ctx.strokeRect(x, y, w, h)` | Rectangle outline |
| `ctx.translate(x, y)` | Move coordinate origin |
| `ctx.rotate(radians)` | Rotate coordinate system |
| `ctx.save()` / `ctx.restore()` | Save/restore drawing state |
| `ctx.beginPath()` | Start a new drawing path |
| `ctx.arc(x, y, r, 0, Math.PI*2)` | Full circle |
| `ctx.moveTo(x, y)` | Move pen |
| `ctx.lineTo(x, y)` | Draw line |
| `ctx.stroke()` | Render path outline |
| `ctx.fill()` | Fill path interior |

---

## 📊 23-24 Summary

| Q | Topic | Blanks | Marks | Core Pattern |
|---|-------|--------|-------|-------------|
| **A3** | PHP Form Processing | a–f (6) | 11 | `isset($_POST)` → `extract` → validate → `echo` |
| **A4** | Cookie & Session | a–h (8) | 11 | `session_start()` → check cookie → `setcookie()` + `$_SESSION` → `implode()` |
| **A5** | AJAX + JSON | i–vi (6) | 11 | `$.ajax({url,type,dataType,success})` → for-loop → `alert()` |
| **B1** | PHP + MySQL | a–i (9) | 15 | `mysqli_connect` → `query` → `fetch_assoc` → `printf` |
| **B2** | AJAX + DOM | a–i (9) | 15 | `$.ajax` → `getElementById` → `.innerHTML` / `.style.xxx` / `setAttribute` |
| **B3** | JS Canvas | a–i (9) | 15 | `getContext` → `clearRect` → `fillText` → `rotate` → `fillRect`/`strokeRect` |

> **23-24 has more blanks than 24-25** (current year simplified to ~6-8 blanks per question).  
> But the **underlying patterns are identical** — master the patterns, not the blanks!

---

> 💡 **Golden Rule**: Every blank has a comment telling you what to write. **Read the comment — it's your built-in answer key!**
