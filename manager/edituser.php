<?php
// 数据库连接设置
include("mysql_connect.inc.php");

// 获取用户 ID
session_start();
$userId = $_SESSION["User_ID"]; // 用户 ID

// 查询用户信息
$sql = "SELECT User_NAME, User_Phone_NUM, User_Email, User_Password FROM users WHERE User_ID='$userId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userName = $row["User_NAME"];
    $userPhoneNum = $row["User_Phone_NUM"];
    $userEmail = $row["User_Email"];
    $userpassword = $row["User_Password"];
} else {
    echo "未找到用户信息";
}

// 关闭数据库连接
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>編輯會員資料</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h2>編輯會員資料</h2>
<form action="edituser_finish.php" method="post">
    <label for="userName">名字：</label>
    <input type="text" id="userName" name="username" value="<?php echo $userName; ?>"><br>

    <label for="userPhoneNum">電話：</label>
    <input type="text" id="userPhoneNum" name="phone" value="<?php echo $userPhoneNum; ?>"><br>

    <label for="userEmail">電子郵件：</label>
    <input type="email" id="userEmail" name="email" value="<?php echo $userEmail; ?>"><br>

    <label for="userPassword">新密碼：</label>
    <input type="password" id="userPassword" name="password"value="<?php echo $userpassword; ?>"><br>

    <label for="confirmPassword">確認新密碼：</label>
    <input type="password" id="confirmPassword" name="confirm_password"value="<?php echo $userpassword; ?>"><br>

    <input type="submit" value="保存">
</form>
</body>
</html>
