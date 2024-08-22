<?php

session_start();

// 資料庫連接設定
include("mysql_connect.inc.php");

function addToCart($userId, $bookId, $quantity) {
    global $conn;

    // 獲取最後一個 Cart_ID
    $getLastCartIdSql = "SELECT Cart_ID FROM cart ORDER BY Cart_ID DESC LIMIT 1";
    $lastCartIdResult = $conn->query($getLastCartIdSql);
    $lastCartId = ($lastCartIdResult->num_rows > 0) ? $lastCartIdResult->fetch_assoc()['Cart_ID'] : 0;
    $newCartId = str_pad($lastCartId + 1, 8, '0', STR_PAD_LEFT);

    // 檢查書籍是否存在
    $bookSql = "SELECT * FROM book WHERE Book_ID='$bookId'";
    $bookResult = $conn->query($bookSql);
    if ($bookResult->num_rows > 0) {
        // 檢查書籍庫存數量
        $inventorySql = "SELECT * FROM inventory WHERE Book_ID='$bookId'";
        $inventoryResult = $conn->query($inventorySql);
        if ($inventoryResult->num_rows > 0) {
            $inventoryRow = $inventoryResult->fetch_assoc();
            $bookInventory = $inventoryRow['Book_Quantity']; // assuming your inventory table has a column called 'Book_Quantity'

            // 檢查書籍是否已添加到購物車
            $cartSql = "SELECT * FROM cart WHERE User_ID='$userId' AND Book_ID='$bookId'";
            $cartResult = $conn->query($cartSql);
            if ($cartResult->num_rows > 0) {
                // 書籍已在購物車中，更新購物車中的數量
                $cartRow = $cartResult->fetch_assoc();
                $cartId = $cartRow['Cart_ID'];
                $cartQuantity = $cartRow['Cart_Book_Quantity'] + $quantity;

                // 檢查更新後的數量是否超過庫存
                if ($cartQuantity > $bookInventory) {
                    echo "購物車中的書本數量超過庫存數量";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=homepage.php>';
                    return;
                }

                $updateSql = "UPDATE cart SET Cart_Book_Quantity='$cartQuantity' WHERE Cart_ID='$cartId'";
                if ($conn->query($updateSql) === TRUE) {
                    echo "書籍已成功更新到購物車";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=homepage.php>';
                } else {
                    echo "更新購物車時發生錯誤: " . $conn->error;
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=homepage.php>';
                }
            } else {
                // 添加書籍到購物車
                if ($quantity > $bookInventory) {
                    echo "購物車中的書本數量超過庫存數量";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=homepage.php>';
                    return;
                }
                
                $insertSql = "INSERT INTO cart (Cart_ID, User_ID, Book_ID, Cart_Book_Quantity) VALUES ('$newCartId', '$userId', '$bookId', '$quantity')";
                if ($conn->query($insertSql) === TRUE) {
                    echo "書籍已成功添加到購物車";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=homepage.php>';
                } else {
                    echo "添加書籍到購物車時發生錯誤: " . $conn->error;
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=homepage.php>';
                }
            }
        } else {
            echo "無法找到書籍的庫存資訊";
        }
    } else {
        echo "書籍不存在";
    }
}

$userId = $_SESSION["User_ID"]; // 使用者 ID
$bookId = $_GET["BookId"]; // 書籍 ID
$quantity = 1; // 預設書籍數量為 1

addToCart($userId, $bookId, $quantity);

?>
