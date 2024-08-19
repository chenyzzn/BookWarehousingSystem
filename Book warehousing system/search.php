<?php
    // 資料庫連接設定
    include("mysql_connect.inc.php");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>

<body>
<h2>The search list</h2>
<table id="books">
  <tr>
        <th>書籍名稱</th>
        <th>作者</th>
        <th>出版日期</th>
        <th>版本</th>
        <th>價格</th>
        <th> </th>
  </tr>
  <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // 獲取搜尋關鍵字
        $keyword = $_GET['keyword'];
    
        // 使用關鍵字進行書籍搜尋
        $sql = "SELECT * FROM book WHERE Book_Title LIKE '%$keyword%' OR Book_Author LIKE '%$keyword%'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            // 顯示搜尋結果
            while ($row = $result->fetch_assoc()) {
                // 顯示書籍詳細資訊
                echo "<tr>";
                echo "<td>" . $row['Book_Title'] . "</td>";
                echo "<td>" . $row['Book_Author'] . "</td>";
                echo "<td>" . $row['Date_of_Publication'] . "</td>";
                echo "<td>" . $row['Book_Edition_Type'] . "</td>";
                echo "<td>" . $row['Book_Price'] . "</td>";
                echo "<td><a href='add_to_cart.php?BookId=" . $row['Book_ID'] . "'>加入購物車</a></td>";
                echo "</tr>";
            }
        } else {
            echo "找不到符合搜尋條件的書籍";
            echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
        }
    }
    
    // 關閉資料庫連接
    $conn->close();
    ?>
    </table>

</body>
</html>


