<?php
include("mysql_connect.inc.php");

// Select all orders
$sql = "SELECT Order_ID, User_ID, Bill_ID, Book_ID, Order_Time, Total_Amount FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Status</title>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>
<body>
    <h2>Order Status</h2>
    <table id="books">
    <tr>
            <th>Order_ID</th>
            <th>User_ID</th>
            <th>Bill_ID</th>
            <th>Book_ID</th>
            <th>Order_Time</th>
            <th>Total_Amount</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Order_ID"]  . "</td>";
        echo "<td>" . $row["User_ID"] . "</td>";
        echo "<td>" . $row["Bill_ID"] . "</td>";
        echo "<td>" . $row["Book_ID"] . "</td>";
        echo "<td>" . $row["Order_Time"] . "</td>";
        echo "<td>" . $row["Total_Amount"] . "</td>";
        echo "</tr>";
    } 
    }else {
    echo "0 results";
    }
  ?>
  
<?php
// Update order
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST["Order_ID"];
    $order_time = $_POST['Order_Time'];
    $total_amount = $_POST["Total_Amount"];
    
    $update_sql = "UPDATE orders SET Order_Time='$order_time', Total_Amount='$total_amount' WHERE Order_ID=$order_id";

    if ($conn->query($update_sql) === TRUE) {
      echo "Order updated successfully";
      echo '<meta http-equiv=REFRESH CONTENT=1;url=order_status.php>';
    } else {
      echo "Error updating order: " . $conn->error;
      echo '<meta http-equiv=REFRESH CONTENT=1;url=order_status.php>';
    }
}

$conn->close();
?>


</body>
</html>

<!-- The form for updating the order -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Order_ID: <input type="text" name="Order_ID"><br>
  Order_Time: <input type="date" name="Order_Time"><br>
  Total_Amount: <input type="number" name="Total_Amount"><br>
  <input type="submit">
</form>

<br>
<br>
<a href="manage.php"><input type="submit" name="button" value="返回主頁"></a>

