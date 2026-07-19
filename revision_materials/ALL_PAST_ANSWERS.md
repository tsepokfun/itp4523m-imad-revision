# 📋 ALL PAST ANSWERS — ITP4523M IMAD (21-22 to 24-25)

> Consolidated answer key for all 4 past papers.  
> **Focus on 24-25** — closest pattern to this year.

---

## A3 · PHP Form Processing [11 marks each year]

| Blank | 21-22 (Mobile Plan) | 22-23 (Taxi) | 23-24 (Movie) | 24-25 (Canteen) |
|-------|--------------------|--------------|---------------|-----------------|
| (a) | `method="post"` | `isset($_POST["submit"])` | `isset($_POST["submit"])` | `isset($_POST["submit"])` |
| (b) | `required` | `$passengers > 6` | `isset($movie)` | `isset($type)` |
| (c) | `isset($_POST["submit"])` | `$error_message .= "...<br>"` | `count($movie)` | `$price > 100` |
| (d) | `isset($fee)` | `!isset($agree)` | `$numMovies == 0` | `$priceIsTooHigh` |
| (e) | `$months >= 12` | `$error_message .= "...<br>"` | `$points < 1000 && $numMovies > 1` | `$name` |
| (f) | `$months >= 6` | `$errorFlag` | `implode(" and ", $movie)` | `$price` |
| (g) | `$discount*100` | `!$errorFlag` | — | — |
| (h) | `$fee*$months*(1-$discount)` | — | — | — |

> **Pattern**: Always `isset($_POST["submit"])` → `extract($_POST)` → validate → echo.  
> Radio check = `!isset($radioVar)`. Numeric check = `$var > N`. Output uses variables from `extract()`.

---

## A4 · Cookie & Session [11 marks each year]

| Blank | 21-22 (COVID Test) | 22-23 (Shop) | 23-24 (Movie) | 24-25 (Canteen) |
|-------|-------------------|-------------|---------------|-----------------|
| (a) | `session_start()` | `session_start()` | `session_start()` | `session_start()` |
| (b) | `!isset($_COOKIE["oldest"])` | `!isset($_COOKIE["cheapest"])` | `!isset($_COOKIE["bestSales"])` | `isset($_COOKIE["lowestPrice"])` |
| (c) | `$persons` | `$promotions` | `list($mov,$sales)` | `[0][1]` |
| (d) | `$name` | `$totalPrice/$quantity` | `$sales < $bestSales` | `$lowestPrice = $price` |
| (e) | `[] = $name` | `$lowestPrice = $unitPrice` | `$_SESSION["economic"][]` | `setcookie` |
| (f) | `$person[2] > $oldestPerson[2]` | `$_SESSION["expensive"][]` | `setcookie(...)` | `1800` |
| (g) | `time()+259200` | `setcookie(...)` | `time()+10800` | `", ", $foodNames` |
| (h) | `implode(", ", $_SESSION["positive"])` | `implode(", ", $_SESSION["expensive"])` | `implode(...)` | — |

> **Pattern**: `session_start()` → check `!isset($_COOKIE[...])` → foreach process → `setcookie()` + `$_SESSION` → else read + `implode()`  
> **Time constants**: 30min=`1800` | 1hr=`3600` | 3hr=`10800` | 1day=`86400` | 3day=`259200` | 1week=`604800`

---

## A5 · AJAX + JSON [11 marks each year]

| Blank | 21-22 (Transcript) | 22-23 (Meal) | 23-24 (Movie Actors) | 24-25 (Canteen) |
|-------|-------------------|-------------|---------------------|-----------------|
| (i) | `type:"GET", url:"getJSON.php"` | `type:"GET", url:"getJSON.php"` | `url:"getJSON.php"` | `dataType: "json"` |
| (ii) | `results.student` | `data.meal[i]` | `dataType:"json"` | `searchItem(items)` |
| (iii) | `results.modules.length` | `meal.consumed > meal.limit` | `actor.gender == "M"` | `items[i].price` |
| (iv) | `numPass++` | `totalConsumed += meal.consumed` | `actor.age` | `alert(message)` |
| (v) | `numFail++` | `message += ...` | `statistics.totalAge` | `items[i].price` |
| (vi) | `totalMarks/results.modules.length` | `alert(message)` | `/ actors.length` | — |

> **Pattern**: `$.ajax({type, url, dataType, success})` → for-loop `obj.array[i]` → `alert()`.  
> PHP side: `json_encode($assocArray)`.

---

## ⭐ B1 · PHP + MySQL [15 marks each year]

