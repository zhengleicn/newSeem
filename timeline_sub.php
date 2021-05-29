<?php
include_once"config.php";
include_once "mysql_link.php";

$link=connect();
escape($link,$_POST);

if(isset($_COOKIE['tid'])&&isset($_COOKIE['tuid'])&&isset($_COOKIE['tpw'])){
    $query="SELECT * from tinkusers where uid='{$_COOKIE['tuid']}' and sha1(password)='{$_COOKIE['tpw']}' ";
    $result=mysqli_query($link,$query);
    if(mysqli_num_rows($result)==1) {
        $query="insert into tin(uid,name,content) values ('{$_COOKIE['tuid']}','{$_COOKIE['tid']}','{$_POST['content']}')";
        $result=mysqli_query($link,$query);
        echo "<script language='javascript' type='text/javascript'>";
        echo "window.location.href='timeline.php'";
        echo "</script>";



    }
    else {
        echo "<script>window.alert('你还没有登录');window.location.href='login.php';</script>";
    }

}
?>