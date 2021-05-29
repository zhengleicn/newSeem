<?php
include_once"config.php";
include_once "mysql_link.php";
include_once "login_check.php";
include_once "tools_of_seem.php";
$link=connect();
$member_state=is_login($link);
if(!$member_state){
    echo '<script>window.alert("未登录，无需退出")</script>';
}
setcookie('tuid','',time()-259200,'/');
setcookie('tid','',time()-259200,'/');
setcookie('tpw','',time()-259200,'/');
     echo '<script>window.alert("退出成功")</script>';
     echo "<script language='javascript' type='text/javascript'>";
     echo "window.location.href='index.php'";
     echo "</script>";
?>
?>
