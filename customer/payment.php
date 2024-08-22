<!DOCTYPE html>
<html>
<head>
    <title>payment</title>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>
<body>
    <h2>結帳</h2>
    <form name="checkoutForm" method="post" action="checkout_process.php">
        <label for="deliveryMethod">送貨方式：</label>
        <select name="deliveryMethod" id="deliveryMethod">
            <option value="7-11">7-11</option>
            <option value="familymart">FamilyMart</option>
            <option value="宅配">宅配</option>
        </select><br>
        
        <label for="deliveryAddress">送貨地址或超商店名：</label>
        <input type="text" name="deliveryAddress" id="deliveryAddress"><br>
        
        <label for="paymentMethod">付款方式：</label>
        <select name="paymentMethod" id="paymentMethod">
            <option value="貨到付款">貨到付款</option>
            <option value="信用卡">信用卡</option>
            <option value="Line pay">Line pay</option>
        </select><br>

        <label for="invoiceMethod">發票方式：</label>
        <select name="invoice">
        <option value="donation receipt">donation receipt</option>
        <option value="Duplex electronic invoice">Duplex electronic invoice</option>
        <option value="Triplex electronic invoice">Triplex electronic invoice</option>
        </select><br>
        
        <label for="recipientName">收件人姓名：</label>
        <input type="text" name="recipientName" id="recipientName"><br>
        
        <label for="recipientPhone">收件人電話：</label>
        <input type="text" name="recipientPhone" id="recipientPhone"><br>
        
        <input type="submit" name="submit" value="確定結帳">
    </form>
</body>
</html>
