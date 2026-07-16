# Day 5: B2 - AJAX + DOM Manipulation (15 marks)

---

## Part 1: Knowledge Checklist

| # | Syntax | Use |
|---|--------|-----|
| 1 | `document.getElementById('id')` | Get HTML element |
| 2 | `.style.backgroundColor = 'lightblue'` | Set CSS background (camelCase!) |
| 3 | `.innerHTML = '...'` | Set element content |
| 4 | `.innerHTML += '...'` | Append to element content |
| 5 | `.src = 'path/file'` | Set image source |
| 6 | `.setAttribute('height', 128)` | Set HTML attribute |
| 7 | `.width = 128` or `setAttribute('width', 128)` | Set width |
| 8 | `$.ajax({url, type, dataType, success})` | AJAX request |

---

## Part 2: Exam Code (24-25 B2.html)

### AJAX Request:
```javascript
$(document).ready(function() {
  $.ajax({
    ___(a)___,                    // three properties: url, type, dataType
    success: function(weather) {
      showWeather(weather);
    }
  });
});
```

### Display Weather:
```javascript
function showWeather(weather) {
  wLogoBG = ___(b)___;           // get element with id='wLogoBG'
  wLogoBG.___(c)___;             // set background to 'lightblue'
  wLogo = document.getElementById('wLogo');
  updateLogoByID(___(d)___);     // pass wLogo and weather.logoID
  wDate = document.getElementById('wDate');
  wTemp = document.getElementById('wTemp');
  wTempRange = document.getElementById('wTempRange');
  wHumd = document.getElementById('wHumd');

  wDate.innerHTML = 'Date:' + weather.date;
  wTemp.innerHTML = 'Temperature:' + weather.temp + '&deg;';
  wTemp.style.fontWeight = 'bold';
  wTemp.style.fontSize = '20px';
  wTempRange.innerHTML = 'Range:' + weather.highest + '&deg;';
  wTempRange.innerHTML ___(e)___;  // append lowest
  wHumd.innerHTML = 'Humidity:' + weather.humidity + '%';
}
```

### Update Logo:
```javascript
function updateLogoByID(imgLogo, logoID) {
  arrFile = ['sunny.png', 'cloudy.png', 'rain.png', 'thunderstorm.png'];
  imgLogo.src = ___(f)___;       // set image path
  imgLogo.setAttribute('height', 128);
  imgLogo.___(g)___;             // set width to 128
}
```

### JSON data (weather.json):
```json
{ "date": "2025-07-22", "temp": "30", "highest": "34",
  "lowest": "24", "humidity": "71", "logoID": 1 }
```

---

## Part 3: Step-by-Step Analysis

### (a) `url: 'weather.json', type: 'GET', dataType: 'json'`
- **Clue**: comment says "three properties are missing"
- **Reasoning**: Basic $.ajax needs url, type, dataType

### (b) `document.getElementById('wLogoBG')`
- **Clue**: comment "retrieve the element with id value 'wLogoBG'"
- HTML has `<td id="wLogoBG">`

### (c) `style.backgroundColor = 'lightblue'`
- **Clue**: "set the background colour to 'lightblue'"
- NOTE: CSS `background-color` becomes JS camelCase `backgroundColor`

### (d) `wLogo, weather.logoID`
- **Clue**: "Pass wLogo and logo ID from parameter weather"
- `updateLogoByID(imgLogo, logoID)` needs 2 args

### (e) `+= ' ~ ' + weather.lowest + '&deg;'`
- **Clue**: "append lowest data"
- `.innerHTML +=` appends (not overwrites)

### (f) `'img/' + arrFile[logoID]`
- Images in `img/` subfolder, logoID maps to arrFile index
- logoID=1 -> arrFile[1]='cloudy.png' -> 'img/cloudy.png'

### (g) `setAttribute('width', 128)`
- **Clue**: "set the width of imgLogo to 128"
- Mirrors the line above: `setAttribute('height', 128)`

---

## Part 4: Answer Key

| Blank | Answer |
|-------|--------|
| (a) | `url: 'weather.json', type: 'GET', dataType: 'json'` |
| (b) | `document.getElementById('wLogoBG')` |
| (c) | `style.backgroundColor = 'lightblue'` |
| (d) | `wLogo, weather.logoID` |
| (e) | `+= ' ~ ' + weather.lowest + '&deg;'` |
| (f) | `'img/' + arrFile[logoID]` |
| (g) | `setAttribute('width', 128)` |

---

## Part 5: Universal Formula

```javascript
// ===== AJAX + DOM Template =====
$(document).ready(function() {
  $.ajax({
    url: 'data.json',           // [1] JSON file or PHP endpoint
    type: 'GET',                // [2] HTTP method
    dataType: 'json',           // [3] auto-parse JSON
    success: function(data) {   // [4] data is JS object
      var el = document.getElementById('someId');
      el.innerHTML = data.property;        // set text
      el.innerHTML += ' append more';      // append text
      el.style.backgroundColor = 'red';    // set CSS (camelCase!)
      el.style.fontWeight = 'bold';
      el.src = 'img/' + arr[idx];          // image path
      el.setAttribute('width', 100);       // set attribute
    }
  });
});
```

---

## Part 6: Cross-Year Comparison

| Year | Scenario | Core DOM Ops | New Elements |
|------|----------|-------------|-------------|
| **22-23** | Dinner reservation | getElementById + innerHTML + time.split(':') + new Date() | Date math, dynamic CSS class |
| **23-24** | Movie box office | getElementById + innerHTML + onclick button + className | trCode() HTML gen, searchByID() |
| **24-25** | Weather info | getElementById + .style + .src + .setAttribute | Image switching, .innerHTML += |

### Common DNA:
```
$.ajax({url, type, dataType, success}) -> getElementById -> .innerHTML/.style/.src -> display
```

---

## Part 7: Practice (12 mins)

### Exercise: 23-24 B2.html (Movie Box Office)

```javascript
jsonData = null;
$(document).ready(function() {
  $.ajax({
    ___(a)___,                   // url, type, dataType
    success: function(movieSales) {
      jsonData = movieSales;
      showAllMovies(movieSales);
    }
  });
});
function showAllMovies(movieSales) {
  cinema = ___(b)___;            // getElementById('cinema')
  cinema.innerHTML += movieSales.cinema;
  movieTable = document.getElementById('movieTable');
  movies = movieSales.movies;
  for (var i = 0; i < movies.length; i++) {
    movieTable.innerHTML += trCode(___(c)___, ___(d)___);
  }
}
function searchByID(id) {
  detail = document.getElementById('detail');
  detail.___(e)___;              // style.backgroundColor = 'lightyellow'
  attrValue = document.getElementById('movieTable').___(f)___;  // .className
  ___(g)___('class', attrValue); // detail.setAttribute
  for (var i=0; i<___(h)___.length; i++) {
    m = jsonData.movies[i];
    if (___(i)___) {             // m.id == id
      detail.innerHTML = 'Movie ID : ' + m.id + ', Attendance : ' + m.attendance;
      break;
    }
  }
}
```

### Answers (check after attempt):
| (a) | (b) | (c) | (d) | (e) | (f) | (g) | (h) | (i) |
|-----|-----|-----|-----|-----|-----|-----|-----|-----|
| url:'movie.json',type:'GET',dataType:'json' | document.getElementById('cinema') | m.id | m.name | style.backgroundColor='lightyellow' | className | detail.setAttribute | jsonData.movies | m.id == id |
