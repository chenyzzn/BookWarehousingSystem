<?php

include("PDO_connect.php");
// Fetch all bills
$sql = "SELECT * FROM BILL";
$result = $pdo->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Bill status</title>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>
<body>
    <h2>Bill status</h2>
    <table id="books">
    <tr>
            <th>Bill_ID</th>
            <th>Coupon_ID</th>
            <th>Shipping_ID</th>
            <th>Bill_Price</th>
            <th>Payment_Method</th>
            <th>Invoice_Method</th>
            <th>Actions</th>
    </tr>
    <?php
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>" . $row['Bill_ID'] . "</td><td>" . $row['Coupon_ID'] . "</td><td>" . $row['Shipping_ID'] . "</td><td>" . $row['Bill_Price'] . "</td><td>" . $row['Payment_Method'] . "</td><td>" . $row['Invoice_Method'] . "</td>";
        echo "<td><a href='edit_bill.php?bill_id=" . $row['Bill_ID'] . "'>Edit</a></td></tr>";
        }
        echo "</table>";

        $pdo = null;
?>
<br>
<a href="manage.php"><input type="submit" name="button" value="返回主頁"></a>
</body>
</html>