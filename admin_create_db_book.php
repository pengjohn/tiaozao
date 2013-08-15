<?php include 'conn_db_open.php'; ?>
<?php
    echo "CreateDB...<br>";
    $sql = "CREATE TABLE ".SQL_TABLE_BOOK."
    (
        BookId int NOT NULL AUTO_INCREMENT, 
        PRIMARY KEY(BookId),
        BookItemId int,
        BookUserId int,
        BookUserName varchar(32),
        BookPrice int,
        BookTime datetime
    )CHARACTER SET utf8 COLLATE utf8_unicode_ci";
    mysql_query($sql,$con);
    echo "sql: ".mysql_error()."<br>";
?>
<?php include 'conn_db_close.php'; ?>
