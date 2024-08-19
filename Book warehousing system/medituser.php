<?php
include("mysql_connect.inc.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mediuser</title>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>
<body>
    <h2>新增資料</h2>
<!-- 新增資料的表單 -->
<form action="minsert.php" method="post">
  User ID: <input type="text" name="User_ID"><br>
  Name: <input type="text" name="User_NAME"><br>
  Phone: <input type="text" name="User_Phone_NUM"><br>
  Email: <input type="text" name="User_Email"><br>
  Password: <input type="password" name="User_Password"><br>
  Is Manager: <input type="checkbox" name="User_Is_Manager"><br>
  Is Customer: <input type="checkbox" name="User_Is_Customer"><br>
  VIP Status: <input type="checkbox" name="VIP_Status"><br>
  <input type="submit">
</form>

    <h2>修改資料</h2>
<!-- 修改資料的表單 -->
<form action="mupdate.php" method="post">
  User ID: <input type="text" name="User_ID"><br>
  Name: <input type="text" name="User_NAME"><br>
  Phone: <input type="text" name="User_Phone_NUM"><br>
  Email: <input type="text" name="User_Email"><br>
  Is Manager: <input type="checkbox" name="User_Is_Manager"><br>
  Is Customer: <input type="checkbox" name="User_Is_Customer"><br>
  VIP Status: <input type="checkbox" name="VIP_Status"><br>
  <input type="submit">
</form>

    <table id="books">
    <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>User_Is_Manager</th>
            <th>User_Is_Customer</th>
            <th>VIP_Status</th>
    </tr>
<?php
// 顯示所有使用者資料
$sql = "SELECT * FROM USERS";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo "<tr><td>" . $row['User_ID'] . "</td><td>" . $row['User_NAME'] . "</td><td>" . $row['User_Phone_NUM'] . "</td><td>" . $row['User_Email'] . "</td><td>" . $row['User_Is_Manager'] . "</td><td>" . $row['User_Is_Customer'] . "</td><td>" . $row['VIP_Status'] . "</td>";
  }
} else {
  echo "0 results";
}

$conn->close();
?>

<br>
<a href="manage.php"><input type="submit" name="button" value="返回主頁"></a>
</body>
</html>
