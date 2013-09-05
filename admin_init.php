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
<a href=admin_create_db_user.php>创建用户数据库</a><br>
<a href=admin_create_db_category.php>创建分类数据库</a><br>
<a href=admin_create_db_item.php>创建物品数据库</a><br>
<a href=admin_create_db_book.php>创建拍卖数据库</a><br>
<br><br>

<a href=admin_category_add.php>添加分类</a><br>
<a href=admin_item_add.php>添加商品</a><br>

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
<br>-----------------------------------------------<br>
<a href=index.php>返回首页</a>
</body>
</html>