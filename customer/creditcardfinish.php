<?php session_start();
$Cardnum = $_POST['cardnum'];
$Date = $_POST['date'];
$Safecode = $_POST['safecode'];
$Name = $_POST['name'];

$_SESSION ['Cardnum']=$Cardnum;
$_SESSION ['Date']=$Date;
$_SESSION ['Safecode']   =$Safecode;
$_SESSION ['Name'] =$Name;
if($Cardnum == null || $Date == null || $Safecode == null || $Name == null )
{
    echo "輸入不得為空";
    echo '<meta http-equiv=REFRESH CONTENT=2;url=creditcard.php>';

}else{
    // 建立資料庫連接
    include("mysql_connect.inc.php");
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
    // 更新 Bill 表中的 Credit_Card 属性
    $updateCreditCardSQL = "UPDATE bill SET Credit_Card = '$Cardnum' WHERE Bill_ID = $lastBillID";
    if ($conn->query($updateCreditCardSQL) === TRUE) {
        echo "信用卡資訊已成功儲存";
        echo '<meta http-equiv=REFRESH CONTENT=2;url=discount.php>';
    } else {
        echo "Error: " . $updateCreditCardSQL . "<br>" . $conn->error;
        echo '<meta http-equiv=REFRESH CONTENT=2;url=creditcard.php>';
    }
}
?>