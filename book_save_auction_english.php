<?php include 'conn.php'; ?>
<?php include 'conn_db_open.php'; ?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<Script Language ="JavaScript">
function book_please_login()
{
    alert("请先登录！");
    self.location='index.php';
}

function book_success()
{
    alert("出价成功");
    self.location='index.php';
}

function book_min()
{
    alert("低于起拍价，出价无效");
    history.back();
}

function book_max()
{
    alert("高于一口价，以一口价成交");
    self.location='index.php';
}

function book_low()
{
    alert("出价太低");
    history.back();
}

</Script>
</Head>
<?php
session_start();
$BookUserId = $_SESSION['tz_re_UserId'];
$BookUserName = $_SESSION['tz_re_UserAccount'];
$BookItemId = $_POST['ItemId'];
$BookPrice = $_POST['ItemPrice'];

if($BookUserId <=0)
{
    echo "<body onload=book_please_login()>";
    echo "</body>";     
}

$result_item=mysql_query("SELECT * FROM ".SQL_TABLE_ITEM." WHERE ItemId='$BookItemId'", $con);
$row_item = mysql_fetch_array($result_item);
$ItemPriceMin = $row_item['ItemPriceMin'];
$ItemPriceMax = $row_item['ItemPriceMax'];

if($BookPrice < $ItemPriceMin)
{
    echo "<body onload=book_min()>";
    echo "</body>";    
}

$BookPriceMax = 0;
$result_book=mysql_query("SELECT * FROM ".SQL_TABLE_BOOK." WHERE BookItemId='$BookItemId' order by BookPrice desc", $con);
$row_book = mysql_fetch_array($result_book);
if($row_book)
{
    $BookPriceMax = $row_book['BookPrice'];
}

if($BookPrice <= $BookPriceMax)
{
    echo "<body onload=book_low()>";
    echo "</body>";
}
else
{
    //预定
    $sql = "INSERT INTO ".SQL_TABLE_BOOK.
                " (BookId, 
                   BookItemId, 
                   BookUserId, 
                   BookUserName, 
                   BookPrice, 
                   BookTime) 
                VALUES 
                  (NULL, 
                   '$BookItemId', 
                   '$BookUserId', 
                   '$BookUserName', 
                   '$BookPrice', 
                   NOW())";
    mysql_query($sql, $con);
    echo "<br>sql: ".mysql_error();

    if($BookPrice >= $ItemPriceMax)
    {
        $sql = "UPDATE ".SQL_TABLE_ITEM."
                SET ItemClose=".ITEM_CLOSE_SOLD." 
                WHERE ItemId='$BookItemId'";
        mysql_query($sql, $con);
        echo "<br>sql: ".mysql_error();
        
        echo "<body onload=book_max()>";
        echo "</body>";
    }
    else
    {
        echo "<body onload=book_success()>";
        echo "</body>";        
    }
}

?>
</Html>
<?php include 'conn_db_close.php'; ?>

