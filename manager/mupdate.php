<?php
include("mysql_connect.inc.php");

$User_ID = $_POST['User_ID'];
$User_NAME = $_POST['User_NAME'];
$User_Phone_NUM = $_POST['User_Phone_NUM'];
$User_Email = $_POST['User_Email'];
$User_Is_Manager = isset($_POST['User_Is_Manager']) ? 1 : 0;
$User_Is_Customer = isset($_POST['User_Is_Customer']) ? 1 : 0;
$VIP_Status = isset($_POST['VIP_Status']) ? 1 : 0;

// 检查用户是否存在
$checkUserQuery = "SELECT * FROM USERS WHERE User_ID='$User_ID'";
$checkUserResult = $conn->query($checkUserQuery);

if ($checkUserResult->num_rows > 0) {
  // 用户存在，执行更新操作
  $sql = "UPDATE USERS SET User_NAME='$User_NAME', User_Phone_NUM='$User_Phone_NUM', User_Email='$User_Email', User_Is_Manager='$User_Is_Manager', User_Is_Customer='$User_Is_Customer', VIP_Status='$VIP_Status' WHERE User_ID='$User_ID'";

  if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
    echo '<meta http-equiv=REFRESH CONTENT=2;url=medituser.php>';
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    echo '<meta http-equiv=REFRESH CONTENT=2;url=medituser.php>';
  }
} else {
  // 用户不存在，显示错误信息或执行其他操作
  echo "User does not exist";
  echo '<meta http-equiv=REFRESH CONTENT=2;url=medituser.php>';
}

$conn->close();
?>

