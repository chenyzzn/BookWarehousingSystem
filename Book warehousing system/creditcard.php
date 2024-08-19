<!DOCTYPE html>
<html>
<head>
    <title>Creditcard detail</title>
    <link rel="stylesheet" type="text/css" href="style.php">
</head>

<body>
<h2 align="left">卡片詳情</h2>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form name="form" method="post" action="creditcardfinish.php">
信用卡號碼<input type = "password" name ="cardnum" /> <br>
到期日(YY/MM): <input type="month" name="date" /> <br>
安全驗證碼<input type="text" name="safecode"/><br>
持卡者姓名<input type="text" name="name" /> <br>
<input type="submit" name="button" value="確定" />
</form>
</body>
</html>