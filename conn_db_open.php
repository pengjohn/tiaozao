<?php
define("SQL_SERVER","192.168.0.196");
define("SQL_USER","pengjohn");
define("SQL_PWD","gozone");
define("SQL_DB","pengjohn");

define("SQL_TABLE_USER","tz_re_user");
define("SQL_TABLE_CATEGORY","tz_re_category");
define("SQL_TABLE_ITEM","tz_re_item");
define("SQL_TABLE_BOOK","tz_re_book");

$con = mysql_connect(SQL_SERVER,SQL_USER,SQL_PWD);
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_query("SET names utf8");
mysql_select_db(SQL_DB, $con);
?>
   