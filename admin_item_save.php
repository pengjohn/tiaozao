<?php include 'conn_db_open.php'; ?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<Script Language ="JavaScript">
function new_success()
{
	alert("��ӳɹ���");
	self.location='admin_item_add.php';
}

function edit_success()
{
	alert("�޸ĳɹ���");
	self.location='admin_item_add.php';
}

</Script>

</Head>

<?php
session_start();

$action = $_POST['action'];
$ItemId = $_POST['ItemId'];
$ItemCategory = $_POST['ItemCategory'];
$ItemName = $_POST['ItemName'];
$ItemPrice = $_POST['ItemPrice'];
$ItemStatus = $_POST['ItemStatus'];
$ItemDescribe = $_POST['ItemDescribe'];
$ItemSeller = $_SESSION['tz_re_UserAccount'];

if($action == "new")
{
	$uploaddir = "./files/";//�����ļ�����Ŀ¼ ע�����/  
	$type=array("jpg","gif","bmp","jpeg","png");//���������ϴ��ļ�������
   
  echo "[".$_FILES['file']['name']."]";
	//�ж��ļ�����
	if(!in_array(strtolower(fileext($_FILES['file']['name'])),$type))
	{
		$text=implode(",",$type);
		echo "��ֻ���ϴ����������ļ�: ",$text,"<br>";
	}
	//����Ŀ���ļ����ļ���  
	else
	{
		$filename=explode(".",$_FILES['file']['name']);
		do
		{
			$filename[0]=random(10); //�������������
			$name=implode(".",$filename);
			$uploadfile=$uploaddir.$name;
		}while(file_exists($uploadfile));

		echo $uploadfile."<br>";
		if (move_uploaded_file($_FILES['file']['tmp_name'],$uploadfile))
		{
			if(file_exists($uploadfile))
			{
				//���ͼƬԤ��
				echo "<center>�ϴ�ͼƬԤ��: </center><br><center><img src='$uploadfile'></center>";
			}
			else
			{
				echo "�ϴ�ʧ�ܣ�";
			}
		}
	}
	
    echo "<br>goto new";
    $sql = "INSERT INTO ".SQL_TABLE_ITEM.
           " (ItemId, ItemCategory, ItemName, ItemPrice, ItemStatus, ItemPhoto, ItemDescribe, ItemTime, ItemSeller) 
           VALUES (NULL, '$ItemCategory', '$ItemName', '$ItemPrice', '$ItemStatus', '$uploadfile', '$ItemDescribe', NOW(), '$ItemSeller')";
    mysql_query($sql, $con);
    echo "<br>sql: ".mysql_error();

		echo "<body onload=new_success()>";
		echo "</body>";    
}
else if($action == "edit")
{
    echo "<br>goto edit";
    $sql = "UPDATE ".SQL_TABLE_ITEM.
           " Set ItemCategory='$ItemCategory', 
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

//��ȡ�ļ���׺������
function fileext($filename)
{
	return substr(strrchr($filename, '.'), 1);
}

//��������ļ�������  
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

	//��Ϊʱ���, ��20130702_120432_12345678
	$time = date('Ymd_His');
	list($usec, $sec) = explode(" ", microtime());  
	$msec=round($usec*100000000);  
	$hash = $time."_".$msec;
	return $hash;
}
?>
</Html>
<?php include 'conn_db_close.php'; ?>
