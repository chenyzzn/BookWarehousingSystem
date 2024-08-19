<?php
include("mysql_connect.inc.php");
$userid  = $_SESSION['User_ID'];
// Select all orders
$sql = "SELECT  Bill_ID,  Book_ID, Order_Time, Total_Amount FROM orders  where User_ID = '$userid'";
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
            <th>Bill_ID</th>
            <th>Book_ID</th>
            <th>Order_Time</th>
            <th>Total_Amount</th>
            <th>Cancel_Order</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Bill_ID"] . "</td>";
        echo "<td>" . $row["Book_ID"] . "</td>";
        echo "<td>" . $row["Order_Time"] . "</td>";
        echo "<td>" . $row["Total_Amount"] . "</td>";
        echo "<td><a href='clearorder.php?Bill_ID=" . $row['Bill_ID'] . "'>取消訂單</a></td>";
        echo "</tr>";
    } 
    }else {
    echo "0 results";
    }
  ?>
  



</body>
</html>

<!-- The form for updating the order -->

<br>
<br>
<a href="homepage.php"><input type="submit" name="button" value="返回主頁"></a>