# Day 6: B3 - JavaScript Canvas (15 marks)

---

## Part 1: Knowledge Checklist

| # | Syntax | Use |
|---|--------|-----|
| 1 | `canvas.getContext("2d")` | Get 2D drawing context |
| 2 | `ctx.clearRect(0, 0, w, h)` | Erase entire canvas |
| 3 | `ctx.fillStyle = "black"` | Set fill colour |
| 4 | `ctx.strokeStyle = lineColour` | Set line/stroke colour |
| 5 | `ctx.fillText("text", x, y)` | Draw filled text |
| 6 | `ctx.beginPath()` | Start a new path |
| 7 | `ctx.arc(x, y, r, 0, Math.PI*2)` | Draw circle (full = 2*PI radians) |
| 8 | `ctx.moveTo(x1, y1)` | Move pen to coordinate |
| 9 | `ctx.lineTo(x2, y2)` | Draw line to coordinate |
| 10 | `ctx.stroke()` | Render the path outline |
| 11 | `ctx.fill()` | Fill the path |
| 12 | `ctx.save()` / `ctx.restore()` | Save/restore context state |
| 13 | `document.getElementById('id').value` | Get input/slider value |
| 14 | `parseInt(string)` | Convert string to integer |
| 15 | `oninput="init()"` | Slider event handler |

---

## Part 2: Exam Code (24-25 B3.html)

### Global + Init:
```javascript
var ctx = null;
var radius = null;

function init() {
  var canvas = document.getElementById("canvas");
  ctx = canvas.getContext("2d");
  radius = parseInt(document.getElementById ___(a)___);  // get slider value
  drawFigure();
}
```

### Draw Figure:
```javascript
function drawFigure() {
  ctx.save();
  var w = ctx.canvas.width;
  var h = ctx.canvas.height;
  ctx.___(b)___(0, 0, w, h);          // erase canvas

  ctx.fillStyle = "black";
  ctx.textAlign = "center";
  ctx.font = "bold 20px Georgia"
  ctx.___(c)___("Game Over", w/2, h-20);  // display text
  xPos = 150;
  ctx.beginPath();
  ctx.strokeRect(50, 50, 100.5, 200);     // draw rectangle
  drawLine(ctx, "white", 150.5, 70, 150.5, 250);

  // draw head (circle)
  ctx.moveTo(xPos+radius, 90);
  ctx.arc(xPos, 90, radius, 0, ___(d)___); // full circle = ?
  ctx.fill();

  // draw body
  drawLine(ctx, "black", xPos, 100, xPos, 200);

  // draw arms
  len = 35; arm_yPos = 140;
  drawLine(ctx, "black", xPos, arm_yPos, xPos-len, arm_yPos+len);
  drawLine(ctx, "black", xPos, arm_yPos, xPos+len, arm_yPos+len);

  // draw legs
  leg_yPos = 200;
  drawLine(ctx, "black", xPos, leg_yPos, xPos-len, leg_yPos+len);
  drawLine(ctx, "black", xPos, leg_yPos, xPos+len, leg_yPos+len);
  ctx.restore();
}
```

### Helper: drawLine
```javascript
function drawLine(ctx, lineColour, x1, y1, x2, y2) {
  ctx.save();
  ctx.beginPath();
  ctx.moveTo(___(e)___);     // start point
  ctx.lineTo(___(f)___);     // end point
  ctx.___(g)___;              // set line colour
  ctx.stroke();
  ctx.restore();
}
```

### HTML:
```html
<body onload="init();">
  <canvas id='canvas' width="300" height="300"></canvas>
  <div>Radius of the circle (pixels): 20
    <input type="range" min="20" max="30" value="25"
    id="radius" ___(h)___> 30</div>
</body>
```

---

## Part 3: Step-by-Step Analysis

### (a) `('radius').value`
- **Clue**: "get input value from the slider control"
- HTML: `<input type="range" id="radius">`
- `document.getElementById('radius')` returns the element, `.value` gets its value
- Wrapped in `parseInt()` to convert string->int
- **Answer**: `('radius').value`

### (b) `clearRect`
- **Clue**: "erase all drawings in the canvas"
- `clearRect(x, y, width, height)` clears a rectangular area
- Full canvas: `clearRect(0, 0, w, h)`
- **Answer**: `clearRect`

### (c) `fillText`
- **Clue**: 'display "Game Over" in canvas'
- `fillText(text, x, y)` draws filled text at position
- **Answer**: `fillText`

### (d) `Math.PI * 2`
- **Clue**: Draw a full circle using arc
- `arc(x, y, radius, startAngle, endAngle)`
- Full circle = 2*PI radians = `Math.PI * 2`
- **Answer**: `Math.PI * 2`

### (e) `x1, y1`
- **Clue**: `moveTo` takes start coordinates
- Function params: `(ctx, lineColour, x1, y1, x2, y2)`
- **Answer**: `x1, y1`

### (f) `x2, y2`
- **Clue**: `lineTo` takes end coordinates
- **Answer**: `x2, y2`

### (g) `strokeStyle = lineColour`
- **Clue**: "set the line colour"
- `strokeStyle` sets colour for path outlines
- Colour comes from function parameter `lineColour`
- **Answer**: `strokeStyle = lineColour`

