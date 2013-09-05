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
$row = mysql_fetch_array($result);
echo "-----------------------------------------------<br>\n";
echo "名称:".$row['ItemName']."<br>\n";
echo "新旧程度:".$row['ItemStatus']."<br>\n";
echo "起拍价:".$row['ItemPriceMin']."<br>\n";
echo "一口价:".$row['ItemPriceMax']."<br>\n";
echo "截止:".$row['ItemEndTime']."<br>\n";
echo "卖家:".$row['ItemSeller']."<br>\n";
echo "发布日期:".$row['ItemTime']."<br>\n";
echo "-----------------------------------------------<br>\n";
if($row['ItemPhoto'] != null)
{
   echo "<img src=".$row['ItemPhoto']." border=0 height=480>\n";
}
echo "<br><br>\n";
echo $row['ItemDescribe']."<br>\n";
echo "-----------------------------------------------<br>\n";

$result_book=mysql_query("SELECT * FROM ".SQL_TABLE_BOOK." WHERE BookItemId='$ItemId' order by BookPrice desc", $con);
while($row_book = mysql_fetch_array($result_book))
{
    echo "[".$row_book['BookTime']."][".$row_book['BookUserName']."]出价: ".$row_book['BookPrice']."<br>\n";
}
echo "-----------------------------------------------<br>\n";

if($row['ItemClose'] == 0)
{
?>
<form method="POST" action="book_save_auction_english.php">
<input type="hidden" name=ItemId value=<?php echo $ItemId; ?>>
<input type="text" name="ItemPrice" value="请输入价格"
       size="10" style="width:300px;height:60px;font-size:40px"
       onkeyup="this.value=this.value.replace(/\D/g,'') " 
       onafterpaste ="this.value=this.value.replace(/\D/g,'')" 
       onfocus="if(value=='请输入价格') {value=''}" onblur="if (value=='') {value='请输入价格'}" >
<input type="submit" value=" 出价 " name="cmdok" style="width:300px;height:60px;font-size:40px">
</form>
<br>-----------------------------------------------<br>
<?php
}
?>
<a href=index.php>返回首页</a>
</body>
</html>
<?php include 'conn_db_close.php'; ?>