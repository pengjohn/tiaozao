<?php include 'conn.php'; ?>
<?php include 'conn_db_open.php'; ?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="GENERATOR" content="Microsoft FrontPage 3.0">
<title><?php echo WEB_TITLE;?></title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<?php
session_start();
$UserName = $_SESSION['tz_re_UserAccount'];

$ItemId = $_GET['ItemId'];
$result=mysql_query("SELECT * FROM ".SQL_TABLE_ITEM.
                    " WHERE ItemId='$ItemId' ",
                    $con);
$row = mysql_fetch_array($result);

$ItemSeller = $row['ItemSeller'];
$ItemClose = $row['ItemClose'];
?>

<body>
<br>管理 -> 商品 -> 修改<br><br><br>
<form method="POST" action="item_save.php">
<input type="hidden" name=ItemId value=<?php echo $ItemId; ?>>
<input type="hidden" name=action value="editStatus">

    <table border="0" cellspacing="1" width=800>
        <tr>
            <td align="right" height="30">交易状态</td>
            <td height="30">
                <select name="ItemClose" size="1">
                    <?php
                    echo "<option value=".ITEM_CLOSE_NORMAL." selected> ".getItemClose(ITEM_CLOSE_NORMAL)." </option>\n";
                    echo "<option value=".ITEM_CLOSE_SOLD." selected> ".getItemClose(ITEM_CLOSE_SOLD)." </option>\n";
                    echo "<option value=".ITEM_CLOSE_CANCEL." selected> ".getItemClose(ITEM_CLOSE_CANCEL)." </option>\n";
                    ?>
                </select>
            </td>
        </tr>           
        <tr>
            <td align="right" height="30"></td>
            <td height="30">
            <input type="submit" value=" 修 改 " name="cmdok" ">&nbsp;
            </td>
        </tr>   
        
    </table>
</form> 

</body>
</html>
<?php include 'conn_db_close.php'; ?>