# Day 4：B1 — PHP + MySQL Database（15 marks）⭐ 最高權重

---

## Part 1：知識點清單

| # | 語法 | 用途 | 例子 |
|---|------|------|------|
| 1 | `mysqli_connect(host, user, pass, db)` | 連接 MySQL 資料庫 | `mysqli_connect("127.0.0.1", "admin", "admin", "supermarket")` |
| 2 | `"SELECT * FROM table WHERE col = '{$_GET['cat']}'"` | SQL 查詢語句（注意引號！） | `$sql = "SELECT * FROM product WHERE prodCategory = '{$_GET['category']}'"` |
| 3 | `mysqli_query($conn, $sql)` | 執行 SQL 語句，返回 result set | `$resultSet = mysqli_query($connection, $sql)` |
| 4 | `mysqli_num_rows($rs)` | 返回 result set 的行數 | `if (mysqli_num_rows($resultSet) > 0)` |
| 5 | `mysqli_fetch_assoc($rs)` | 從 result set 取一行作為關聯數組 | `while ($record = mysqli_fetch_assoc($resultSet))` |
| 6 | `printf(format, arg1, arg2, ...)` | 格式化輸出（類似 C 的 printf） | `printf('<td>%s</td><td>%d</td>', $record['name'], $record['price'])` |
| 7 | `mysqli_free_result($rs)` | 釋放 result set 記憶體 | `mysqli_free_result($resultSet)` |
| 8 | `mysqli_close($conn)` | 關閉資料庫連接 | `mysqli_close($connection)` |

### printf 格式符號速查：
| 格式 | 對應類型 | 例子 |
|------|---------|------|
| `%s` | string | `$record['prodName']` |
| `%d` | integer | `$record['price']` |
| `%f` | float | `$record['rating']` |

---

## Part 2：原題代碼（24-25 search.php）[15 marks]

### 資料庫資訊：
```
Host: 127.0.0.1   Username: admin
Database: supermarket   Password: admin
```

### Table: product
| Column | Type | Description |
|--------|------|-------------|
| prodID | VARCHAR(4) | Primary key |
| prodCategory | VARCHAR(10) | fruit / snacks / meat |
| prodName | VARCHAR(50) | Product name |
| unit | VARCHAR(10) | 1EA / 125GM / 280GM |
| price | INT(3) | Price |

### 代碼：
```php
<form method="get" action="search.php">
  Categories <select name="category" required>
    <option value="">None</option>
    <option value="fruit">Fruit</option>
    <option value="snacks">Snacks</option>
    <option value="meat">Meat</option>
  </select>
  <input type="submit" name="submit" value="Find" />
</form>
<?php
  if (isset($_GET['submit'])) {
    // connect the database
    $connection = ___(a)___ or die(mysqli_connect_error());
    // write a SQL statement to select records which match the selected category
    $sql = "___(b)___";
    // execute the SQL statement
    $resultSet = ___(c)___ or die(mysqli_error($connection));
    if (mysqli_num_rows($resultSet) > 0) {
      echo '<p><table border="1" width="50%">
            <tr><th>Product</th><th>Unit</th><th>Price</th></tr>';
      while ($record = ___(d)___) // retrieve a record from the result set
        // display each retrieved record as shown in Figure B1c
        printf('<tr>___(e)___</tr>', ___(f)___);
      echo '</table></p>';
    }
    ___(g)___;  // free the result set
    mysqli_close($connection);
  }
?>
```

### 預期輸出（選 "Fruit"）：
```
Product     Unit    Price
Apple       1EA     6
Orange      1EA     10
Blueberry   125GM   15
```

---

## Part 3：逐空分析

### (a) `mysqli_connect("127.0.0.1", "admin", "admin", "supermarket")`
- **線索**：comment "connect the database" + 題目給了 host/user/pass/db
- **推理**：`mysqli_connect(主機, 用戶名, 密碼, 資料庫名)`
- **答案**：`mysqli_connect("127.0.0.1", "admin", "admin", "supermarket")`

### (b) `SELECT * FROM product WHERE prodCategory = '{$_GET['category']}'`
- **線索**：comment "select records which match the selected category"
- **推理**：GET form → `$_GET['category']` 有選中的值
- **⚠️ 關鍵**：字串值在 SQL 中必須用單引號包住！`'{$_GET['category']}'`
- **答案**：`SELECT * FROM product WHERE prodCategory = '{$_GET['category']}'`

### (c) `mysqli_query($connection, $sql)`
- **線索**：comment "execute the SQL statement"
- **推理**：`mysqli_query(連接, SQL語句)` → 返回 result set
- **答案**：`mysqli_query($connection, $sql)`

### (d) `mysqli_fetch_assoc($resultSet)`
- **線索**：comment "retrieve a record from the result set" + while loop
- **推理**：`mysqli_fetch_assoc()` 每次取一行，取完返回 null 結束 while
- **答案**：`mysqli_fetch_assoc($resultSet)`

