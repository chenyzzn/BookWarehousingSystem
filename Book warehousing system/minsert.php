<?php
include("mysql_connect.inc.php");

$User_ID = $_POST['User_ID'];
$User_NAME = $_POST['User_NAME'];
$User_Phone_NUM = $_POST['User_Phone_NUM'];
$User_Email = $_POST['User_Email'];
$User_Password = $_POST['User_Password'];
$User_Is_Manager = isset($_POST['User_Is_Manager']) ? 1 : 0;
$User_Is_Customer = isset($_POST['User_Is_Customer']) ? 1 : 0;
$VIP_Status = isset($_POST['VIP_Status']) ? 1 : 0;

$sql = "INSERT INTO USERS (User_ID, User_NAME, User_Phone_NUM, User_Email, User_Password, User_Is_Manager, User_Is_Customer, VIP_Status) VALUES ('$User_ID', '$User_NAME', '$User_Phone_NUM', '$User_Email', '$User_Password', '$User_Is_Manager', '$User_Is_Customer', '$VIP_Status')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  echo '<meta http-equiv=REFRESH CONTENT=2;url=medituser.php>';
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  echo '<meta http-equiv=REFRESH CONTENT=2;url=medituser.php>';
}

$conn->close();
?>
