<?php include 'conn.php'; ?>
<?php include 'conn_db_open.php'; ?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="GENERATOR" content="Microsoft FrontPage 3.0">
<title><?php echo WEB_TITLE;?></title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<br>管理 -> 类别 -> 添加<br><br><br>
<form method="POST" action="admin_category_save.php">
<input type="hidden" name=action value="new">
    <table border="0" cellspacing="1" width=800>
        <tr>
            <td align="right" height="30">类别名</td>
            <td height="30"><input type="text" name="CategoryName" size="32"></td>
        </tr>
        <tr>
            <td align="right" height="30"></td>
            <td height="30">
            <input type="submit" value=" 添 加 " name="cmdok"style="background-color: rgb(0,0,0); color: rgb(255,255,255); border: 1px dotted rgb(255,255,255)">&nbsp;
            <input type="reset" value=" 清 除 " name="cmdcancel" style="background-color: rgb(0,0,0); color: rgb(255,255,255); border: 1px dotted rgb(255,255,255)"></p>  
            </td>
        </tr>       
    </table>
</form>
<?php
$result=mysql_query("SELECT * FROM ".SQL_TABLE_CATEGORY." order by CategoryId", $con);

while($row = mysql_fetch_array($result))
{
    echo $row['CategoryId'].". ".$row['CategoryName']."[<a href=admin_category_edit.php?CategoryId=".$row['CategoryId'].">修改</a>]<br>";
}
?>

</body>
</html>
<?php include 'conn_db_close.php'; ?>