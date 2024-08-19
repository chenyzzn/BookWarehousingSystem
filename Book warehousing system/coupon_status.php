<?php
include("mysql_connect.inc.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Coupon Edition</title>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>
<body>
<form action="" method="POST">
    <h2>新增Coupon</h2>
    <label for="coupon_code">Coupon Code:</label>
    <input type="text" name="coupon_code" required><br>
    <label for="coupon_type">Coupon Type:</label>
    <input type="text" name="coupon_type" required><br>
    <label for="coupon_due_date">Coupon Due Date:</label>
    <input type="date" name="coupon_due_date" required><br>
    <label for="coupon_detail">Coupon Detail:</label>
    <input type="text" name="coupon_detail" required><br>
    <input type="submit" name="add_coupon" value="新增">
</form>

<table id = "books">
    <tr>
        <th>Coupon ID</th>
        <th>Coupon Code</th>
        <th>Coupon Type</th>
        <th>Due Date</th>
        <th>Coupon Detail</th>
        <th>Modify</th>
    </tr>
<?php
if (isset($_POST['add_coupon'])) {
    $sql = "SELECT MAX(Coupon_ID) AS max_id FROM COUPON";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $newCouponID = $row["max_id"] + 1;
    $couponCode = $_POST['coupon_code'];
    $couponType = $_POST['coupon_type'];
    $couponDueDate = $_POST['coupon_due_date'];
    $couponDetail = $_POST['coupon_detail'];

    $sql = "INSERT INTO COUPON (Coupon_ID, Coupon_Code, Coupon_Type, Coupon_Due_Date, Coupon_Detail) VALUES ('$newCouponID', '$couponCode', '$couponType', '$couponDueDate', '$couponDetail')";
    if ($conn->query($sql) === TRUE) {
        header("Location: coupon_status.php");
        exit();
    } else {
        echo "Fail to import Coupon: " . $conn->error;
    }
}

// 处理修改Coupon请求
if (isset($_POST['edit_coupon'])) {
    $couponID = $_POST['coupon_id'];
    $couponCode = $_POST['coupon_code'];
    $couponType = $_POST['coupon_type'];
    $couponDueDate = $_POST['coupon_due_date'];
    $couponDetail = $_POST['coupon_detail'];

    // 执行更新操作
    $sql = "UPDATE COUPON SET Coupon_Code='$couponCode', Coupon_Type='$couponType', Coupon_Due_Date='$couponDueDate', Coupon_Detail='$couponDetail' WHERE Coupon_ID='$couponID'";
    if ($conn->query($sql) === TRUE) {
        echo "Success to import Coupon";
    } else {
        echo "Fail to import Coupon: " . $conn->error;
    }
}

// 查询所有Coupon数据
$sql = "SELECT * FROM COUPON";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["Coupon_ID"]."</td>";
        echo "<td>".$row["Coupon_Code"]."</td>";
        echo "<td>".$row["Coupon_Type"]."</td>";
        echo "<td>".$row["Coupon_Due_Date"]."</td>";
        echo "<td>".$row["Coupon_Detail"]."</td>";
        echo "<td><a href='edit_coupon.php?id=".$row["Coupon_ID"]."'>Edit</a></td>";
        echo "</tr>";
    }
} else {
    echo "No coupon data";
}

$conn->close();
?>
<a href="manage.php"><input type="submit" name="button" value="返回主頁"></a>
</body>
</html>
