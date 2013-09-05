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
<br>管理 -> 商品 -> 列表<br>
<?php
session_start();
$UserName = $_SESSION['tz_re_UserAccount'];

$result=mysql_query("SELECT * FROM ".SQL_TABLE_CATEGORY.", ".SQL_TABLE_ITEM." 
                              WHERE ".SQL_TABLE_CATEGORY.".CategoryId=".SQL_TABLE_ITEM.".ItemCategory 
                              AND ".SQL_TABLE_ITEM.".ItemSeller='$UserName'
                              order by CategoryId, ItemTime desc", $con);

$CategoryId = -1;
while($row = mysql_fetch_array($result))
{
	 if($row['CategoryId'] != $CategoryId)
	 {
	 	$CategoryId = $row['CategoryId'];
	 	echo "<br>-----------------------[".$row['CategoryName']."]-----------------------<br>";
	 }
	 echo "[<a href=item_edit_close.php?ItemId=".$row['ItemId'].">修改</a>]";
	 echo "[<a href=".getSellTypeURL($row['ItemSellType'])."?ItemId=".$row['ItemId'].">".$row['ItemName']."</a>]";
	 echo "[".date('m-d', strtotime($row['ItemTime']) )."]";
	 echo "<br>";
}
?>
<br>-----------------------------------------------<br>
<a href=index.php>返回首页</a>

</body>
</html>
<?php include 'conn_db_close.php'; ?>