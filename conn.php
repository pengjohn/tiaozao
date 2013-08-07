<?php
session_start();
define("WEB_TITLE","软二跳蚤市场"); 

function is_admin()
{
	if($_SESSION['tz_userlevel'] >=10)
	  return true;
	else
	  return false;
}
?>
   