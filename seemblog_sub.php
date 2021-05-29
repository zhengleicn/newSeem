<?php
include_once"config.php";
include_once "mysql_link.php";

$link=connect();


//防止xxs注入模块
$_POST['content']=htmlspecialchars($_POST['content']);
$_POST['title']=htmlspecialchars($_POST['title']);
//$_POST['content']=str_replace("\n",'<br/>',$_POST['content']);
$_POST['content']=str_replace("\r",'<br/>',$_POST['content']);
//nl2br($_POST['content']);
$_POST['content']=str_replace(" ",'&nbsp;',$_POST['content']);
//$_POST['content']=str_replace("&lt;img;","<img")白名单
$_POST=escape($link,$_POST);//防止sql注入


if(isset($_COOKIE['tid'])&&isset($_COOKIE['tuid'])&&isset($_COOKIE['tpw'])){
    if(isset($_POST['content'])&&isset($_POST['title'])&&$_POST['title']!=''){
    $query="SELECT * from tinkusers where uid='{$_COOKIE['tuid']}' and sha1(password)='{$_COOKIE['tpw']}' ";
    $result=mysqli_query($link,$query);

    if(mysqli_num_rows($result)==1) {
        $query="insert into artical(uid,name,title,replynum,content,time,edit_time ,type ) 
values ('{$_COOKIE['tuid']}','{$_COOKIE['tid']}','{$_POST['title']}','0','{$_POST['content']}',now(),now(),{$_POST['type']})";
        $result=mysqli_query($link,$query);
        echo "<script language='javascript' type='text/javascript'>";
        echo "window.location.href='seemblog_list.php'";
        echo "</script>";

    }
    else {
        echo "<script>window.alert('你还没有登录');window.location.href='login.php';</script>";
    }
    }
    else{
        echo '<script>window.alert("标题和内容不能为空");window.history.back();window.location.href="seemblog_list.php";</script>';
    }

    }
    else {
        echo "<script>window.alert('你还没有登录');window.location.href='login.php';</script>";
    }


?>
