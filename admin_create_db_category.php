<?php include 'conn_db_open.php'; ?>
<?php
		echo "CreateDB...<br>";
		$sql = "CREATE TABLE ".SQL_TABLE_CATEGORY."
		(
   			CategoryId int NOT NULL AUTO_INCREMENT, 
  			PRIMARY KEY(CategoryId),
        CategoryName varchar(32)
 		)CHARACTER SET utf8 COLLATE utf8_unicode_ci";
		mysql_query($sql,$con);
		echo "sql: ".mysql_error()."<br>";
?>
<?php include 'conn_db_close.php'; ?>