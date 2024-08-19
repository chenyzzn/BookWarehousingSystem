<?php session_start();?>
<?php
// 資料庫連接設定
include("mysql_connect.inc.php");
// 獲取所有書籍資訊
if($_SESSION['User_ID'] != null)
{
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
}
else
{
	echo '<meta http-equiv=REFRESH CONTENT=0;url=login.html>';
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>賣書網站</title>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>
<body>
<h1 align="left">歡迎來到賣書網站</h1>

    <!-- 書籍搜尋表單 -->
    <form method="GET" action="search.php">
        <label for="searchInput">搜尋書籍:</label>
        <input type="text" id="searchInput" name="keyword">
        <input type="submit" value="搜尋">
    </form>


    <!-- 書籍列表 -->
    <h2>書籍列表</h2>
    <table id="books">
        <tr>
            <th>書名</th>
            <th>作者</th>
            <th>版本</th>
            <th>價格</th>
            <th>出版日期</th>
            <th>         </th>
        </tr>
        <?php
        if($_SESSION['User_ID'] != null)
        {
            $sql = "SELECT * FROM book";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['Book_Title'] . "</td>";
                    echo "<td>" . $row['Book_Author'] . "</td>";
                    echo "<td>" . $row['Book_Edition_Type'] . "</td>";
                    echo "<td>" . $row['Book_Price'] . "</td>";
                    echo "<td>" . $row['Date_of_Publication'] . "</td>";
                    echo "<td><a href='add_to_cart.php?BookId=" . $row['Book_ID'] . "'>加入購物車</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>目前沒有書籍可供顯示</td></tr>";
            }
        }
        else
        {
            echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
        }
        ?>
    </table>

<!-- 購物車 -->
<h2>購物車</h2>
<table id="books">
    <tr>
        <th>書名</th>
        <th>作者</th>
        <th>價格</th>
        <th>數量</th>
        <th>刪除</th>
    </tr>
    <?php
    session_start();
    $userId = $_SESSION["User_ID"]; // 使用者 ID
    // 獲取購物車資料
    $cartSql = "SELECT cart.*, book.Book_Title, book.Book_Author, book.Book_Price FROM cart INNER JOIN book ON cart.Book_ID = book.Book_ID WHERE User_ID='$userId'";
    $cartItems = $conn->query($cartSql);
    $totalPrice = 0; // 总金额初始化为0

    if ($cartItems->num_rows > 0) {
        while ($row = $cartItems->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Book_Title'] . "</td>";
            echo "<td>" . $row['Book_Author'] . "</td>";
            echo "<td>" . $row['Book_Price'] . "</td>";
            echo "<td>" . $row['Cart_Book_Quantity'] . "</td>";
            echo "<td><a href='clearcartbook.php?bookID=" . $row['Book_ID'] . "'>數量減少</a></td>";
            echo "</tr>";
            $totalPrice += $row['Book_Price'] * $row['Cart_Book_Quantity']; // 计算总金额
        }
    } else {
        echo "<tr><td colspan='3'>購物車是空的</td></tr>";
    }
    ?>
</table>

<!-- 購物車總額 -->
<p>購物車總額：<?php echo $totalPrice; ?></p>



    </table>
    <!-- 購物車清空按鈕 -->
    <form action="clear_cart.php" method="POST">
        <input type="submit" value="清空購物車">
    </form>
    
    <?php
    // 查询购物车中是否存在该用户的记录
    $userId= $_SESSION['User_ID'];
    $cartCheckSQL = "SELECT * FROM cart WHERE User_ID = $userId";
    $cartCheckResult = $conn->query($cartCheckSQL);

    if ($cartCheckResult->num_rows > 0) {
        // 购物车不为空，显示结账按钮
        echo '
        <!-- 结账按钮 -->
        <form action="payment.php" method="POST">
            <input type="submit" value="結帳">
        </form>';
    }
    ?>

    
    <!-- 查看會員資料 -->
    <form action="view_user.php" method="POST">
    <input type="submit" value="會員資料">
    </form>

    <!-- 登出 -->
    <form action="logout.php" method="POST">
    <input type="submit" value="登出">
    </form>

    <?php
    // 關閉資料庫連接
    $conn->close();
    ?>
</body>
</html>
