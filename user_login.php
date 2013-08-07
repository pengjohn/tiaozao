<?php include 'conn_db_open.php'; ?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<Script Language ="JavaScript">
function login_success(){
alert("欢迎你回来！");
self.location='index.php';
}

function login_fail_account_invalid(){
alert("无效账号！");
self.location='user.php';
}

function login_fail_password_error(){
alert("密码错误！");
self.location='user.php';
}
</Script>
</Head>

<?php
session_start();

$account = $_POST['account'];
$password = md5($_POST['password']);
		
echo "<br>account:".$account;
echo "<br>password:".$password;

$result=mysql_query("SELECT * FROM ".SQL_TABLE_USER." WHERE UserAccount='$account'", $con);
echo "<br>sql: ".mysql_error()."<br>";
$num_rows = mysql_num_rows($result);
if($num_rows >=1)
{
  $row = mysql_fetch_array($result);
	if($row['UserPassword'] == $password)
	{
		  $_SESSION['tz_re_UserId'] = $row['UserId'];
			$_SESSION['tz_re_UserAccount'] = $row['UserAccount'];
			$_SESSION['tz_re_UserLevel'] = $row['UserLevel'];
			setcookie("tz_re_UserAccount", $_SESSION['tz_re_UserAccount'], time()+60*60*24*365); 
	
			echo "<body onload=login_success()>";
			echo "</body>";
	}
	else
	{
			echo "<body onload=login_fail_password_error()>";
			echo "</body>";
	}
}
else
{
			echo "<body onload=login_fail_account_invalid()>";
			echo "</body>";
}
?>

</Html>
<?php include 'conn_db_close.php'; ?>

