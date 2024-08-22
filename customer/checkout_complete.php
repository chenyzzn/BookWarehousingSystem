<!DOCTYPE html>
<html>
<head>
    <title>checkout complete</title>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>
<body>
    <h2>結帳完成</h2>
    <p>感謝您的訂購！您的訂單已經成功提交。</p>
    <p>訂單詳情：</p>

    <table id ="books">
        <tr>
            <th>訂單編號</th>
            <th>書籍編號</th>
            <th>數量</th>
        </tr>
    <?php
    // 建立資料庫連接

    // 定義資料庫連接資訊
    include("mysql_connect.inc.php");
    // 獲取最後一個 Bill_ID
    $getLastBillIDSQL = "SELECT MAX(Bill_ID) AS LastBillID FROM bill";
    $result = $conn->query($getLastBillIDSQL);
    $lastBillID = 50000001; // 預設為 50000001
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['LastBillID'] != null) {
            $lastBillID = $row['LastBillID'];
        }
    }

    // 獲取訂單詳情
    $orderDetailsSQL = "SELECT * FROM orders WHERE Bill_ID = $lastBillID";
    $orderDetailsResult = $conn->query($orderDetailsSQL);

    if ($orderDetailsResult->num_rows > 0) {
        while ($order = $orderDetailsResult->fetch_assoc()) {
            $orderID = $order['Order_ID'];
            $bookID = $order['Book_ID'];
            $quantity = $order['Total_Amount'];

            echo "<tr>
                    <td>$orderID</td>
                    <td>$bookID</td>
                    <td>$quantity</td>
                </tr>";
        }
        echo "</table>";

        // 获取订单总金额
        $billPriceSQL = "SELECT Bill_Price FROM bill WHERE Bill_ID = $lastBillID";
        $billPriceResult = $conn->query($billPriceSQL);
        if ($billPriceResult->num_rows > 0) {
            $billPriceRow = $billPriceResult->fetch_assoc();
            $billPrice = $billPriceRow['Bill_Price'];
            echo "<p>訂單總金額：$billPrice</p>";
        } else {
            echo "無法獲取訂單總金額。";
        }
    } else {
        echo "沒有找到訂單詳情。";
    }
    echo "<meta http-equiv=REFRESH CONTENT=5;url=clear_cart.php>";
    
    // 釋放資源並關閉連接
    $conn->close();
    ?>

</body>
</html>
