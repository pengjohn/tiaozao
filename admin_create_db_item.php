<?php include 'conn_db_open.php'; ?>
<?php
    echo "CreateDB...<br>";
    $sql = "CREATE TABLE ".SQL_TABLE_ITEM."
    (
        ItemId int NOT NULL AUTO_INCREMENT, 
        PRIMARY KEY(ItemId),
        ItemCategory int,
        ItemName varchar(128),
        ItemStatus varchar(128),
        ItemSeller varchar(64),
        ItemSellType int,
        ItemPriceMin int,
        ItemPrice int,
        ItemPriceMax int,
        ItemStartTime datetime,
        ItemEndTime datetime,
        ItemTime datetime,
        ItemClose int,
        ItemLocation varchar(128),
        ItemDescribe varchar(512),
        ItemPhoto varchar(256),
        ItemPhoto1 varchar(256),
        ItemPhoto2 varchar(256),
        ItemPhoto3 varchar(256),
        ItemPhoto4 varchar(256)
    )CHARACTER SET utf8 COLLATE utf8_unicode_ci";
    mysql_query($sql,$con);
    echo "sql: ".mysql_error()."<br>";
?>
<?php include 'conn_db_close.php'; ?>