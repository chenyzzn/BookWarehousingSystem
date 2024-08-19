<?php
session_start();
include("mysql_connect.inc.php");

if (isset($_GET['bookID'])) {
    $bookID = $_GET['bookID'];
    $userID = $_SESSION["User_ID"]; // 使用者 ID

    // 获取购物车中特定书籍的当前数量
    $quantitySql = "SELECT Cart_Book_Quantity FROM cart WHERE User_ID='$userID' AND Book_ID='$bookID'";
    $quantityResult = $conn->query($quantitySql);

    if ($quantityResult->num_rows > 0) {
        $row = $quantityResult->fetch_assoc();
        $currentQuantity = $row['Cart_Book_Quantity'];

        // 如果购物车中只剩一本书，删除该书籍的购物车数据
        if ($currentQuantity == 1) {
            $deleteSql = "DELETE FROM cart WHERE User_ID='$userID' AND Book_ID='$bookID'";

            if ($conn->query($deleteSql) === TRUE) {
                echo "購物車書籍已刪除";
                echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
                // 在此处可以添加重定向或其他逻辑，如返回到购物车页面
            } else {
                echo "删除購物車書籍時出現錯誤 " . $conn->error;
                echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
            }
        } else {
            // 如果购物车中还有多本书，只减少数量
            $newQuantity = $currentQuantity - 1;
            $updateSql = "UPDATE cart SET Cart_Book_Quantity='$newQuantity' WHERE User_ID='$userID' AND Book_ID='$bookID'";

            if ($conn->query($updateSql) === TRUE) {
                echo "購物車書籍已減少";
                echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
                // 在此处可以添加重定向或其他逻辑，如返回到购物车页面
            } else {
                echo "更新購物車書籍出現錯誤: " . $conn->error;
                echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
            }
        }
    } else {
        echo "無法找到購物車書籍";
        echo '<meta http-equiv=REFRESH CONTENT=2;url=homepage.php>';
    }
}

// 可以在此处添加重定向或其他逻辑，如返回到购物车页面
?>



