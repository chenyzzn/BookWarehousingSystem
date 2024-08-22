<?php

function connect()
{
    // DB connection info
    $host = "localhost"; # localhost or 127.0.0.1
    $user = "root";
    $pwd = "ricci0713";
    $db = "dbms";
    $port = 3306;

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db;port=$port", $user, $pwd);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die(print_r($e));
        echo $e;
    }
    return $conn;
}

$conn = connect();

$sql = "SELECT * FROM PRODUCT";
$stmt = $conn->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_BOTH);
//echo $products;
?>
<!DOCTYPE html>
<html>
<head>
	<title>MySQL Connection Testing Page</title>
</head>
<body>


<table border=1>
	<tr>
		<th>Product Code</th>
		<th>Product Name</th>
		<th>DATE</th>
		<th>QOH</th>
	</tr>
<?php

if (!empty($products)) {
    ?>

<?php

    foreach ($products as $product) {
        echo "<tr>";
        echo "<td>" . $product['P_CODE'] . "</td>";
        echo "<td>" . $product['P_DESCRIPT'] . "</td>";
        echo "<td>" . $product['P_INDATE'] . "</td>";
        echo "<td>" . $product['P_QOH'] . "</td>";
        echo "</tr>";
    }
}

?>

</table>

</body>
</html>


