<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include("mysql_connect.inc.php");
$bookId = $_POST['id'];
$title = $_POST['title'];
$edition = $_POST['edtype'];
$author = $_POST['au'];
$price = $_POST['price'];
$date = $_POST['date'];
// 編輯書籍資料
function editBook($bookId, $title, $edition, $author, $price, $date) {
    global $conn;

    // 更新書籍資料
    $sql = "UPDATE book SET Book_Title='$title', Book_Edition_Type='$edition', Book_Author='$author', Book_Price='$price', Date_of_Publication='$date' WHERE Book_id='$bookId'";
    if ($conn->query($sql) === TRUE) {
        echo "書籍資料已成功更新";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=bookdataedit.php>';
    } else {
        echo "更新書籍資料時發生錯誤: " . $conn->error;
        echo '<meta http-equiv=REFRESH CONTENT=1;url=bookdataedit.php>';
    }
}
editBook($bookId, $title, $edition, $author, $price, $date);
// 關閉資料庫連接
$conn->close();

?>
