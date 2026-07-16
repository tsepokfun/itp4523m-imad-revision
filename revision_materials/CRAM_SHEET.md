# 🚨 ITP4523M 終極雞精 — Last-Minute Cram Sheet

> 考試 1:30 PM | 唔好睇 study guide | 淨係睇呢張 | 30 分鐘睇完

---

## ⚡ 6 題答案速記（24-25 Pattern，今年最似）

---

### A3 · PHP Form Processing [11 marks]

```
萬能模板：
  isset($_POST['submit']) → extract($_POST) → 驗證 → echo

必記答案 pattern：
  (a) isset($_POST['submit'])
  (b) isset($radioVar)          ← radio button check
  (c) $price > 100              ← 任何數值比較
  (d) $errorFlag                ← 重用上面定義嘅 variable
  (e) $name                     ← extract 出嚟嘅 variable
  (f) $price                    ← extract 出嚟嘅 variable
```

---

### A4 · Cookie & Session [11 marks]

```
萬能模板：
  session_start()
  → if (!isset($_COOKIE['xxx'])) { 處理 + setcookie() + $_SESSION }
  → else { echo $_COOKIE + implode($_SESSION) }

必記答案 pattern：
  (a) session_start()
  (b) isset($_COOKIE['cookieName'])    ← 前面有 !
  (c) [0][1]                           ← 多維 array 取值
  (d) $lowestPrice = $price            ← 更新 variable
  (e) setcookie                        ← 函數名
  (f) 1800                             ← 30min = 30×60
  (g) ", ", $arrayName                 ← implode 兩個參數

時間秒數：
  30min=1800 | 1hr=3600 | 3hr=10800 | 1day=86400 | 1week=604800
```

---

### A5 · AJAX + JSON [11 marks]

```
PHP 端（getJSON.php）：
  $arr = array("key"=>"val", "items"=>array(array(...)));
  echo json_encode($arr);

JS 端（A5.html）：
  $.ajax({ type:'GET', url:'xxx.php', dataType:'json',
    success: function(obj) {
      for (i=0; i<obj.array.length; i++) {
        total += obj.array[i].property;    ← 加總
      }
      alert(message);                      ← 顯示
    }
  });

必記答案 pattern：
  (i)   dataType: 'json'
  (ii)  functionName(arrayVar)            ← call 下面定義嘅 function
  (iii) items[i].price                    ← array element property
  (iv)  alert(message)                    ← 彈出訊息
  (v)   items[i].price                    ← return found value
```

---

### ⭐ B1 · PHP + MySQL [15 marks] ← 最緊要！背熟！

```
💀 mysqli 四步曲（必定要背）：
  ① $conn = mysqli_connect("host","user","pass","db")
  ② $rs = mysqli_query($conn, $sql)
  ③ while($record = mysqli_fetch_assoc($rs)) { ... }
  ④ mysqli_free_result($rs) + mysqli_close($conn)

必記答案 pattern：
  (a) mysqli_connect("127.0.0.1","admin","admin","supermarket")
  (b) SELECT * FROM product WHERE prodCategory = '{$_GET['category']}'
      ↑ 字串要包單引號！！！
  (c) mysqli_query($connection, $sql)
  (d) mysqli_fetch_assoc($resultSet)
  (e) <td>%s</td><td>%s</td><td>%d</td>    ← printf format
  (f) $record['prodName'], $record['unit'], $record['price']
  (g) mysqli_free_result($resultSet)

printf 格式：%s=string  %d=integer  %f=float
```

---

### B2 · AJAX + DOM [15 marks]

```
萬能模板：
  $.ajax({url, type, dataType, success})
  → document.getElementById('id')
  → .innerHTML / .style.xxx / .src / .setAttribute

必記答案 pattern：
  (a) url:'xxx.json', type:'GET', dataType:'json'   ← 三個屬性
  (b) document.getElementById('elementID')
  (c) style.backgroundColor = 'lightblue'            ← CSS camelCase!
  (d) imgElement, data.logoID                         ← 兩個參數俾 function
  (e) += ' ~ ' + data.lowest + '&deg;'               ← .innerHTML += 追加
  (f) 'img/' + arrFile[logoID]                       ← 圖片路徑
  (g) setAttribute('width', 128)                      ← setAttribute
```

---

### B3 · JS Canvas [15 marks]

```
萬能模板：
  ctx = canvas.getContext("2d")
  → ctx.clearRect(0,0,w,h)
  → ctx.fillStyle / ctx.fillText / ctx.beginPath
  → ctx.arc(x,y,r,0,Math.PI*2) / ctx.moveTo / ctx.lineTo
  → ctx.stroke() / ctx.fill()

必記答案 pattern：
  (a) ('radius').value                                ← getElementById + .value
  (b) clearRect                                       ← 清除畫布
  (c) fillText                                        ← 畫文字
  (d) Math.PI * 2                                     ← 完整圓圈弧度
  (e) x1, y1                                          ← moveTo 參數
  (f) x2, y2                                          ← lineTo 參數
  (g) strokeStyle = lineColour                        ← 線條顏色
  (h) oninput="init()"                                ← slider event
```

---

## 🎯 最後 3 個 tips：

1. **所有題目都係 "Missing Code"** — 唔駛自己由零寫，只需填 `___(a)___`
2. **睇 comment！** — 每個空隔離都有 comment 話你知要填咩
3. **B1 mysqli 四步曲係 15 分** — 一定要背：connect → query → fetch → free

---

## ⏱️ 聽朝時間表：

| 時間 | 做咩 |
|------|------|
| 8:00-8:30 | 睇呢張雞精 + 背 B1 mysqli |
| 8:30-9:00 | 揭一次 24-25 PDF，認得題目結構 |
| 9:00-9:30 | 背 A3/A4/A5 答案 pattern |
| 9:30-10:00 | 背 B2/B3 答案 pattern |
| 10:00-12:00 | 😴 休息 / 再 loop 多一次 |
| 12:00-1:00 | 搭車時聽 audio mp3 |
| 1:30 | 💪 考試！ |

---

**Good luck! 你得嘅！**
