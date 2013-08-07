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
<?php echo WEB_TITLE;?>
<br>

<?php
$ItemId = $_GET['ItemId'];
$result=mysql_query("SELECT * FROM ".SQL_TABLE_ITEM." 
                              WHERE ItemId=".$ItemId.
                              " order by ItemId", $con);

while($row = mysql_fetch_array($result))
{
	 echo "------------------------------------<br>\n";
	 echo "名称:".$row['ItemName']."<br>\n";
	 echo "价格:".$row['ItemPrice']."<br>\n";
	 echo "新旧程度:".$row['ItemStatus']."<br>\n";
	 echo "发布日期:".$row['ItemTime']."<br>\n";
	 echo "卖家:".$row['ItemSeller']."<br>\n";
	 echo "------------------------------------<br>\n";
	 echo "<img src=".$row['ItemPhoto']." border=0 height=480>\n";
	 echo "<br><br>\n";
	 echo $row['ItemDescribe']."<br>\n";
	 echo "<br>";
}
?>

</body>
</html>
<?php include 'conn_db_close.php'; ?>