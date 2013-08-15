<?php include 'conn_db_open.php'; ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<Script Language ="JavaScript">
function new_success()
{
    alert("注册成功！");
    self.location='index.php';
}

function new_fail()
{
    alert("注册失败, 此账号已被注册！");
    self.location='user_registe.php';
}

function edit_success()
{
    alert("修改成功！");
    self.location='index.php';
}

function edit_fail()
{
    alert("修改成功！");
    self.location='index.php';
}
</Script>
</Head>

<?php
session_start();
$id = $_POST['id'];
$account = $_POST['account'];
$password = md5($_POST['password']);
$passwordOld = md5($_POST['passwordOld']);
$name = $_POST['name'];
$action = $_POST['action'];

//echo "<br>id:".$id;
//echo "<br>name:".$name;
//echo "<br>password:".$password;
//echo "<br>passwordOld:".$passwordOld;
//echo "<br>action:".$action;

if($action == "new")
{
    $result=mysql_query("SELECT * FROM ".SQL_TABLE_USER." WHERE UserAccount='$account'", $con);
    $num_rows = mysql_num_rows($result);
        
    if($num_rows >=1)
    {
        //账号已被注册
        echo "<body onload=new_fail()>";
        echo "</body>";
    }
    else
    {
        //注册账号
        $sql = "INSERT INTO ".SQL_TABLE_USER." (UserId, UserAccount, UserPassword) VALUES (NULL, '$account', '$password')";
        mysql_query($sql, $con);
        echo "sql: ".mysql_error()."<br>";

        //直接登录账号
        $result=mysql_query("SELECT * FROM ".SQL_TABLE_USER." WHERE UserAccount='$account'", $con);
        $row = mysql_fetch_array($result);
        $_SESSION['tz_re_UserId'] = $row['UserId'];
        $_SESSION['tz_re_UserAccount'] = $row['UserAccount'];
        $_SESSION['tz_re_UserLevel'] = $row['UserLevel'];
        setcookie("tz_re_UserAccount", $_SESSION['tz_re_UserAccount'], time()+60*60*24*365); 
      
        echo "<body onload=new_success()>";
        echo "</body>";
    }
}
else if($action == "edit")
{
/*  
    echo "<br>goto edit";
    $sql = "UPDATE pingche_user Set password='$password' WHERE id='$id'";
    mysql_query($sql, $con);
    echo "sql: ".mysql_error()."<br>";
        
        echo "<body onload=edit_success()>";
        echo "</body>";
*/
}
?>

</Html>                 

<?php include 'conn_db_close.php'; ?>
