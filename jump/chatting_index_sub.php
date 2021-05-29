<?php
include_once"../config.php";
include_once "../mysql_link.php";
include_once "../tools_of_seem.php";

$link=connect();
escape($link,$_POST);
$member_state=is_login($link);
if(!isset($_GET['uid'])||!is_numeric($_GET['uid'])){echo "<script>window.location.href='../seemblog.php?id=1'</script>";}
//处理uid，如果用户输入非数字或没输入uid跳转到404文章




if (!isset($_GET['id'])||!isset($_POST['content'])){
    echo '<script>window.alert("错误操作");window.history.back();</script>';
}
if (isset($member_state )&&$member_state){
    $query = "insert into chatting_index(uid,name,content,time ) values ('{$_GET['uid']}','{$_GET['id']}',
    '{$_GET['t']}',now())";
    $result=mysqli_query($link,$query);
}
else {
    echo "<script>window.alert('你还没有登录');window.location.href='../login.php';</script>";
}

?>
