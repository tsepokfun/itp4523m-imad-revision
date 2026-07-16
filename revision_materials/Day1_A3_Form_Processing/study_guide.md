# Day 1：A3 — PHP Form Processing（11 marks）

---

## Part 1：知識點清單

| # | 語法 | 用途 | 例子 |
|---|------|------|------|
| 1 | `isset($_POST['submit'])` | 檢查表單是否已提交 | `$formSubmitted = isset($_POST['submit'])` |
| 2 | `extract($_POST)` | 把 POST 數組的 key 變成同名 PHP 變數 | `$name`, `$price`, `$type` 可直接使用 |
| 3 | `!isset($var)` | 檢查變數不存在（radio button 未選時變數不會被發送） | `$typeNotSelected = !isset($type)` |
| 4 | `$price > 100` | 數值比較驗證 | `$priceIsTooHigh = $price > 100` |
| 5 | `!($err1 \|\| $err2)` | 組合多個 error flag，全為 false 才通過 | `if (!($typeNotSelected \|\| $priceIsTooHigh))` |
| 6 | `echo "<div>..."` | PHP 輸出 HTML 到瀏覽器 | 顯示成功/錯誤訊息 |

---

## Part 2：原題代碼（24-25 A3.php）

```php
<html><body>
<h3>Add Items Form (ABC Canteen)</h3>
<form method="post" action="A3.php">
  <div>Item Name <input type="text" name="name" required></div>
  <div>Item Price (HK$) <input type="number" name="price" required></div>
  <div>Item Type
    <input type="radio" name="type" value="Food">Food
    <input type="radio" name="type" value="Drink">Drink</div>
  <div><input type="submit" name="submit" value="Confirm"></div>
</form>
<?php
  $formSubmitted = ___(a)___;     // check if the form is submitted
  if ($formSubmitted) {
    extract($_POST);
    $typeNotSelected = !___(b)___; // check if Item Type is not selected
    if ($typeNotSelected)
      echo "<div>ERROR : Must select an item type</div>";

    $priceIsTooHigh = ___(c)___;   // check if Item Price is greater than 100
    if ($priceIsTooHigh)
      echo "<div>ERROR : Item price HK\$ $price is too high</div>";

    if (!($typeNotSelected || ___(d)___))  // if no input error
      echo "<div>Item ___(e)___ (HK\$ ___(f)___) will be added to system</div>";
  }
?>
</body></html>
```

### 輸出範例：
```
ERROR : Must select an item type
ERROR : Item price HK$ 300 is too high
Item Noodle (HK$ 30) will be added to system
```

---

## Part 3：逐空分析

### (a) `isset($_POST['submit'])`
- **Comment 說**："check if the form is submitted"
- **推理鏈**：form `method="post"` → submit button `name="submit"` → 提交後 `$_POST['submit']` 才存在 → 用 `isset()` 檢查
- **答案**：`isset($_POST['submit'])`

### (b) `isset($type)`
- **Comment 說**："check if Item Type is not selected"
- **推理鏈**：radio `name="type"` → 沒選時 `$_POST` 裡根本沒有 `type` 這個 key → `extract($_POST)` 後 `$type` 不存在 → `!isset($type)` 為 true
- **答案**：`isset($type)`（前面已有 `!`）

### (c) `$price > 100`
- **Comment 說**："check if Item Price is greater than 100"
- **推理鏈**：`extract($_POST)` 後 `$price` 已可用 → 直接比較
- **答案**：`$price > 100`

### (d) `$priceIsTooHigh`
- **Comment 說**："if no input error"
- **推理鏈**：no error = NOT(error1 OR error2) → error1 = `$typeNotSelected`，error2 = `$priceIsTooHigh`
- **答案**：`$priceIsTooHigh`

### (e) `$name`
- **線索**：輸出範例 "Item **Noodle** (HK$ 30)..."
- **推理鏈**：input `name="name"` → `extract($_POST)` → 變數 `$name`
- **答案**：`$name`

