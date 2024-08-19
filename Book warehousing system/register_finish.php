<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
$name = $_POST['name'];
$phone = $_POST['phone'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$email = $_POST['email'];

// 判斷帳號密碼是否為空值
// 確認密碼輸入的正確性
if($name != null && $phone != null && $pw != null && $pw2 != null && $pw == $pw2 && mb_strlen($pw) == mb_strlen($pw2))
{
    // 检查用户名、电话号码和邮箱是否已经存在于数据库中
    $checkUserQuery = "SELECT * FROM USERS WHERE User_NAME='$name' OR User_Phone_NUM='$phone' OR User_Email='$email'";
    $checkUserResult = mysqli_query($conn, $checkUserQuery);

    if(mysqli_num_rows($checkUserResult) > 0)
    {
        echo '帳戶已存在，請使用不同的帳戶資訊進行註冊!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=register.php>';
    }
    else
    {
        // 获取最后一个User_ID
        $getLastUserID = "SELECT User_ID FROM USERS ORDER BY User_ID DESC LIMIT 1";
        $result = mysqli_query($conn, $getLastUserID);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $lastUserID = $row['User_ID'];
            $newUserID = $lastUserID + 1;
        } else {
            $newUserID = 00000001; // 如果没有记录，则新的User_ID为1
        }

        // 新增資料進資料庫語法
        $sql = "INSERT INTO USERS (User_ID, User_Name, User_Phone_Num, User_Password, User_Email, User_Is_Manager, User_Is_Customer) VALUES ('$newUserID', '$name', '$phone', '$pw', '$email', '0', '1')";
        if(mysqli_query($conn, $sql))
        {
            echo '新增成功!';
            echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
        }
        else
        {
            echo '新增失敗!';
            echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
        }
    }
}
else
{
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
}
?>
