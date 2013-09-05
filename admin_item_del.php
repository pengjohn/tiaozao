<?php include 'conn_db_open.php'; ?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<Script Language ="JavaScript">
function del_success()
{
    alert("删除成功！");
    self.location='admin_init.php';
}

function del_fail()
{
    alert("删除失败！");
    self.location='admin_init.php';
}
</Script>
</Head>
<?php
    $ItemId = $_GET['ItemId'];
 
    $sql = "DELETE FROM ".SQL_TABLE_ITEM." WHERE ItemId='$ItemId'";
    mysql_query($sql, $con);
    echo "sql: ".mysql_error()."<br>";
    echo "<br>delete success!<br>";

    echo "<body onload=del_success()>";
    echo "</body>";
?>

</Html>
<?php include 'conn_db_close.php'; ?>