### (f) `$price`
- **線索**：輸出範例 "Item Noodle (HK$ **30**)..."
- **推理鏈**：input `name="price"` → `extract($_POST)` → 變數 `$price`
- **答案**：`$price`

---

## Part 4：答案總表

| 空位 | 答案 | 解釋 |
|------|------|------|
| (a) | `isset($_POST['submit'])` | POST form 的提交檢查 |
| (b) | `isset($type)` | radio button 有選才存在 |
| (c) | `$price > 100` | 價格上限驗證 |
| (d) | `$priceIsTooHigh` | 重用前面定義的 error flag |
| (e) | `$name` | 輸出 item 名稱 |
| (f) | `$price` | 輸出 item 價格 |

---

## Part 5：萬能公式 ⭐

```php
// ===== PHP Form Self-Submit 萬能模板 =====

// [1] 檢查提交（POST 或 GET）
$formSubmitted = isset($_POST['submit']);   // POST form
// $formSubmitted = isset($_GET['submit']); // GET form

if ($formSubmitted) {
    extract($_POST);  // 所有 input name 變成同名變數

    // [2] 逐項驗證，每個 error 用 bool 變數儲存
    $err1 = !isset($radioVar);       // radio 未選
    $err2 = $number > 100;           // 數值超標
    $err3 = $count < 1;              // 數量不足
    $err4 = !isset($checkboxVar);    // checkbox 未勾

    // [3] 顯示對應 error
    if ($err1) echo "ERROR: Must select...";
    if ($err2) echo "ERROR: Price too high";
    // ...

    // [4] 全部通過 → success
    if (!($err1 || $err2 || $err3 || $err4))
        echo "Success: $var1, $var2 ...";
}
```

---

## Part 6：歷年對比

| 年份 | 場景 | 空數 | 核心考點 | 新元素 |
|------|------|------|----------|--------|
| **22-23** | Taxi booking | 7 (a-g) | `isset($_POST)` + `$passengers > 6` + checkbox | `$error_message .=` 字串拼接、`!isset($agree)` checkbox |
| **23-24** | Movie tickets | 6 (a-f) | `isset($_POST)` + `count($movie)` + `points < 1000` | `$_POST['movie[]']` array checkbox、三元運算 `? :`、`implode(" and ", $movie)` |
| **24-25** | Canteen items | 6 (a-f) | `isset($_POST)` + radio 驗證 + `price > 100` | 最簡潔版本，經典 radio button 驗證 |

### 共同 DNA（每年必考）：
```
isset($_POST['submit']) → extract($_POST) → 驗證邏輯 → echo error/success
```

---

## Part 7：自行練習（計時 10 分鐘）

### 練習題：23-24 A3.php（Movie Tickets）

```php
<html><body>
<h3>Movie Club</h3>
<form method="post" action="A3.php">
  Use <input type="number" name="points" min="500" value="700" required>
  reward points (minimum is 500)<br>
  To redeem tickets of the following movies:<br>
  <input type="checkbox" name="movie[]" value="Titanic">Titanic<br>
  <input type="checkbox" name="movie[]" value="Star Wars">Star Wars<br>
  <input type="submit" value="Redeem Now" name="submit">
</form>
<?php
  // check if the form is submitted
  if (___(a)___) {
    extract($_POST);
    $numMovies = ___(b)___ ? ___(c)___ : 0;
    if (___(d)___)
      echo "ERROR : You must select at least 1 movie";
    else if ($_POST["points"] < 1000 ___(e)___)
      echo "ERROR : {$_POST["points"]} points can redeem a ticket of ONE movie only";
    else
      echo "You have redeemed $numMovies ticket(s) for : " . ___(f)___;
  }
?>
</body></html>
```

### 答案（做完才看）：
| 空位 | 答案 |
|------|------|
| (a) | `isset($_POST['submit'])` |
| (b) | `isset($movie)` |
| (c) | `count($movie)` |
| (d) | `$numMovies == 0` |
| (e) | `&& $numMovies > 1` |
| (f) | `implode(" and ", $movie)` |
