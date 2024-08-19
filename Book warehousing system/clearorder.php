<?php
include("mysql_connect.inc.php");

if (isset($_GET['Bill_ID'])) {
    $billID = $_GET['Bill_ID'];

    // 执行删除订单的操作，例如使用 DELETE 语句
    $sql = "DELETE FROM orders WHERE Bill_ID = '$billID'";

    if ($conn->query($sql) === TRUE) {
        echo "訂單取消成功";
        echo '<meta http-equiv=REFRESH CONTENT=2;url=ordercancel.php>';
    } else {
        echo "取消訂單時出現錯誤: " . $conn->error;
    }
}

// 可以在此处添加重定向或其他逻辑，如返回到订单列表页面
?>