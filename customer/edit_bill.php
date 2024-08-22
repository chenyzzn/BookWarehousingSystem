<?php
include("PDO_connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bill_id = $_POST['bill_id'];
    $book_id = $_POST['book_id'];
    $coupon_id = $_POST['coupon_id'];
    $shipping_id = $_POST['shipping_id'];
    $bill_price = $_POST['bill_price'];
    $payment_method = $_POST['payment_method'];
    $invoice_method = $_POST['invoice_method'];

    $sql = "UPDATE BILL SET Book_ID = :book_id, Coupon_ID = :coupon_id, Shipping_ID = :shipping_id, Bill_Price = :bill_price, Payment_Method = :payment_method, Invoice_Method = :invoice_method WHERE Bill_ID = :bill_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':book_id', $book_id);
    $stmt->bindParam(':coupon_id', $coupon_id);
    $stmt->bindParam(':shipping_id', $shipping_id);
    $stmt->bindParam(':bill_price', $bill_price);
    $stmt->bindParam(':payment_method', $payment_method);
    $stmt->bindParam(':invoice_method', $invoice_method);
    $stmt->bindParam(':bill_id', $bill_id);

    if ($stmt->execute()) {
        echo "Record updated successfully";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=bill_status.php>';
    } else {
        echo "Error updating record: " . $stmt->errorInfo()[2];
        echo '<meta http-equiv=REFRESH CONTENT=1;url=bill_status.php>';
    }
} else {
    $bill_id = $_GET['bill_id'];

    $sql = "SELECT * FROM BILL WHERE Bill_ID = :bill_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':bill_id', $bill_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "<form method='post'>";
    echo "<input type='hidden' name='bill_id' value='" . $row['Bill_ID'] . "'>";
    echo "<input type='text' name='book_id' value='" . $row['Book_ID'] . "'>";
    echo "<input type='text' name='coupon_id' value='" . $row['Coupon_ID'] . "'>";
    echo "<input type='text' name='shipping_id' value='" . $row['Shipping_ID'] . "'>";
    echo "<input type='text' name='bill_price' value='" . $row['Bill_Price'] . "'>";
    echo "<input type='text' name='payment_method' value='" . $row['Payment_Method'] . "'>";
    echo "<input type='text' name='invoice_method' value='" . $row['Invoice_Method'] . "'>";
    echo "<input type='submit' value='Update'>";
    echo "</form>";
}

$pdo = null;
?>