| Blank | 21-22 (Card Spend) | 22-23 (Animal) | 23-24 (Coffee) | 24-25 (Supermarket) |
|-------|-------------------|----------------|----------------|---------------------|
| connect | `mysqli_connect("host","user","pass","db")` | same pattern | `mysqli_connect(...)` in function | `mysqli_connect("127.0.0.1","admin","admin","supermarket")` |
| SQL | `SELECT * FROM t WHERE cardID="$cNum"` | `SELECT * FROM $table WHERE species="$species"` | `SELECT * FROM coffee WHERE CL=$CL AND RL=$RL` | `SELECT * FROM product WHERE prodCategory="{$_GET["category"]}"` |
| execute | `mysqli_query($conn, $sql)` | same | `mysqli_query($conn, $sql)` | `mysqli_query($connection, $sql)` |
| fetch | `mysqli_fetch_assoc($rs)` | same | `mysqli_fetch_assoc($rs)` | `mysqli_fetch_assoc($resultSet)` |
| display | `printf("<td>%s</td>...", $rc["col"])` | same pattern | `printf("<h2>%s</h2>", $rc["name"])` | `printf("<tr><td>%s</td><td>%s</td><td>%d</td></tr>", $rec["a"],$rec["b"],$rec["c"])` |
| cleanup | `mysqli_free_result($rs)` | same | `mysqli_free_result($rs)` | `mysqli_free_result($resultSet)` |

> **💀 MUST memorise the 4-step mantra**:  
> `mysqli_connect` → `mysqli_query` → `mysqli_fetch_assoc` (while) → `mysqli_free_result` + `mysqli_close`  
> **SQL string trap**: `WHERE col = "{$_GET["cat"]}"` ← value MUST have single quotes!

---

## B2 · AJAX + DOM [15 marks each year]

| Blank | 21-22 (Top Songs) | 22-23 (Dinner) | 23-24 (Movie) | 24-25 (Weather) |
|-------|------------------|----------------|---------------|-----------------|
| ajax props | `url:"topsong.json", type:"GET", dataType:"json"` | same pattern | `url:"x.json", type:"GET", dataType:"json"` | `url:"weather.json", type:"GET", dataType:"json"` |
| getElement | `document.getElementById("...")` | same | same | `document.getElementById("wLogoBG")` |
| .innerHTML | `document.getElementById("x").innerHTML = val` | same | `innerHTML += trCode(...)` | `.innerHTML = ...` |
| .style | — | `.style.display = "none"` | `.style.backgroundColor = "lightyellow"` | `.style.backgroundColor = "lightblue"` |
| .src | `"song/" + arrFile[i]` | — | — | `"img/" + arrFile[logoID]` |
| .setAttribute | — | — | `.setAttribute("class", val)` | `.setAttribute("width", 128)` |

> **Pattern**: `$.ajax({url, type, dataType, success})` → `document.getElementById()` → `.innerHTML` / `.style.xxx` / `.src` / `.setAttribute()`.  
> **CSS trap**: `background-color` → `style.backgroundColor` (camelCase in JS!)

---

## B3 · JS Canvas [15 marks each year]

| Blank | 21-22 (Logo) | 22-23 (Logo) | 23-24 (Tetris) | 24-25 (Hangman) |
|-------|-------------|-------------|----------------|-----------------|
| clear | `clearRect(0,0,w,h)` | same | `clearRect(0,0,w,h)` | `clearRect` |
| text | `fillText(...)` | same | `fillText(...)` | `fillText` |
| circle | — | — | — | `Math.PI * 2` |
| moveTo | `moveTo(0,0)` | same | `translate(...)` | `x1, y1` |
| lineTo | `lineTo(w/2,0)` | same | `rotate(...)` | `x2, y2` |
| stroke/fill | `stroke()` | same | `fillRect(...)` / `strokeRect(...)` | `strokeStyle = lineColour` |
| slider | `onchange="drawDesign()"` | same | `onclick="rotateBrick(90)"` | `oninput="init()"` |

> **Pattern**: `getContext("2d")` → `clearRect(0,0,w,h)` → `fillText` / `arc` / `moveTo+lineTo` → `stroke()` / `fill()`  
> **Arc trap**: Full circle = `Math.PI * 2`, NOT `360`!

---

## 🎯 What Changed in 24-25 (This Year"s Pattern)?

| Change | Detail |
|--------|--------|
| ❌ **A1/A2 removed** | No more Python questions |
| ✅ **A3-A5 same** | Form, Cookie/Session, AJAX+JSON unchanged |
| ✅ **B1-B3 same** | MySQL, AJAX+DOM, Canvas unchanged |
| 📝 **Fewer blanks** | 24-25 has ~6-8 blanks per question vs 8-17 in earlier years |
| 🎨 **Cleaner scenarios** | Simpler data, clearer instructions |

---

> **Last tip**: The exam is "Missing Code" format — you only fill blanks `___(a)___`.  
> Read the **comment next to each blank** — it literally tells you what to write!
