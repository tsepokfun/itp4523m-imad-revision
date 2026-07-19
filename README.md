# ITP4523M IMAD — Exam Revision Materials 🎯

> **Internet & Multimedia Applications Development**  
> HKIIT · HDSE · Semester 3 Main Exam  
> **No Python** — PHP / JavaScript / MySQL only

---

## 📊 Exam Structure

| Section | Questions | Marks Each | Total |
|---------|-----------|-----------|-------|
| **A** | A3 · A4 · A5 | 11 each | **33** |
| **B** | B1 · B2 · B3 | 15 each | **45** |
| **Total** | **6 questions** | — | **78** |

> ⚠️ A1/A2 were Python (21-23 only). **Removed from 2024-25 onwards.**

---

## 🔥 Quick-Answer Patterns (60-Second Per Question)

### A3 · PHP Form Processing [11 marks]

```php
isset($_POST["submit"]) → extract($_POST) → verify → echo
// Radio: !isset($radioVar)   Number: $val > N   Error flag: reuse $varName
// Output: $name, $price (extract turns input names into variables)
```

### A4 · Cookie & Session [11 marks]

```php
session_start()
→ if (!isset($_COOKIE["xxx"])) {  process + setcookie() + $_SESSION  }
→ else { echo $_COOKIE + implode(", ", $_SESSION) }
// Time constants: 30min=1800  1hr=3600  3hr=10800  1day=86400  1week=604800
```

### A5 · AJAX + JSON [11 marks]

```javascript
// PHP: $arr = array("key"=>"val", "items"=>array(array(...))); echo json_encode($arr);
// JS: $.ajax({type:"GET", url:"x.php", dataType:"json",
//   success: function(obj) { for(i=0; i<obj.array.length; i++) { ... } alert(msg); }})
```

### ⭐ B1 · PHP + MySQL [15 marks] — HIGHEST WEIGHT

```php
// 💀 mysqli 4-step mantra (MUST memorise):
① $conn = mysqli_connect("host","user","pass","db")
② $rs = mysqli_query($conn, $sql)
③ while($rec = mysqli_fetch_assoc($rs)) { printf("...", $rec["col"]) }
④ mysqli_free_result($rs) + mysqli_close($conn)

// printf: %s=string  %d=integer  %f=float
// SQL strings MUST wrap in single quotes: WHERE col = "{$_GET["cat"]}"
```

### B2 · AJAX + DOM [15 marks]

```javascript
$.ajax({url, type, dataType, success})
→ document.getElementById("id")
→ .innerHTML / .innerHTML += / .style.backgroundColor (camelCase!) / .src / .setAttribute("width", N)
```

### B3 · JS Canvas [15 marks]

```javascript
ctx = canvas.getContext("2d")
→ ctx.clearRect(0,0,w,h)  → ctx.fillText("text",x,y)
→ ctx.beginPath() → ctx.arc(x,y,r,0,Math.PI*2)  // full circle
→ ctx.moveTo(x1,y1) → ctx.lineTo(x2,y2)
→ ctx.strokeStyle = colour → ctx.stroke()
// Slider: <input type="range" oninput="init()">
```

---

## 📖 Study Guides (Day-by-Day)

| Day | Topic | Marks | Study Guide |
|-----|-------|-------|-------------|
| **1** | A3 · PHP Form Processing | 11 | [Day1 Study Guide](revision_materials/Day1_A3_Form_Processing/study_guide.md) |
| **2** | A4 · Cookie & Session | 11 | [Day2 Study Guide](revision_materials/Day2_A4_Cookie_Session/study_guide.md) |
| **3** | A5 · AJAX + JSON | 11 | [Day3 Study Guide](revision_materials/Day3_A5_AJAX_JSON/study_guide.md) |
| **4** | ⭐ B1 · PHP + MySQL | 15 | [Day4 Study Guide](revision_materials/Day4_B1_PHP_MySQL/study_guide.md) |
| **5** | B2 · AJAX + DOM | 15 | [Day5 Study Guide](revision_materials/Day5_B2_AJAX_DOM/study_guide.md) |
| **6** | B3 · JS Canvas | 15 | [Day6 Study Guide](revision_materials/Day6_B3_JS_Canvas/study_guide.md) |

> Each study guide contains: Knowledge Checklist → Exam Code with Blanks → Step-by-Step Analysis → Answer Key → Universal Formula → Cross-Year Comparison (22-25) → Practice Exercise

---

## 🚨 Quick Reference