### (e) 格式字串：`<td>%s</td><td>%s</td><td>%d</td>`
- **線索**：Table header 是 Product / Unit / Price
- **推理**：3 個 `<td>`，Product+Unit 是 string (%s)，Price 是 integer (%d)
- **答案**：`<td>%s</td><td>%s</td><td>%d</td>`

### (f) 參數：`$record['prodName'], $record['unit'], $record['price']`
- **線索**：上面 e 有三個 `%s %s %d`
- **推理**：按順序對應 $record 的三個 column
- **答案**：`$record['prodName'], $record['unit'], $record['price']`

### (g) `mysqli_free_result($resultSet)`
- **線索**：comment "free the result set"
- **答案**：`mysqli_free_result($resultSet)`

---

## Part 4：答案總表

| 空位 | 答案 |
|------|------|
| (a) | `mysqli_connect("127.0.0.1", "admin", "admin", "supermarket")` |
| (b) | `SELECT * FROM product WHERE prodCategory = '{$_GET['category']}'` |
| (c) | `mysqli_query($connection, $sql)` |
| (d) | `mysqli_fetch_assoc($resultSet)` |
| (e) | `<td>%s</td><td>%s</td><td>%d</td>` |
| (f) | `$record['prodName'], $record['unit'], $record['price']` |
| (g) | `mysqli_free_result($resultSet)` |

---

## Part 5：萬能公式 ⭐

```php
// ===== PHP + MySQL 萬能模板 =====

// [1] 檢查表單提交
if (isset($_GET['submit'])) {      // 或 isset($_POST['submit'])

    // [2] 連接資料庫
    $conn = mysqli_connect("主機", "用戶", "密碼", "資料庫")
             or die(mysqli_connect_error());

    // [3] 寫 SQL（字串值要包單引號！）
    $sql = "SELECT * FROM 表名 WHERE 欄名 = '{$_GET['參數']}'";

    // [4] 執行查詢
    $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // [5] 檢查是否有結果
    if (mysqli_num_rows($rs) > 0) {

        // [6] 逐行讀取 + 顯示
        while ($record = mysqli_fetch_assoc($rs)) {
            printf('<td>%s</td><td>%d</td>',
                   $record['欄名1'], $record['欄名2']);
        }
    }

    // [7] 清理
    mysqli_free_result($rs);
    mysqli_close($conn);
}
```

---

## Part 6：歷年對比

| 年份 | 場景 | 空數 | SQL 查詢方式 | 新元素 |
|------|------|------|------------|--------|
| **22-23** | Animal Adoption | 8 (a-h) | `"SELECT * FROM $table"` + dynamic `WHERE species='$species'` | 函數 `createSQL()` 內寫 SQL、`$_SERVER['REQUEST_METHOD']` |
| **23-24** | Coffee Match | 9 (a-i) | `"SELECT * FROM coffee WHERE CL=$CL AND RL=$RL"` | 函數 `getConnection($db)`、heredoc `<<<EOD`、`mysqli_num_rows($rs) == 0` |
| **24-25** | Supermarket | 7 (a-g) | `"SELECT * FROM product WHERE prodCategory='{$_GET['category']}'"` | 最經典的 mysqli 四步驟 ✅ |

### 共同 DNA（必須背熟！）：
```
mysqli_connect → mysqli_query → mysqli_fetch_assoc (while loop) → printf → mysqli_free_result → mysqli_close
```

---

## Part 7：自行練習（計時 15 分鐘）

### 練習題：23-24 coffeeMatch.php

```php
<?php
  function getConnection($db) {
    $conn = ___(a)___ or die(mysqli_connect_error());
    return $conn;
  }
  if (isset($_GET['submit'])) {
    extract($_GET);
    $conn = getConnection(___(b)___);
    $sql = "___(c)___";       // SELECT where CL=$CL AND RL=$RL
    $rs = ___(d)___ or die(mysqli_error($conn));
    if (___(e)___ == 0) {
      echo '<h2>___(f)___</h2>';   // "No coffee matched"
    } else {
      $rc = ___(g)___;
      printf("<h2>___(h)___</h2>", ___(i)___);
    }
    mysqli_free_result($rs);
    mysqli_close($conn);
  }
?>
```

### 答案（做完才看）：
| (a) | `mysqli_connect("127.0.0.1", "admin", "admin", $db)` |
| (b) | `"coffeeMatch"` |
| (c) | `SELECT * FROM coffee WHERE CL=$CL AND RL=$RL` |
| (d) | `mysqli_query($conn, $sql)` |
| (e) | `mysqli_num_rows($rs)` |
| (f) | `No coffee matched` |
| (g) | `mysqli_fetch_assoc($rs)` |
| (h) | `%s is the best match for you` |
| (i) | `$rc['coffeeName']` |
