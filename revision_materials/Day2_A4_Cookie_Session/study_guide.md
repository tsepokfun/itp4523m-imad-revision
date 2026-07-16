# Day 2：A4 — Cookie & Session（11 marks）

---

## Part 1：知識點清單

| # | 語法 | 用途 | 例子 |
|---|------|------|------|
| 1 | `session_start()` | 開啟/恢復 session 文件 | 必須在 `<html>` 之前調用 |
| 2 | `!isset($_COOKIE['name'])` | 檢查 cookie 是否不存在（首次訪問） | `if (!isset($_COOKIE['lowestPrice']))` |
| 3 | `$arr[0][1]` | 多維數組取值 | `$order[0][1]` = 第一個 item 的 price |
| 4 | `$lowestPrice = $price` | 更新最低值 | `if ($price < $lowestPrice) $lowestPrice = $price` |
| 5 | `$_SESSION['key'] = $val` | 寫入 session 變數 | `$_SESSION['Food'] = $foodNames` |
| 6 | `setcookie(name, val, expire)` | 創建 cookie，expire = `time() + 秒數` | `setcookie("lowestPrice", $lowestPrice, time() + 1800)` |
| 7 | `implode(glue, array)` | 把 array 用分隔符串成字串 | `implode(", ", $foodNames)` → "Noodle, Toast, Pudding" |

### 時間換算必背：
| 時長 | 秒數表達式 |
|------|-----------|
| 30 分鐘 | `time() + 1800` |
| 1 小時 | `time() + 3600` |
| 3 小時 | `time() + 10800` |
| 1 天 | `time() + 86400` |
| 1 週 | `time() + 604800` |

---

## Part 2：原題代碼（24-25 A4.php）

```php
<body><?php
___(a)___;  // prepare a new session file or open the existing session file
// each item in an order: array("item name", item price (HK$), "item type")
$order = array(
  array("Noodle", 30, "Food"), array("Toast", 12, "Food"),
  array("Coffee", 20, "Drink"), array("Pudding", 25, "Food")
);
if (!___(b)___) {  // if cooke named lowestPrice is not sent from the browser
  $lowestPrice = $order___(c)___;  // assume the first item has the lowest price
  $foodNames = [];
  foreach ($order as $index => $item) {
    $name = $item[0];
    $price = $item[1];
    $type = $item[2];

    if ($type == "Food")
      $foodNames[] = $name;
    if ($price < $lowestPrice)
      ___(d)___;  // update $lowestPrice if a lower price is found
  }
  $_SESSION['Food'] = $foodNames;
  // create a cookie named lowestPrice. Cookie expires in 30 minute
  ___(e)___("lowestPrice", $lowestPrice, time() + ___(f)___);
  echo "<div>Statistics has been saved in a cookie and a session file</div>";
} else {
  $lowestPrice = $_COOKIE['lowestPrice'];
  echo "<div>The lowest price is HK\$ $lowestPrice amongst all items</div>";
  $item_names = implode(___(g)___);
  echo "<div>Food items ($item_names) are included in the order</div>";
}
?></body>
```

### 輸出：
**第 1 次執行：**
```
Statistics has been saved in a cookie and a session file
```
**第 2 次執行：**
```
The lowest price is HK$ 12 amongst all items
Food items (Noodle, Toast, Pudding) are included in the order
```

---

## Part 3：逐空分析

### (a) `session_start()`
- **Comment 說**："prepare a new session file or open the existing session file"
- **推理**：Session 相關操作，唯一答案就是 `session_start()`
- **答案**：`session_start()`

### (b) `isset($_COOKIE['lowestPrice'])`
- **Comment 說**："if cookie named lowestPrice is not sent from the browser"
- **推理**：前面有 `!` → `!isset($_COOKIE['lowestPrice'])` = cookie 不存在（首次訪問）
- **答案**：`isset($_COOKIE['lowestPrice'])`

### (c) `[0][1]`
- **Comment 說**："assume the first item has the lowest price"
- **推理**：`$order[0]` = 第一個 item = `array("Noodle", 30, "Food")`，`$order[0][1]` = 30（price）
- **答案**：`[0][1]`

### (d) `$lowestPrice = $price`
- **Comment 說**："update $lowestPrice if a lower price is found"
- **推理**：前一行 `if ($price < $lowestPrice)` → 找到更低的就把 `$lowestPrice` 更新為 `$price`
- **答案**：`$lowestPrice = $price`

### (e) `setcookie`
- **線索**：`("lowestPrice", $lowestPrice, time() + ___)` 是 `setcookie()` 的三參數形式
- **答案**：`setcookie`

### (f) `1800`
- **Comment 說**："Cookie expires in 30 minute"
- **推理**：30 分鐘 = 30 × 60 = 1800 秒
- **答案**：`1800`

