<?php
session_start();

$_SESSION['tz_re_UserId'] = "";
$_SESSION['tz_re_UserAccount'] = "";
$_SESSION['tz_re_UserLevel'] = 0;
setcookie("tz_re_UserAccount", "", time()-1);
			
header("Location: index.php");
?>

