# Day 3：A5 — AJAX + JSON（11 marks）

---

## Part 1：知識點清單

### PHP 端（getJSON.php）
| # | 語法 | 用途 |
|---|------|------|
| 1 | `json_encode($assocArray)` | 把 PHP associative array 轉成 JSON 字串 |
| 2 | `header('Content-Type:Application/json')` | 告訴瀏覽器回傳的是 JSON |
| 3 | `echo $jsonString` | 輸出 JSON 給 AJAX 接收 |

### JavaScript / jQuery 端（A5.html）
| # | 語法 | 用途 |
|---|------|------|
| 4 | `$.ajax({...})` | jQuery AJAX 請求 |
| 5 | `dataType: 'json'` | 指定回傳資料類型（自動 parse JSON） |
| 6 | `success: function(obj) {...}` | 請求成功後的回調函數 |
| 7 | `obj.items` / `obj.property` | 訪問 JSON 物件的屬性 |
| 8 | `items[i].price` | 訪問 JSON array 中元素的屬性 |
| 9 | `prompt("message")` | 彈出輸入框，返回用戶輸入的字串 |
| 10 | `alert(message)` | 彈出訊息框 |

---

## Part 2：原題代碼

### PHP 端：getJSON.php（4 marks）

```php
<?php
  header('Content-Type:Application/json');
  // provide the missing code here
  $canteenOrder = array(
    "canteen" => "ABC Canteen",
    "items" => array(
      array("name" => "Toast", "price" => 12, "type" => "Food"),
      array("name" => "Coffee", "price" => 20, "type" => "Drink")
    )
  );
  echo json_encode($canteenOrder);
?>
```

### JS 端：A5.html（7 marks）

```javascript
$(document).ready(function () {
  $.ajax({
    type: 'GET',
    url: 'getJSON.php',
    ___(i)___,                           // ← 填 dataType
    success: function (orderObj) {
      totalAmount = 0;
      items = orderObj.items;
      price = ___(ii)___;                // ← 調用 searchItem
      for (i = 0; i < items.length; i++) {
        totalAmount += ___(iii)___;      // ← 取每個 item 的 price
      }
      message = "Total amount of the order is HK$" + totalAmount + ", ";
      if (price != "Item not found") {
        message += "the price is HK$" + price + " for searched item";
      } else message += "the searched item is not found";
      ___(iv)___;                        // ← 顯示 alert
    }
  });
});

function searchItem(items) {
  searchName = prompt("Enter the name of the item to search:");
  for (i = 0; i < items.length; i++)
    if (items[i].name == searchName)
      return ___(v)___;                  // ← 返回找到的 price
  return "Item not found";
}
```

### 預期輸出（用戶輸入 "Coffee"）：
```
Total amount of the order is HK$32, the price is HK$20 for searched item
```

---

## Part 3：逐空分析

### getJSON.php（無標記字母，整段代碼要自己寫）
```php
$canteenOrder = array(
    "canteen" => "ABC Canteen",
    "items" => array(
        array("name" => "Toast", "price" => 12, "type" => "Food"),
        array("name" => "Coffee", "price" => 20, "type" => "Drink")
    )
);
echo json_encode($canteenOrder);
```
- 建立一個關聯數組，結構必須跟目標 JSON 一致
- `json_encode()` 轉換後 `echo` 輸出

### (i) `dataType: 'json'`
- **線索**：success callback 收到的是 `orderObj`（已 parse 的 JS object）
- **推理**：jQuery 需要知道回傳類型才能自動 parse → `dataType: 'json'`

### (ii) `searchItem(items)`
- **線索**：下面定義了 `function searchItem(items)`，參數是 items array
- **推理**：把 `orderObj.items` 傳入 → `searchItem(items)`

### (iii) `items[i].price`
- **線索**：計算 total amount → 需要每個 item 的 price
- **推理**：JSON 結構 `items: [{name, price, type}, ...]` → `items[i].price`

### (iv) `alert(message)`
- **線索**：comment "display the alert message"
- **推理**：要顯示 message 變數 → `alert(message)`

### (v) `items[i].price`
- **線索**：comment "return the price of the item if found"
- **推理**：`items[i]` 是找到的那個 item object → `.price`

---

## Part 4：答案總表

| 空位 | 答案 |
|------|------|
| getJSON.php | `$canteenOrder = array("canteen" => ..., "items" => array(...)); echo json_encode($canteenOrder);` |
| (i) | `dataType: 'json'` |
| (ii) | `searchItem(items)` |
| (iii) | `items[i].price` |
| (iv) | `alert(message)` |
| (v) | `items[i].price` |

---

## Part 5：萬能公式 ⭐

### PHP 端（產生 JSON）：
```php
<?php
header('Content-Type:Application/json');
$data = array(
    "key1" => "value1",
    "arrayKey" => array(
        array("subKey" => value, ...),
        ...
    )
);
echo json_encode($data);
?>
```

### JS 端（接收 JSON + 處理）：
```javascript
$.ajax({
    type: 'GET',              // 或 'POST'
    url: 'target.php',        // PHP endpoint
    dataType: 'json',         // ⭐ 必填！
    success: function(obj) {  // obj 已自動 parse
        // 訪問屬性：obj.key, obj.array[i].subKey
        // 遍歷：for (i=0; i<obj.array.length; i++)
        // 輸出：alert(msg) 或 element.innerHTML = msg
    }
});
```

---

## Part 6：歷年對比

| 年份 | PHP 端 | JS 端核心邏輯 | 新元素 |
|------|--------|-------------|--------|
| **22-23** | `json_encode($mealArray)` | `for` loop + `meal.consumed > meal.limit` 計數 + `totalConsumed += meal.consumed` | `data.meal[i]` 訪問、字符串累加 `message +=` |
| **23-24** | `json_encode($movieData)` | `for` loop + `actor.gender == "M"` 性別統計 + `statistics.totalAge += actor.age` | 自訂 statistics object、`/` 除法算平均 |
| **24-25** | `json_encode($canteenOrder)` | `for` loop + `searchItem(items)` 函數調用 + `totalAmount += items[i].price` | `prompt()` 用戶輸入、`searchItem` 回傳 price |

### 共同 DNA：
```
$.ajax({ type, url, dataType, success }) → for loop 遍歷 array → alert() 輸出
```

---

## Part 7：自行練習（計時 10 分鐘）

### 練習題：23-24 A5.html（Movie Statistics）

```javascript
$(document).ready(function () {
  $.ajax({
    type: 'GET',
    ___(i)___,
    ___(ii)___,
    success: function (movieObj) {
      var statistics = { numMale: 0, numFemale: 0, totalAge: 0 };
      display(movieObj, statistics);
    }
  });
});
function display(movieObj, statistics) {
  actors = movieObj.actors;
  for (i = 0; i < actors.length; i++) {
    actor = actors[i];
    if (___(iii)___) { statistics.numMale++; }
    else { statistics.numFemale++; }
    ___(v)___ += ___(iv)___;
  }
  message = "Statistics for movie '" + movieObj.movie + "' :\n";
  message += statistics.numMale + " male and " + statistics.numFemale + " female...\n";
  message += "Average age of all actors is " + (statistics.totalAge ___(vi)___);
  alert(message);
}
```

### 答案（做完才看）：
| (i) | (ii) | (iii) | (iv) | (v) | (vi) |
|-----|------|-------|------|-----|------|
| `url: 'getJSON.php'` | `dataType: 'json'` | `actor.gender == "M"` | `actor.age` | `statistics.totalAge` | `/ actors.length` |
