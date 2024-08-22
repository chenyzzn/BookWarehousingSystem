<!DOCTYPE html>
<html>
<head>
    <title>discount</title>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>
<body>
    <form method="POST" action="">
    <label for="code">優惠代碼輸入區：</label>
    <input type="text" name="code" id="code">
    <input type="submit" value="提交">
</form>
<?php session_start(); 
$dicount  = 1;
include("mysql_connect.inc.php");

$sum = 0; // 初始化总金额为0

// 獲取最後一個 Bill_ID
$getLastBillIDSQL = "SELECT MAX(Bill_ID) AS LastBillID FROM bill";
$result = $conn->query($getLastBillIDSQL);
$lastBillID = 50000001; // 預設為 50000001
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['LastBillID'] != null) {
        $lastBillID = $row['LastBillID'];
    }
}

// 查询Bill表中的Bill_Price
$billPriceSQL = "SELECT Bill_Price FROM Bill WHERE Bill_ID = $lastBillID";
$billPriceResult = $conn->query($billPriceSQL);

if ($billPriceResult->num_rows > 0) {
    $billPriceRow = $billPriceResult->fetch_assoc();
    $sum = $billPriceRow['Bill_Price'];
}

if (isset($_POST['code'])) {
    $inputCode = $_POST['code'];
    $sql  = "SELECT Coupon_Type from COUPON WHERE Coupon_Code = '$inputCode'";
    $result = $conn->query($sql); // Execute the query and assign the result
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $discount = $row["Coupon_Type"];
        }

    } else {
        $discount = 1;
        echo "折價券輸入錯誤或為空值".'<br>';
    }

    $sum = $sum * $discount;
    echo '折扣後應付金額：$' . $sum;
    $updateBillTotalSQL = "UPDATE bill SET Bill_Price = $sum WHERE Bill_ID = $lastBillID";
    if ($conn->query($updateBillTotalSQL) !== TRUE) {
    echo "Error: " . $updateBillTotalSQL . "<br>" . $conn->error;
    }

    $inputCode = $_POST['code'];
    // 查询优惠券的ID
    $couponIDSQL = "SELECT Coupon_ID FROM COUPON WHERE Coupon_Code = '$inputCode'";
    $result = $conn->query($couponIDSQL);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $couponID = $row['Coupon_ID'];
    
        // 更新账单的优惠券信息
        $updateCouponSQL = "UPDATE bill SET Coupon_ID = $couponID WHERE Bill_ID = $lastBillID";
        if ($conn->query($updateCouponSQL) !== TRUE) {
            echo "Error: " . $updateCouponSQL . "<br>" . $conn->error;
        }
    }
    

}
?>
<form name="form" method="post" action="checkout_complete.php">
<input type="submit" name="button" value="確定" />    
</form>