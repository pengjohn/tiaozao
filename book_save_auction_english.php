<?php include 'conn.php'; ?>
<?php include 'conn_db_open.php'; ?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<Script Language ="JavaScript">
function book_please_login()
{
    alert("���ȵ�¼��");
    self.location='index.php';
}

function book_success()
{
    alert("���۳ɹ�");
    self.location='index.php';
}

function book_min()
{
    alert("�������ļۣ�������Ч");
    history.back();
}

function book_max()
{
    alert("����һ�ڼۣ���һ�ڼ۳ɽ�");
    self.location='index.php';
}

function book_low()
{
    alert("����̫��");
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
    //Ԥ��
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

