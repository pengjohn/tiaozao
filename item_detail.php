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
    echo "-----------------------------------------------<br>\n";
    echo "名称:".$row['ItemName']."<br>\n";
    echo "新旧程度:".$row['ItemStatus']."<br>\n";
    echo "价格:".$row['ItemPrice']."<br>\n";
    echo "截止:".$row['ItemEndTime']."<br>\n";
    echo "发布日期:".$row['ItemTime']."<br>\n";
    echo "卖家:".$row['ItemSeller']."<br>\n";
    echo "-----------------------------------------------<br>\n";
    if($row['ItemPhoto'] != null)
    {
       echo "<img src=".$row['ItemPhoto']." border=0 height=480>\n";
    }
    echo "<br><br>\n";
    echo $row['ItemDescribe']."<br>\n";
    echo "-----------------------------------------------<br>\n";
}
?>

<form method="POST" action="book_save.php">
<input type="hidden" name=ItemId value=<?php echo $ItemId; ?>>
<input type="text" name="ItemPrice" value="请出价"
       size="10" style="width:300px;height:60px;font-size:40px"
       onkeyup="this.value=this.value.replace(/\D/g,'') " 
       onafterpaste ="this.value=this.value.replace(/\D/g,'')" 
       onfocus="if(value=='请出价') {value=''}" onblur="if (value=='') {value='请出价'}" >
<input type="submit" value=" 我要预订 " name="cmdok" style="width:300px;height:60px;font-size:40px">
</form>

<br>-----------------------------------------------<br>
<a href=index.php>返回首页</a>
</body>
</html>
<?php include 'conn_db_close.php'; ?>