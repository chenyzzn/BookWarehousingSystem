<?php
// 清除会话数据并销毁会话
session_start();
session_unset();
session_destroy();

// 重定向到登录页面或其他适当的页面
header("Location: login.html");
exit();
?>
