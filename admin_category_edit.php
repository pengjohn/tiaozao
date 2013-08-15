<?php include 'conn.php'; ?>
<?php include 'conn_db_open.php'; ?>
<html>

<?php
$CategoryId = $_GET['CategoryId'];
$result=mysql_query("SELECT * FROM ".SQL_TABLE_CATEGORY." WHERE CategoryId='$CategoryId'", $con);
$row = mysql_fetch_array($result);
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="GENERATOR" content="Microsoft FrontPage 3.0">
<title><?php echo WEB_TITLE;?></title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<br>管理 -> 类别 -> 修改<br><br><br>
<form method="POST" action="admin_category_save.php">
<input type="hidden" name=CategoryId value=<?php echo $CategoryId; ?>>
<input type="hidden" name=action value="edit">
    <table border="0" cellspacing="1" width=800>
        <tr>
            <td align="right" height="30">类别名</td>
            <td height="30"><input type="text" name="CategoryName" size="32" value="<?php echo $row['CategoryName']; ?>"></td>
        </tr>
        <tr>
            <td align="right" height="30"></td>
            <td height="30">
                <input type="submit" value=" 修 改 " name="cmdok"style="background-color: rgb(0,0,0); color: rgb(255,255,255); border: 1px dotted rgb(255,255,255)">&nbsp;
            </td>
        </tr>
    </table>
</form>

</body>
</html>
<?php include 'conn_db_close.php'; ?>