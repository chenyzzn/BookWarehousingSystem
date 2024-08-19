<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include("mysql_connect.inc.php");
$NewID = $_POST['NewID'];
$NewName = $_POST['NewName'];
$NewPhone = $_POST['NewPhone'];
$Newpw = $_POST['Newpw'];
$Newpw2 = $_POST['Newpw2'];
$NewEmail = $_POST['NewEmail'];
//判斷帳號密碼是否為空值
echo $_SESSION['User_ID'];
$check = $_SESSION['User_ID'];
//確認密碼輸入的正確性
if($NewID != null && $NewName != null && $NewPhone !=null && $Newpw != null && $Newpw !=null && $Newpw2 !=null && $NewEmail != null  && $Newpw == $Newpw2)
{
 //新增資料進資料庫語法
    
    $sql = "UPDATE USERS SET  User_ID = '$NewID', User_Name = '$NewName', User_Phone_NUM = '$NewPhone',User_Email = '$NewEmail',User_Password = '$Newpw' where User_ID = '$check'";
	if(mysqli_query($conn,$sql))
	{
		echo '更改成功!';
		echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php>';
	}
    else
    {
        echo '更改失敗!';
    }
}
else
{
    if($Newpw != $Newpw2)
    {
        echo '密碼確認錯誤';
    }
    if($NewID==null or $NewName == null or $NewPhone == null or $Newpw == null or $Newpw2 == null OR $NewEmail == null)
    {
        echo '您的資料填寫不完整';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=update.php>';
    }
}
?>