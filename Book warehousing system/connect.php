<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//連接資料庫
//只要此頁面上有用到連接 MySQL就要include它
include("mysql_connect.inc.php");
$emailOrPhone = $_POST['email_or_phone'];
$pw = $_POST['pw'];
//搜尋資料庫資料
$sql = "SELECT * FROM USERS WHERE User_Email = '$emailOrPhone' OR User_Phone_NUM = '$emailOrPhone'";
$result = mysqli_query($conn, $sql);
$row = @mysqli_fetch_row($result);
//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員

if ($emailOrPhone != null && $pw != null && ($row[2] == $emailOrPhone || $row[3] == $emailOrPhone) && $row[4] == $pw) {
    if ($row[5] == 1) {
        $_SESSION['User_ID'] = $row[0];
        echo '登入成功!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=manage.php>';
    } else {
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['User_ID'] = $row[0];
        echo '登入成功!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=homepage.php>';
    }
} else {
    echo '登入失敗!';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=login.html>';
}
?>
