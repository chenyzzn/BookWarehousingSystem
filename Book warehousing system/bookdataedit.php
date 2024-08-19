<!-- 設定網頁編碼為UTF-8 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!DOCTYPE html>
<html>
<head>
    <title>Book Edition</title>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>
<body>

<form name="form" method="post" action="bookdataedit_finish.php">
<h2>Book Edition</h2>
BookId：<input type="text" name="id" /> <br>
Booktitle：<input type="text" name="title" /> <br>
Bookedtype：<input type="text" name="edtype" /> <br>
Bookau：<input type="text" name="au" /> <br>
Bookprice：<input type="text" name="price" /> <br>
Bookdate：<input type="date" name="date" /> <br>
<input type="submit" name="button" value="確定" />&nbsp;&nbsp;
</form>

<table id = "books">
    <tr>
        <th>Book ID</th>
        <th>Book Title</th>
        <th>Book Edition Type</th>
        <th>Book Author</th>
        <th>Book Price</th>
        <th>Date of Publication</th>
    </tr>
<?php
include("mysql_connect.inc.php");
// 查询所有数据
$sql = "SELECT * FROM BOOK";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Book_ID"] . "</td>";
        echo "<td>" . $row["Book_Title"] . "</td>";
        echo "<td>" . $row["Book_Edition_Type"] . "</td>";
        echo "<td>" . $row["Book_Author"] . "</td>";
        echo "<td>" . $row["Book_Price"] . "</td>";
        echo "<td>" . $row["Date_of_Publication"] . "</td>";
        echo "</tr>";
    }

    // 输出表格尾部
    echo "</table>";
} else {
    echo "0 结果";
}

// 关闭数据库连接
$conn->close();
?>

<br>
<a href="manage.php"><input type="submit" name="button" value="返回主頁"></a>
</body>
</html>