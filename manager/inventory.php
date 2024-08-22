<?php

include("PDO_connect.php");
function getInventory($pdo) {
    $stmt = $pdo->query("SELECT * FROM INVENTORY");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addInventory($pdo, $inventoryId, $bookId, $bookQuantity, $inventoryDate) {
    $sql = "INSERT INTO INVENTORY (Inventory_ID, Book_ID, Book_Quantity, Inventory_Date) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$inventoryId, $bookId, $bookQuantity, $inventoryDate]);
}

function updateInventory($pdo, $inventoryId, $bookId, $bookQuantity, $inventoryDate) {
    $sql = "UPDATE INVENTORY SET Book_ID = ?, Book_Quantity = ?, Inventory_Date = ? WHERE Inventory_ID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$bookId, $bookQuantity, $inventoryDate, $inventoryId]);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inventoryId = $_POST["inventoryId"];
    $bookId = $_POST["bookId"];
    $bookQuantity = $_POST["bookQuantity"];
    $inventoryDate = $_POST["inventoryDate"];

    // Determine whether to add or update based on whether an inventory record exists
    $existingInventory = getInventory($pdo);
    $inventoryExists = false;
    foreach ($existingInventory as $inventory) {
        if ($inventory["Inventory_ID"] == $inventoryId) {
            $inventoryExists = true;
            break;
        }
    }

    if ($inventoryExists) {
        updateInventory($pdo, $inventoryId, $bookId, $bookQuantity, $inventoryDate);
    } else {
        addInventory($pdo, $inventoryId, $bookId, $bookQuantity, $inventoryDate);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory</title>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>
<body>

<h2>Current Inventory</h2>
<table id="books">
    <tr>
        <th>Inventory ID</th>
        <th>Book ID</th>
        <th>Book Quantity</th>
        <th>Inventory Date</th>
    </tr>
    <?php
    $inventory = getInventory($pdo);
    foreach ($inventory as $item) {
        echo "<tr>";
        echo "<td>".$item["Inventory_ID"]."</td>";
        echo "<td>".$item["Book_ID"]."</td>";
        echo "<td>".$item["Book_Quantity"]."</td>";
        echo "<td>".$item["Inventory_Date"]."</td>";
        echo "</tr>";
    }
    ?>
</table>

<!-- Inventory Form -->
<h2>Add/Update Inventory</h2>
<form method="post" action="">
    <label for="inventoryId">Inventory ID:</label><br>
    <input type="text" id="inventoryId" name="inventoryId" required><br>
    <label for="bookId">Book ID:</label><br>
    <input type="text" id="bookId" name="bookId" required><br>
    <label for="bookQuantity">Book Quantity:</label><br>
    <input type="number" id="bookQuantity" name="bookQuantity" required><br>
    <label for="inventoryDate">Inventory Date:</label><br>
    <input type="date" id="inventoryDate" name="inventoryDate" required><br>
    <input type="submit" value="Submit">
</form>

<br>
<a href="manage.php"><input type="submit" name="button" value="返回主頁"></a>
</body>
</html>
