<?php
include_once"../config.php";
include_once "../mysql_link.php";
include_once "../tools_of_seem.php";

$link=connect();
escape($link,$_POST);
$member_state=is_login($link);
if(!isset($_GET['id'])||!is_numeric($_GET['id'])){echo "<script>window.location.href='../seemblog.php?id=1'</script>";}
//处理id


if($_POST['comment']==''){
    echo '<script>window.alert("请输入内容");window.history.back();</script>';exit;
}

if (!isset($_GET['id'])||!isset($_POST['comment'])){
    echo '<script>window.alert("错误操作");window.history.back();</script>';
}
if (isset($member_state )&&$member_state){
    $query = "insert into comment(uid,name,content,time,blog_id ) values ('{$_COOKIE['tuid']}','{$_COOKIE['tid']}',
    '{$_POST['comment']}',now(),'{$_GET['id']}')";
    $result=mysqli_query($link,$query);
    $query="update artical set replynum=replynum+1 where id={$_GET['id']}";
    $result=mysqli_query($link,$query);
    echo "<script>window.location.href='../seemblog.php?id={$_GET['id']}&g5c5gv=1';</script>";
}
    else {
        echo "<script>window.alert('你还没有登录');window.location.href='../login.php';</script>";
    }

?>