### (g) `", ", $foodNames`
- **推理**：`implode(分隔符, 數組)` → 輸出為 "Noodle, Toast, Pudding" → 分隔符是 `", "`
- **答案**：`", ", $foodNames`（注意：這是兩個參數，glue + array）

---

## Part 4：答案總表

| 空位 | 答案 | 解釋 |
|------|------|------|
| (a) | `session_start()` | 啟動 session |
| (b) | `isset($_COOKIE['lowestPrice'])` | 前面有 `!` → cookie 不存在 |
| (c) | `[0][1]` | 第一個 item 的 price |
| (d) | `$lowestPrice = $price` | 更新最低價 |
| (e) | `setcookie` | PHP 創建 cookie 函數 |
| (f) | `1800` | 30 分鐘 = 1800 秒 |
| (g) | `", ", $foodNames` | 用逗號+空格串接 Food 名稱 |

---

## Part 5：萬能公式 ⭐

```php
// ===== Cookie + Session 萬能模板 =====

// [1] 必須第一行開啟 session
session_start();

// [2] 數據準備（array / foreach）
$data = array(...);

// [3] 用 cookie 判斷首次訪問還是再次訪問
if (!isset($_COOKIE['cookieName'])) {
    // === 首次訪問：處理數據，存結果 ===

    // 遍歷數據
    foreach ($data as $item) {
        // ... 計算邏輯 ...
    }

    // 存 session
    $_SESSION['key'] = $resultArray;

    // 存 cookie（name, value, expire）
    setcookie("cookieName", $value, time() + SECONDS);

    echo "Statistics saved...";
} else {
    // === 再次訪問：直接讀 cookie/session ===

    // 讀 cookie
    $val = $_COOKIE['cookieName'];

    // 讀 session + implode 成字串
    $str = implode("分隔符", $_SESSION['key']);

    echo "Data from cookie: $val";
    echo "Data from session: $str";
}
```

---

## Part 6：歷年對比

| 年份 | 場景 | 空數 | Cookie 名 | Session 變數 | 新元素 |
|------|------|------|-----------|-------------|--------|
| **22-23** | Shop promotions | 8 (a-h) | `cheapest` | `$_SESSION['expensive']` | `$promo[2]/$promo[1]` 除法計算、cookie expires in 1 week、`implode` |
| **23-24** | Movie box office | 8 (a-h) | `bestSales` | `$_SESSION['economic']` | `list()` 解構、`90<=$price && $price<=150` 範圍判斷、`[]` append |
| **24-25** | Canteen order | 7 (a-g) | `lowestPrice` | `$_SESSION['Food']` | 最簡潔：`$order[0][1]`、`$price < $lowestPrice` |

### 共同 DNA（每年必考）：
```
session_start() → 判斷 !isset($_COOKIE[...]) → foreach 處理 → 存 $_SESSION + setcookie → else 讀取並 implode 輸出
```

---

## Part 7：自行練習（計時 10 分鐘）

### 練習題：22-23 A4.php（Shop Promotions）

```php
<body><?php
___(a)___;   // prepare a new session
$promotions = array(
    array("Shop A", 1, 11), array("Shop B", 3, 27),
    array("Shop C", 2, 20), array("Shop D", 4, 38)
);
if (___(b)___) {   // if cookie named cheapest is not sent
  $lowestPrice = $promotions[0][2] / $promotions[0][1];
  $_SESSION['expensive'] = [];
  foreach (___(c)___ as $key => $promo) {
    $shop = $promo[0];
    $quantity = $promo[1];
    $totalPrice = $promo[2];
    $unitPrice = ___(d)___;
    echo "Unit price given by $shop is \$$unitPrice<br>";
    if ($unitPrice < $lowestPrice) { ___(e)___; }
    if ($unitPrice >= 10) { ___(f)___ = $shop; }
  }
  // Create a cookie named cheapest. Cookie expires in 1 week
  ___(g)___;
} else {
  $expensiveShops = ___(h)___;
  echo "You will pay more from : $expensiveShops<br>";
  $lowest = $_COOKIE['cheapest'];
  echo "The lowest unit price is \$$lowest amongst all promotions";
}
?></body>
```

### 答案（做完才看）：
| 空位 | 答案 |
|------|------|
| (a) | `session_start()` |
| (b) | `!isset($_COOKIE['cheapest'])` |
| (c) | `$promotions` |
| (d) | `$totalPrice / $quantity` |
| (e) | `$lowestPrice = $unitPrice` |
| (f) | `$_SESSION['expensive'][]` |
| (g) | `setcookie("cheapest", $lowestPrice, time() + 604800)` |
| (h) | `implode(", ", $_SESSION['expensive'])` |
