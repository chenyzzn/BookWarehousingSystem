<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
echo '<a href="logout.php">登出</a> <br><br>';
//此判斷為判定觀看此頁有沒有權限
//說不定是路人或不相關的使用者
//因此要給予排除
if($_SESSION['User_ID'] != null)
{
	echo '<a href="register.php">新增帳號</a> ';
	echo '<a href="update.php">修改個人資料</a> ';
	echo '<a href="delete.php">刪除</a> <br><br>';
//將資料庫裡的所有會員資料顯示在畫面上
	$sql = "SELECT * FROM USERS";
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_row($result))
	{
		echo "User_ID: $row[0]  User_NAME：$row[1], " . 
		"Email：$row[3]<br>";
	}
}
else
{
	echo '您無權限觀看此頁面!';
	echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
}
?>