<?php
// 数据库连接设置
include("mysql_connect.inc.php");

// 获取表单提交的数据
$username = $_POST['username'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// 校验密码是否匹配
if ($password !== $confirm_password) {
    echo "錯誤：密碼不匹配";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=view_user.php>';
    exit;
}

// 获取当前用户 ID
session_start();
$userId = $_SESSION["User_ID"];

// 更新用户信息
$sql = "UPDATE users SET User_NAME='$username', User_Phone_NUM='$phone', User_Email='$email', User_Password='$password' WHERE User_ID='$userId'";

if ($conn->query($sql) === TRUE) {
    echo "使用者資訊更新成功";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=view_user.php>';
} else {
    echo "錯誤更新使用者資訊：" . $conn->error;
    echo '<meta http-equiv=REFRESH CONTENT=1;url=view_user.php>';
}

// 关闭数据库连接
$conn->close();
?>

