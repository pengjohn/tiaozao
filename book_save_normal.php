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
    alert("Ԥ���ɹ�");
    self.location='index.php';
}

function book_sold()
{
    alert("��Ʒ�Ѿ���Ԥ��");
    self.location='index.php';
}
</Script>
</Head>

<?php
    session_start();
    $BookUserId = $_SESSION['tz_re_UserId'];
    $BookUserName = $_SESSION['tz_re_UserAccount'];
    $BookItemId = $_POST['ItemId'];

    if($BookUserId <=0)
    {
        echo "<body onload=book_please_login()>";
        echo "</body>";     
    }

    //�Ƿ��Ѿ���Ԥ��
    $result_book=mysql_query("SELECT * FROM ".SQL_TABLE_BOOK." WHERE BookItemId='$BookItemId' ", $con);
    $num_rows_book = mysql_num_rows($result_book);
    if($num_rows_book >=1)
    {
        echo "<body onload=book_sold()>";
        echo "</body>";
    }
    else
    {
        //Ԥ��
        $sql = "INSERT INTO ".SQL_TABLE_BOOK." (BookId, BookItemId, BookUserId, BookUserName, BookTime) VALUES (NULL, '$BookItemId', '$BookUserId', '$BookUserName', NOW())";
        mysql_query($sql, $con);
        echo "<br>sql: ".mysql_error();
        echo "<body onload=book_success()>";
        echo "</body>";
    }        
?>
</Html>     

<?php include 'conn_db_close.php'; ?>

