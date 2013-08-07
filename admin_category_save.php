<?php include 'conn_db_open.php'; ?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<Script Language ="JavaScript">
function new_success(){
alert("添加成功！");
self.location='admin_category_add.php';
}

function edit_success(){
alert("修改成功！");
self.location='admin_category_add.php';
}

</Script>

</Head>

<?php
$action = $_POST['action'];
$CategoryId = $_POST['CategoryId'];
$CategoryName = $_POST['CategoryName'];

if($action == "new")
{
    echo "<br>goto new";
    $sql = "INSERT INTO ".SQL_TABLE_CATEGORY." (CategoryId, CategoryName) VALUES (NULL, '$CategoryName')";
    mysql_query($sql, $con);
    echo "<br>sql: ".mysql_error();

		echo "<body onload=new_success()>";
		echo "</body>";    
}
else if($action == "edit")
{
    echo "<br>goto edit";
    $sql = "UPDATE ".SQL_TABLE_CATEGORY." Set CategoryName='$CategoryName' WHERE CategoryId='$CategoryId'";
    mysql_query($sql, $con);
    echo "<br>sql: ".mysql_error();

		echo "<body onload=edit_success()>";
		echo "</body>";    

}
?>
</Html>
<?php include 'conn_db_close.php'; ?>

