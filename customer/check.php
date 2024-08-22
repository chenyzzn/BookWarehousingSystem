<?php session_start(); 
$_SESSION['chose'] = $_GET['yourchose'];
$chose = $_SESSION['chose'];
if($chose == "Credit Card")
{
    echo '<meta http-equiv=REFRESH CONTENT=1;url=creditcard.php>';
}
else if($chose == "Line Pay")
{
    echo '<meta http-equiv=REFRESH CONTENT=1;url=address.php>';
}
else
{
    echo '<meta http-equiv=REFRESH CONTENT=1;url=address.php>';
}
?>
