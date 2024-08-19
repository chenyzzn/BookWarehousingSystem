<?php

// 資料庫連接設定
include("mysql_connect.inc.php");

session_start();
$userId = $_SESSION["User_ID"]; // 使用者 ID

// 清空購物車
$clearCartSql = "DELETE FROM cart WHERE User_ID='$userId'";
if ($conn->query($clearCartSql) === TRUE) {
    echo '<meta http-equiv=REFRESH CONTENT=1;url=homepage.php>';
} else {
    echo "清空購物車時出錯：" . $conn->error;
    echo '<meta http-equiv=REFRESH CONTENT=1;url=homepage.php>';
}

// 關閉資料庫連接
$conn->close();

?>
