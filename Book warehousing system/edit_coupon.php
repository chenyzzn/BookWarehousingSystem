<!DOCTYPE html>
<html>
<head>
    <title>Coupon Edition</title>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>
<body>
<h2>Coupon Edition</h2>
<?php
include("mysql_connect.inc.php");

// 处理提交的表单
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $couponID = $_POST['coupon_id'];
    $couponCode = $_POST['coupon_code'];
    $couponType = $_POST['coupon_type'];
    $couponDueDate = $_POST['coupon_due_date'];
    $couponDetail = $_POST['coupon_detail'];

    // 执行更新操作
    $sql = "UPDATE COUPON SET Coupon_Code='$couponCode', Coupon_Type='$couponType', Coupon_Due_Date='$couponDueDate', Coupon_Detail='$couponDetail' WHERE Coupon_ID='$couponID'";
    if ($conn->query($sql) === TRUE) {
        echo "修改Coupon成功";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=coupon_status.php>';
    } else {
        echo "修改Coupon失败: " . $conn->error;
        echo '<meta http-equiv=REFRESH CONTENT=1;url=coupon_status.php>';
    }
}

// 获取要编辑的Coupon的ID
$couponID = $_GET['id'];

// 查询Coupon数据
$sql = "SELECT * FROM COUPON WHERE Coupon_ID='$couponID'";
$result = $conn->query($sql);

// 显示编辑表单
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="coupon_id" value="<?php echo $row['Coupon_ID']; ?>">
        <label for="coupon_code">Coupon Code:</label>
        <input type="text" name="coupon_code" id="coupon_code" value="<?php echo $row['Coupon_Code']; ?>" required><br>
        <label for="coupon_type">Coupon Type:</label>
        <input type="text" name="coupon_type" id="coupon_type" value="<?php echo $row['Coupon_Type']; ?>" required><br>
        <label for="coupon_due_date">Coupon Due Date:</label>
        <input type="date" name="coupon_due_date" id="coupon_due_date" value="<?php echo $row['Coupon_Due_Date']; ?>" required><br>
        <label for="coupon_detail">Coupon Detail:</label>
        <input type="text" name="coupon_detail" id="coupon_detail" value="<?php echo $row['Coupon_Detail']; ?>" required><br>
        <input type="submit" name="edit_coupon" value="更新Coupon">
    </form>

    <?php
}
$conn->close();
?>

</body>
</html>
