<?php
session_start(); 
$userId = $_SESSION["User_ID"];

include("mysql_connect.inc.php");

$deliveryMethod = $_POST['deliveryMethod'];
$deliveryAddress = $_POST['deliveryAddress'];
$paymentMethod = $_POST['paymentMethod'];
$invoiceMethod = $_POST['invoice'];
$recipientName = $_POST['recipientName'];
$recipientPhone = $_POST['recipientPhone'];

$getLastBillIDSQL = "SELECT MAX(Bill_ID) AS LastBillID FROM bill";
$result = $conn->query($getLastBillIDSQL);
$lastBillID = 50000001; 
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['LastBillID'] != null) {
        $lastBillID = $row['LastBillID'] + 1;
    }
}

$insertShippingSQL = "INSERT INTO shipping (Shipping_ID, Shipping_Method, Shipping_Address, Addressee_Name, Addressee_Phone_NUM)
                     VALUES (($lastBillID - 10000000), '$deliveryMethod', '$deliveryAddress', '$recipientName', '$recipientPhone')";
if ($conn->query($insertShippingSQL) !== TRUE) {
    echo "Error: " . $insertShippingSQL . "<br>" . $conn->error;
}

$insertBillSQL = "INSERT INTO Bill (Bill_ID, Shipping_ID, Bill_Price, Payment_Method, Invoice_Method, Credit_Card)
                  VALUES ('$lastBillID' , ($lastBillID - 10000000), 0, '$paymentMethod', '$invoiceMethod', '')";
if ($conn->query($insertBillSQL) !== TRUE) {
    echo "Error: " . $insertBillSQL . "<br>" . $conn->error;
}

$cartTotal = 0;
$cartItemsSQL = "SELECT * FROM cart WHERE User_ID = '$userId'";
$cartItemsResult = $conn->query($cartItemsSQL);

if ($cartItemsResult->num_rows > 0) {
    $lastOrderID = 0;
    $getLastOrderIDSQL = "SELECT Order_ID FROM orders ORDER BY Order_ID DESC LIMIT 1";
    $result = $conn->query($getLastOrderIDSQL);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastOrderID = $row["Order_ID"];
    }

    while ($cartItem = $cartItemsResult->fetch_assoc()) {
        $bookID = $cartItem['Book_ID'];
        $bookQuantity = $cartItem['Cart_Book_Quantity'];

        $bookPriceSQL = "SELECT Book_Price FROM book WHERE Book_ID = $bookID";
        $bookPriceResult = $conn->query($bookPriceSQL);
        if ($bookPriceResult->num_rows > 0) {
            $book = $bookPriceResult->fetch_assoc();
            $bookPrice = $book['Book_Price'];

            $cartTotal += $bookPrice * $bookQuantity;
            $orderID = $lastOrderID + 1;
            $insertOrderSQL = "INSERT INTO orders (Order_ID, User_ID, Bill_ID, Book_ID, Order_Time, Total_Amount)
                                VALUES ('$orderID', '$userId', '$lastBillID', '$bookID', CURRENT_TIMESTAMP, '$bookQuantity')";
        
            if ($conn->query($insertOrderSQL) !== TRUE) {
                echo "Error: " . $insertOrderSQL . "<br>" . $conn->error;
            }
            $lastOrderID = $orderID;
            
    
            $updateInventorySQL = "UPDATE inventory SET Book_Quantity = (Book_Quantity - $bookQuantity) WHERE Book_ID = $bookID";
            if ($conn->query($updateInventorySQL) !== TRUE) {
                echo "Error: " . $updateInventorySQL . "<br>" . $conn->error;
            }
        }
    }
}

$updateBillTotalSQL = "UPDATE bill SET Bill_Price = $cartTotal WHERE Bill_ID = $lastBillID";
if ($conn->query($updateBillTotalSQL) !== TRUE) {
    echo "Error: " . $updateBillTotalSQL . "<br>" . $conn->error;
}

$conn->close();
if($paymentMethod === "信用卡"){
    header("Location: creditcard.php");
}else{
    header("Location: discount.php");
}

exit();
?>
