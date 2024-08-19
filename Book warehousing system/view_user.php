<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
    <link rel="stylesheet" type="text/css" href="style.php">
    <h2>用戶資料</h2>
    <ul class"x">
        <li>
    <?php
    // 数据库连接设置
    include("mysql_connect.inc.php");

    // 获取用户 ID
    session_start();
    $userId = $_SESSION["User_ID"]; // 用户 ID

    // 查询用户信息
    $sql = "SELECT User_NAME, User_Phone_NUM, User_Email, VIP_Status FROM users WHERE User_ID='$userId'";
    $result = $conn->query($sql);
    ?>
    
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // 输出用户信息
            echo "用戶名: " . $row["User_NAME"] . "<br>";
            echo "電話號碼: " . $row["User_Phone_NUM"] . "<br>";
            echo "Email: " . $row["User_Email"] . "<br>";
            echo "會員等級: " . $row["VIP_Status"] . "<br>";
        }
    } else {
        echo "未找到用户信息";
    }
    ?>
</head>
<body>
    <form action="edituser.php" method="POST">
        <input type="submit" value="編輯會員資料">
    </form>

    <?php
    // 关闭数据库连接
    $conn->close();
    ?>
    <!-- 查看會員資料 -->
    <form action="ordercancel.php" method="POST">
    <input type="submit" value="查看訂單狀況">
    </form>
    <form action="homepage.php" method="POST">
    <input type="submit" value="回主頁">
    </form>
</body>
</html>
