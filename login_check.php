<?php
include_once"config.php";
include_once "mysql_link.php";
header("Content-type: text/html; charset=utf-8");
$link=connect();
escape($link,$_POST);

if(isset($_POST['submit'])){
    $query="SELECT * from tinkusers where uid='{$_POST['uid']}' and password=md5('{$_POST['pw']}')";
    $result=mysqli_query($link,$query);
    $row=mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)==1) {
        setcookie("tuid", $_POST['uid'], time() + 259200,'/');
        setcookie("tpw", sha1(md5($_POST['pw'])), time() + 259200,'/');
        setcookie("tid",$row["name"], time() + 259200,'/');
        echo "<script language='javascript' type='text/javascript'>";
        echo "window.location.href='index.php'";
        echo "</script>";



    }
    else {
        echo '<script>window.alert("密码错误");window.history.back();</script>';
    }

}
?>