### (h) `oninput="init()"` or `onchange="init()"`
- **Clue**: "set appropriate event handlers for the input control"
- The slider should redraw when value changes
- `oninput` fires continuously while sliding; `onchange` fires when released
- **Answer**: `oninput="init()"`

---

## Part 4: Answer Key

| Blank | Answer |
|-------|--------|
| (a) | `('radius').value` |
| (b) | `clearRect` |
| (c) | `fillText` |
| (d) | `Math.PI * 2` |
| (e) | `x1, y1` |
| (f) | `x2, y2` |
| (g) | `strokeStyle = lineColour` |
| (h) | `oninput="init()"` |

---

## Part 5: Universal Formula

```javascript
// ===== Canvas Drawing Template =====

// [1] Setup
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var w = ctx.canvas.width;
var h = ctx.canvas.height;

// [2] Clear
ctx.clearRect(0, 0, w, h);

// [3] Draw text
ctx.fillStyle = "black";
ctx.textAlign = "center";
ctx.font = "bold 20px Georgia";
ctx.fillText("Hello", w/2, 50);

// [4] Draw circle
ctx.beginPath();
ctx.arc(x, y, radius, 0, Math.PI * 2);  // full circle
ctx.fill();  // or ctx.stroke()

// [5] Draw rectangle
ctx.strokeRect(x, y, width, height);
// or: ctx.fillRect(x, y, width, height);

// [6] Draw line (via helper)
function drawLine(ctx, colour, x1, y1, x2, y2) {
  ctx.save();
  ctx.beginPath();
  ctx.moveTo(x1, y1);
  ctx.lineTo(x2, y2);
  ctx.strokeStyle = colour;
  ctx.stroke();
  ctx.restore();
}

// [7] Event: slider oninput
// <input type="range" id="mySlider" oninput="redraw()">
// function redraw() {
//   var val = parseInt(document.getElementById('mySlider').value);
//   // ... redraw with new val
// }
```

---

## Part 6: Cross-Year Comparison

| Year | Scenario | Core Canvas API | New Elements |
|------|----------|----------------|-------------|
| **22-23** | Polygon logo | strokeStyle, fillStyle, fillText, moveTo, lineTo, translate, rotate | `toRadian()`, coordinate rotation, `textBaseline` |
| **23-24** | Tetris brick | clearRect, fillText, translate, rotate, fillRect, strokeRect | 2D array brick, `onclick` buttons, `toRadian()` |
| **24-25** | Hangman figure | clearRect, fillText, arc, moveTo, lineTo, strokeStyle, strokeRect, fill | Slider `oninput`, `drawLine()` helper |

### Common DNA:
```
getContext("2d") -> clearRect -> fillStyle/fillText -> beginPath -> arc/moveTo/lineTo -> stroke/fill
```

---

## Part 7: Practice (12 mins)

### Exercise: 23-24 B3.html (Tetris Brick)

```javascript
var ctx = null, angle = 0, sideLen = null;

function init() {
  var canvas = document.getElementById("canvas");
  ctx = canvas.getContext("2d");
  sideLen = parseInt(document.___(a)___);      // getElementById('squareLen').value
  drawBrick();
}

function drawBrick() {
  ctx.save();
  var w = ctx.canvas.width, h = ctx.canvas.height;
  ctx.___(b)___;                                  // clearRect(0,0,w,h)

  ctx.fillStyle = "black";
  ctx.textAlign = "center";
  ctx.font = "bold 20px Georgia"
  ___(c)___("Tetris Game", w/2, 30);             // fillText

  ctx.translate(w/2, h/2);
  ctx.___(d)___;                                  // rotate(angle)

  brickWidth = brickArray[0].length * sideLen;
  brickHeight = brickArray.length * sideLen;
  startX = (0 - brickWidth)/2;
  startY = (0 - brickHeight)/2;
  y = startY;

  ctx.beginPath();
  for (r=0; r < ___(e)___; r++) {                // brickArray.length
    x = startX;
    row = brickArray[r];
    for (c=0; c < ___(f)___; c++) {              // row.length
      if (row[c] == 1) drawSquare(ctx, x, y, sideLen);
      x += sideLen;
    }
    ___(g)___;                                    // y += sideLen
  }
  ctx.restore();
}

function drawSquare(ctx, x, y, sideLen) {
  ctx.fillStyle = "yellow";
  ctx.fillRect(x, y, sideLen, sideLen);
  ctx.___(h)___;                                  // strokeRect(x,y,sideLen,sideLen)
}

function rotateBrick(rotateMore) {
  angle = ___(i)___ % 360;                        // (angle + rotateMore)
  drawBrick();
}
```

### Answers:
| (a) | (b) | (c) | (d) | (e) | (f) | (g) | (h) | (i) |
|-----|-----|-----|-----|-----|-----|-----|-----|-----|
| getElementById('squareLen').value | clearRect(0,0,w,h) | fillText | rotate(toRadian(angle)) | brickArray.length | row.length | y += sideLen | strokeRect(x,y,sideLen,sideLen) | (angle + rotateMore) |
