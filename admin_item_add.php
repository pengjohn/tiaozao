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
<br>管理 -> 商品 -> 添加<br><br><br>
<form method="POST" action="admin_item_save.php" enctype="multipart/form-data">
<input type="hidden" name=action value="new">

	<table border="0" cellspacing="1" width=800>
		<tr>
			<td align="right" height="30">类别</td>
			<td height="30">
				<select name="ItemCategory" size="1">
					<?php
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
			<td height="30"><input type="text" name="ItemName" size="32"></td>
		</tr>
		<tr>
			<td align="right" height="30">价格</td>
			<td height="30"><input onkeyup="this.value=this.value.replace(/\D/g,'') " onafterpaste ="this.value=this.value.replace(/\D/g,'')" type="text" name="ItemPrice" size="10"></td>
		</tr>
		<tr>
			<td align="right" height="30">新旧程度</td>
			<td height="30"><input type="text" name="ItemStatus" size="32"></td>
		</tr>
		<tr>
    	<td align="right" height="30"><input type="hidden" name="MAX_FILE_SIZE" value="2000000">图片</td>
    	<td height="30"><input name="file" type="file"></td>
    </tr>
		<tr>
			<td align="right" height="160" valign="top">描述</td>
			<td><textarea name="ItemDescribe" rows="16" cols="100" style="BORDER-BOTTOM: 1px solid;;font-size:9pt; BORDER-LEFT: 1px solid; BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid" title="内容不能超过1024个字符！"></textarea></td>
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
$result=mysql_query("SELECT * FROM ".SQL_TABLE_CATEGORY.", ".SQL_TABLE_ITEM." 
                              WHERE ".SQL_TABLE_CATEGORY.".CategoryId=".SQL_TABLE_ITEM.".ItemCategory 
                              order by CategoryId, ItemTime desc", $con);

$CategoryId = -1;
while($row = mysql_fetch_array($result))
{
	 if($row['CategoryId'] != $CategoryId)
	 {
	 	$CategoryId = $row['CategoryId'];
	 	echo "<br>-----------------------[".$row['CategoryName']."]-----------------------<br>";
	 }
	 echo "[<a href=admin_item_edit.php?ItemId=".$row['ItemId'].">修改</a>]";
	 echo "[<a href=admin_item_del.php?ItemId=".$row['ItemId'].">删除</a>]";
	 echo $row['ItemName'];
	 echo "[".date('m-d', strtotime($row['ItemTime']) )."]";
	 echo "<br>";
}
?>

</body>
</html>
<?php include 'conn_db_close.php'; ?>