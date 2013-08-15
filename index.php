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
session_start();

//如果SESSION为空 且 COOKIE不为空，说明是刚打开浏览器，则根据cookie自动登录
$cookieid = $_COOKIE['tz_re_UserId'];
if($_SESSION['tz_re_UserId']=="" && $cookiename!="" )
{
    $result=mysql_query("SELECT * FROM ".SQL_TABLE_USER." WHERE UserId='$cookieid'", $con);
    $row = mysql_fetch_array($result);
    $_SESSION['tz_re_UserId'] = $row['UserId'];
    $_SESSION['tz_re_UserAccount'] = $row['UserAccount'];
    $_SESSION['tz_re_UserLevel'] = $row['UserLevel'];
}

//显示用户信息
if($_SESSION['tz_re_UserAccount'] =="")
{ 
    echo "[<a href=user.php>登录</a>]　　[<a href=user_register.php>注册</a>]<br><br>";
}
else
{
    echo "用户:".$_SESSION['tz_re_UserAccount']."　　[<a href=user_logout.php>登出</a>]<br>";
    echo "id:".$_SESSION['tz_re_UserId']."<br>";
    echo "<a href=item_add.htm>添加商品</a><br>\n";

    if($_SESSION['tz_re_UserLevel'] >=100)
    {
        echo "<a href=admin_category_add.php>添加分类</a><br>\n";
    }
}
?>

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
    echo "[".date('m-d', strtotime($row['ItemTime']) )."]";
    
    switch($row['ItemSellType'])
    {
        case SELL_TYPE_NORMAL:
            $detailURL = "item_detail_normal.php";
            break;
        case SELL_TYPE_AUCTION_ENGLISH:
            $detailURL = "item_detail.php";
            break;
        case SELL_TYPE_AUCTION_DUTCH:
            $detailURL = "item_detail.php";
            break;
        case SELL_TYPE_AUCTION_SECRET_HIGH:
            $detailURL = "item_detail.php";
            break;
        case SELL_TYPE_AUCTION_SECRET_CLOSEST:
            $detailURL = "item_detail.php";
            break;
        default:
            $mode2txt = "无";
            break;
    } 
    echo "<a href=".$detailURL."?ItemId=".$row['ItemId'].">".$row['ItemName']."</a> [".type2txt($row['ItemSellType'])."]";
    if($row['ItemClose']>=1)
    {
        echo "<font color=red>[交易已经关闭]</font>";
    }
    echo "<br>";
}
?>

</body>
</html>
<?php include 'conn_db_close.php'; ?>