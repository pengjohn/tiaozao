<?php include 'conn_db_open.php'; ?>
<?php
    echo "CreateDB...<br>";
    $sql = "CREATE TABLE ".SQL_TABLE_USER."
    (
        UserId int NOT NULL AUTO_INCREMENT, 
        PRIMARY KEY(UserId),
        UserAccount varchar(32),
        UserPassword varchar(100),
        UserName varchar(32),
        UserIM varchar(64),
        UserPhone varchar(64),
        UserAddress varchar(128),
        UserLevel int default 0,
        UserExp int default 0
    )CHARACTER SET utf8 COLLATE utf8_unicode_ci";
    mysql_query($sql,$con);
    echo "sql: ".mysql_error()."<br>";
?>
<?php include 'conn_db_close.php'; ?>