<?php include 'conn_db_open.php'; ?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="GENERATOR" content="Microsoft FrontPage 3.0">
<title>Gozone订餐系统</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<?php
$ItemId = $_GET['ItemId'];
$result=mysql_query("SELECT * FROM ".SQL_TABLE_ITEM.", ".SQL_TABLE_CATEGORY.
                    " WHERE ItemId='$ItemId' and ".SQL_TABLE_ITEM.".ItemCategory=".SQL_TABLE_CATEGORY.".CategoryId",
                    $con);
$row = mysql_fetch_array($result);

$ItemName = $row['ItemName'];
$ItemCategory = $row['ItemCategory'];
$ItemCategoryName = $row['CategoryName'];
$ItemPrice = $row['ItemPrice'];
$ItemStatus = $row['ItemStatus'];
$ItemDescribe = $row['ItemDescribe'];
?>

<body>
<br>管理 -> 商品 -> 修改<br><br><br>
<form method="POST" action="admin_item_save.php">
<input type="hidden" name=ItemId value=<?php echo $ItemId; ?>>
<input type="hidden" name=action value="edit">

    <table border="0" cellspacing="1" width=800>
        <tr>
            <td align="right" height="30">类别</td>
            <td height="30">
                <select name="ItemCategory" size="1">
                    <?php
                    echo "<option value=".$ItemCategory." selected> ".$ItemCategoryName." </option>\n";
                    $result=mysql_query("SELECT * FROM ".SQL_TABLE_CATEGORY." order by CategoryId", $con);
                    while($row = mysql_fetch_array($result))
                    {
                        echo "<option value=".$row['CategoryId']."> ".$row['CategoryName']." </option>";
                    }
                    ?>
                </select>
            </td>
        </tr>           
        <tr>
            <td align="right" height="30">名称</td>
            <td height="30"><input type="text" name="ItemName" size="32" value="<?php echo $ItemName; ?>"></td>
        </tr>
        <tr>
            <td align="right" height="30">价格</td>
            <td height="30"><input onkeyup="this.value=this.value.replace(/\D/g,'') " onafterpaste ="this.value=this.value.replace(/\D/g,'')" type="text" name="ItemPrice" size="10" value="<?php echo $ItemPrice; ?>"></td>
        </tr>
        <tr>
            <td align="right" height="30">新旧程度</td>
            <td height="30"><input type="text" name="ItemStatus" size="32" value="<?php echo $ItemStatus; ?>"></td>
        </tr>
        <tr>
            <td align="right" height="160" valign="top">描述</td>
            <td><textarea name="ItemDescribe" rows="16" cols="100" style="BORDER-BOTTOM: 1px solid;;font-size:9pt; BORDER-LEFT: 1px solid; BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid" title="内容不能超过1024个字符！"><?php echo $ItemDescribe; ?></textarea></td>
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

</body>
</html>
<?php include 'conn_db_close.php'; ?>