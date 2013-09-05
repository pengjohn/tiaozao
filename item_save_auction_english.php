<?php include 'conn_db_open.php'; ?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<Script Language ="JavaScript">
function new_success()
{
    alert("添加成功！");
    self.location='index.php';
}

function new_fail_price()
{
    alert("一口价不大于起拍价，添加失败！");
    history.back();
}

function edit_success()
{
    alert("修改成功！");
    self.location='index.php';
}
</Script>
</Head>

<?php
session_start();

$action = $_POST['action'];
$ItemId = $_POST['ItemId'];
$ItemCategory = $_POST['ItemCategory'];
$ItemName = $_POST['ItemName'];
$ItemSellType = $_POST['ItemSellType'];
$ItemPrice = $_POST['ItemPrice'];
$ItemPriceMin = $_POST['ItemPriceMin'];
$ItemPriceMax = $_POST['ItemPriceMax'];
$ItemStatus = $_POST['ItemStatus'];
$ItemDescribe = $_POST['ItemDescribe'];
$ItemSeller = $_SESSION['tz_re_UserAccount'];
$ItemClose = $_POST['ItemClose'];

$ItemStartTimeY = $_POST['ItemEndTimeY'];
$ItemStartTimeM = $_POST['ItemEndTimeM'];
$ItemStartTimeD = $_POST['ItemEndTimeD'];
$ItemStartTimeH = $_POST['ItemEndTimeH'];
$ItemStartTime=date('Y-m-d H:i:s', mktime($ItemStartTimeH, "0", "0", $ItemStartTimeM, $ItemStartTimeD, $ItemStartTimeY));

$ItemEndTimeY = $_POST['ItemEndTimeY'];
$ItemEndTimeM = $_POST['ItemEndTimeM'];
$ItemEndTimeD = $_POST['ItemEndTimeD'];
$ItemEndTimeH = $_POST['ItemEndTimeH'];
$ItemEndTime=date('Y-m-d H:i:s', mktime($ItemEndTimeH, "0", "0", $ItemEndTimeM, $ItemEndTimeD, $ItemEndTimeY));

if($action == "new")
{
    if($ItemPriceMax <= $ItemPriceMin)
    {
        echo "<body onload=new_fail_price()>";
        echo "</body>";
    }
    else
    {
        $uploadfile = upload_photo();
        $sql = "INSERT INTO ".SQL_TABLE_ITEM.
               " (ItemId, 
                  ItemCategory, 
                  ItemName, 
                  ItemSellType, 
                  ItemStartTime, 
                  ItemEndTime, 
                  ItemPrice, 
                  ItemPriceMin, 
                  ItemPriceMax, 
                  ItemStatus, 
                  ItemPhoto, 
                  ItemDescribe, 
                  ItemTime, 
                  ItemSeller) 
               VALUES 
                 (NULL, 
                  '$ItemCategory', 
                  '$ItemName', 
                  '$ItemSellType', 
                  '$ItemStartTime', 
                  '$ItemEndTime', 
                  '$ItemPrice', 
                  '$ItemPriceMin', 
                  '$ItemPriceMax', 
                  '$ItemStatus', 
                  '$uploadfile', 
                  '$ItemDescribe', 
                  NOW(), 
                  '$ItemSeller')";
        mysql_query($sql, $con);
        echo "<br>sql: ".mysql_error();
        echo "<body onload=new_success()>";
        echo "</body>";  
    } 
}
else if($action == "editStatus")
{
    echo "<br>goto edit";
    $sql = "UPDATE ".SQL_TABLE_ITEM."
            Set ItemClose='$ItemClose' 
            WHERE ItemId='$ItemId'";
    mysql_query($sql, $con);
    echo "<br>sql: ".mysql_error();
    echo "<body onload=edit_success()>";
    echo "</body>";
}
else if($action == "edit")
{
    echo "<br>goto edit";
    $sql = "UPDATE ".SQL_TABLE_ITEM."
            Set ItemCategory='$ItemCategory', 
            ItemName='$ItemName', 
            ItemPrice='$ItemPrice', 
            ItemStatus='$ItemStatus', 
            ItemDescribe='$ItemDescribe' 
            WHERE ItemId='$ItemId'";
    mysql_query($sql, $con);
    echo "<br>sql: ".mysql_error();
    echo "<body onload=edit_success()>";
    echo "</body>";
}

//获取文件后缀名函数
function fileext($filename)
{
    return substr(strrchr($filename, '.'), 1);
}

//生成随机文件名函数  
function random($length)
{
    /*$hash = 'CR-';
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
    $max = strlen($chars) - 1;
    mt_srand((double)microtime() * 1000000);
    for($i = 0; $i < $length; $i++)
    {
    $hash .= $chars[mt_rand(0, $max)];
    }
    */

    //改为时间戳, 如20130702_120432_12345678
    $time = date('Ymd_His');
    list($usec, $sec) = explode(" ", microtime());  
    $msec=round($usec*100000000);  
    $hash = $time."_".$msec;
    return $hash;
}

function upload_photo()
{
    $uploadfile = "";
    $uploaddir = "./files/";//设置文件保存目录 注意包含/  
    $type=array("jpg","gif","bmp","jpeg","png");//设置允许上传文件的类型
   
    echo "[".$_FILES['file']['name']."]";
    if($_FILES['file']['name']==NULL)
    {
        echo "无图片<br>\n";
    }
    //判断文件类型
    else if(!in_array(strtolower(fileext($_FILES['file']['name'])),$type))
    {
        $text=implode(",",$type);
        echo "您只能上传以下类型文件: ",$text,"<br>";
    }
    //生成目标文件的文件名  
    else
    {
        $filename=explode(".",$_FILES['file']['name']);
        do
        {
            $filename[0]=random(10); //设置随机数长度
            $name=implode(".",$filename);
            $uploadfile=$uploaddir.$name;
        }while(file_exists($uploadfile));

        echo $uploadfile."<br>";
        if (move_uploaded_file($_FILES['file']['tmp_name'],$uploadfile))
        {
            if(file_exists($uploadfile))
            {
                //输出图片预览
                echo "<center>上传图片预览: </center><br><center><img src='$uploadfile'></center>";
            }
            else
            {
                echo "上传失败！";
            }
        }
    }
    
    return $uploadfile;
}
?>
</Html>
<?php include 'conn_db_close.php'; ?>
