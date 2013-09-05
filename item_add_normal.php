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
<form method="POST" action="item_save_normal.php" enctype="multipart/form-data">
<input type="hidden" name=action value="new">
<input type="hidden" name=ItemSellType value="0">
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
            <td align="right" height="30">新旧程度</td>
            <td height="30"><input type="text" name="ItemStatus" size="32"></td>
        </tr>
        <tr>
            <td align="right" height="30">截止时间：</td>
            <td height="30">
                <select name="ItemEndTimeY" size="1">
                    <option value=<?php echo(idate("Y")); ?>><?php echo(idate("Y")); ?>年</option>
                    <?php
                      for($i=2013;$i<2016;$i++)
                            echo "<option value=".$i.">".$i."年</option><br>";
                    ?>
                </select>
                <select name="ItemEndTimeM" size="1">
                    <option value=<?php echo(idate("m")); ?>><?php echo(idate("m")); ?>月</option>
                    <?php
                      for($i=1;$i<=12;$i++)
                            echo "<option value=".$i.">".$i."月</option><br>";
                    ?>
                </select>
                <select name="ItemEndTimeD" size="1">
                    <option value=<?php echo(idate("d")); ?>><?php echo(idate("d")); ?>日</option>
                    <?php
                      for($i=1;$i<=31;$i++)
                            echo "<option value=".$i.">".$i."日</option><br>";
                    ?>
                </select>
                <select name="ItemEndTimeH" size="1">
                  <option value=<?php echo(idate("H")); ?>><?php echo(idate("H")); ?>:00时</option>
                    <?php
                      for($i=0;$i<=23;$i++)
                            echo "<option value=".$i.">".$i.":00时</option><br>";
                    ?>
                </select>
            </td>
        </tr>       
        <tr>
            <td align="right" height="30">价格</td>
            <td height="30"><input onkeyup="this.value=this.value.replace(/\D/g,'') " onafterpaste ="this.value=this.value.replace(/\D/g,'')" type="text" name="ItemPrice" size="10"></td>
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
            <input type="submit" value=" 添 加 " name="cmdok" style="width:100px;height:30px;font-size:20px">&nbsp;
            <input type="reset" value=" 清 除 " name="cmdcancel" style="width:100px;height:30px;font-size:20px">
            </td>
        </tr>
    </table>
</form>
<br>-----------------------------------------------<br>
<a href=index.php>返回首页</a>

</body>
</html>
<?php include 'conn_db_close.php'; ?>