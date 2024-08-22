<?php
include("PDO_connect.php");

// Query for total revenue
$totalRevenueQuery = $pdo->query('SELECT SUM(Bill_Price) AS TotalRevenue FROM BILL');
$totalRevenue = $totalRevenueQuery->fetch();

// Query for all bill information
$allBillInfoQuery = $pdo->query('SELECT * FROM BILL');
$allBillInfo = $allBillInfoQuery->fetchAll();
?>

<html>
<body>

<h1>Financial Overview</h1>

<h2>Total Revenue: <?= $totalRevenue['TotalRevenue'] ?></h2>

<h2>All Bill Information:</h2>
<table>
    <tr>
        <th>Bill ID</th>
        <th>Coupon ID</th>
        <th>Shipping ID</th>
        <th>Bill Price</th>
        <th>Payment Method</th>
        <th>Invoice Method</th>
        <th>Credit Card</th>
    </tr>
    <?php foreach ($allBillInfo as $bill) : ?>
    <tr>
        <td><?= $bill['Bill_ID'] ?></td>
        <td><?= $bill['Coupon_ID'] ?></td>
        <td><?= $bill['Shipping_ID'] ?></td>
        <td><?= $bill['Bill_Price'] ?></td>
        <td><?= $bill['Payment_Method'] ?></td>
        <td><?= $bill['Invoice_Method'] ?></td>
        <td><?= $bill['Credit_Card'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
