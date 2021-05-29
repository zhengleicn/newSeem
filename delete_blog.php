<?php
include_once"config.php";
include_once "mysql_link.php";
include_once "tools_of_seem.php";
$link=connect();
$member_state=is_login($link);
if(!isset($_GET['home'])||!is_numeric($_GET['home'])){echo "<script>window.location.href='seemblog.php?id=1'</script>";}
//get处理

if(isset($_COOKIE['tid'])&&isset($_COOKIE['tuid'])&&isset($_COOKIE['tpw'])){
    //验证是否登录
    $query="select * from tinkusers where uid={$_COOKIE['tuid']}";
    $result= execute($link,$query);
    $row=mysqli_fetch_assoc($result);
    if (isset($member_state )&&$member_state){
//验证登录信息是否正确
        $query="select * from artical where uid={$_COOKIE['tuid'] } and id={$_GET['blog']}";
        $result= execute($link,$query);

        if(mysqli_num_rows($result)==1||$row['user_mode']==1){
//验证是否为作者或是否为超级账号


$query="delete from artical where id={$_GET['blog']}";
execute($link,$query);
$query="delete from comment where blog_id={$_GET['blog']}";
execute($link,$query);

if ($_GET['home']==0){
    echo "<script language='javascript' type='text/javascript'>";
    echo "window.location.href='seemblog_list.php'";
    echo "</script>";
}
else if($_GET['home']==1){
    echo "<script language='javascript' type='text/javascript'>";
    echo "window.location.href='member.php?people={$_COOKIE["tuid"]}'";
    echo "</script>";
}
        }
        else{
            echo '<script>window.alert("非法操作")</script>';
            $banfile = fopen("banfile.txt", "a") or die("Unable to open file!");
            $txt = "{$_SERVER['REMOTE_ADDR']}\n";
            fwrite($banfile, $txt);
            fwrite($banfile, "c");
            fclose($banfile);
        }
}
    else{
        echo '<script>window.alert("非法操作")</script>';
        $banfile = fopen("banfile.txt", "a") or die("Unable to open file!");
        $txt = "{$_SERVER['REMOTE_ADDR']}\n";
        fwrite($banfile, $txt);
        fwrite($banfile, "b");
        fclose($banfile);
    }
}
else{
    echo '<script>window.alert("非法操作")</script>';
    $banfile = fopen("banfile.txt", "a") or die("Unable to open file!");
    $txt = "{$_SERVER['REMOTE_ADDR']}\n";
    fwrite($banfile, $txt);
    fwrite($banfile, "a");
    fclose($banfile);
}

?>