| File | Description | Read Time |
|------|-------------|-----------|
| [🚨 CRAM SHEET](revision_materials/CRAM_SHEET.md) | Last-minute cheat sheet — all 6 question patterns + answers | 30 min |
| [📋 ALL PAST ANSWERS](revision_materials/ALL_PAST_ANSWERS.md) | Consolidated answer key — all 4 years (21-25) in one table | 15 min |

---

## 📚 Past Papers (4 Years)

| Year | Questions | Status |
|------|-----------|--------|
| **21-22** | A3·A4·A5 + B1·B2·B3 | ✅ Code given + analysed |
| **22-23** | A2(Python)·A3·A4·A5 + B1·B2·B3 | ✅ Code given + analysed |
| **23-24** | A1(Python)·A2(Python)·A3·A4·A5 + B1·B2·B3 | ✅ Code given + analysed |
| **24-25** | A3·A4·A5 + B1·B2·B3 | ⭐ Closest to this year |

> Past papers in: `ITP4523M - IMAD Sem 3 AY XX-XX HDSE Exam/`

---

## 🎯 Cross-Year Pattern Summary

Every year tests the **exact same 6 question types** with different scenarios:

| Q | Pattern | 21-22 Scenario | 22-23 Scenario | 23-24 Scenario | 24-25 Scenario |
|----|---------|---------------|---------------|---------------|---------------|
| A3 | Form + `isset($_POST)` + extract + validation + echo | Mobile plan | Taxi booking | Movie tickets | Canteen items |
| A4 | Cookie + Session + foreach | COVID test | Shop promotions | Movie box office | Canteen order |
| A5 | AJAX + JSON + for-loop + alert | Transcript | Meal nutrition | Movie actors | Canteen search |
| B1 | mysqli → query → fetch → printf | Credit card spend | Animal adoption | Coffee match | Supermarket |
| B2 | AJAX + DOM + getElementById | Dinner reservation | Top songs | Movie box office | Weather info |
| B3 | Canvas + clearRect + arc/line + stroke | Polygon logo | Polygon logo | Tetris brick | Hangman figure |

---

## ⚠️ Common Traps (Read Before Exam!)

| Trap | Details |
|------|---------|
| **SQL string quotes** | `WHERE col = "{$_GET["cat"]}"` — the value MUST be wrapped in single quotes inside SQL! |
| **CSS camelCase in JS** | `background-color` → `style.backgroundColor` (not `style.background-color`!) |
| **Radio button check** | `!isset($radioVar)` — unselected radio buttons don"t appear in `$_POST` at all |
| **Cookie time** | `setcookie(name, val, time() + SECONDS)` — `time()` is required, not bare seconds |
| **implode order** | `implode(glue, array)` — glue first, then array (opposite of JS `.join()`) |
| **mysqli_fetch_assoc** | returns `null` when no more rows → while loop auto-terminates. Don"t forget `$` prefix! |
| **Canvas arc** | Full circle = `Math.PI * 2`, NOT `Math.PI * 360` or `360` |
| **$.ajax dataType** | Must be `"json"` as string — not `json` without quotes! |
| **innerHTML += vs =** | `+=` appends, `=` overwrites — check the expected output carefully |
| **printf format** | `%s`=string, `%d`=integer, `%f`=float — wrong format = wrong output |

---

## ⚡ How To Use This Repo

```
1. Read CRAM_SHEET.md        (30 min → memorise all answer patterns)
2. Read B1 study guide       (15 min → highest weight, must nail mysqli 4-step)
3. Read A3 + A4 study guide  (15 min → easy marks, pattern always same)
4. Read B2 + B3 study guide  (15 min → DOM + Canvas patterns)
5. Read A5 study guide       (10 min → AJAX boilerplate)
6. Skim ALL_PAST_ANSWERS.md  (10 min → see all answers at a glance)
7. Attempt 24-25 paper       (45 min → most similar to this year)
```

---

## 🎧 Audio (Cantonese TTS)

| Day | Audio |
|-----|-------|
| Day 1 | `audio/Day1_A3_Form_Processing.mp3` |
| Day 2 | `audio/Day2_A4_Cookie_Session.mp3` |
| Day 3 | `audio/Day3_A5_AJAX_JSON.mp3` |
| Day 4 | `audio/Day4_B1_PHP_MySQL_part1.mp3` + `part2` |
| Day 5 | `audio/Day5_B2_AJAX_DOM.mp3` |
| Day 6 | `audio/Day6_B3_JS_Canvas_part1.mp3` + `part2` |

> Generate locally with `edge-tts` if missing.

---

> **Good luck! 你得嘅！** 💪
