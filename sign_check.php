<?php
include_once"config.php";
include_once "mysql_link.php";
header("Content-type: text/html; charset=utf-8");
$link=connect();

/*$class='2,34,37,39,40';
$query="select * from tinkusers where uid in ({$class}) order by uid  " ;
$result= mysqli_query($link,$query);
while ($row=mysqli_fetch_assoc($result)){
    echo $row['name'];
}
exit;*/

if (isset($_POST['submit'])){
    if($_POST['name']==''){
        echo "<script>window.alert('无法注册空id');window.location.href='sign.php';</script>";
    }
    else if($_POST['pw']==''){
        echo "<script>window.alert('请输入密码');window.location.href='sign.php';</script>";
    }

    else {

        $query = "insert into tinkusers(name,password,followers,follow,introduce) values ('{$_POST['name']}',md5('{$_POST['pw']}'),'2','2','')";
        $result = mysqli_query($link, $query);
        //$query="SELECT * from tinkusers where name='{$_POST['name']}' and password=md5('{$_POST['pw']}')";
        //$result=mysqli_query($link,$query);
        //$row=mysqli_fetch_assoc($result);
        //$plus_num=mysqli_num_rows($result);
        $query = "select max(uid) from tinkusers";
        $result = mysqli_query($link, $query);

        $row = mysqli_fetch_assoc($result);
        setcookie("tuid", $row['max(uid)'], time() + 259200,'/');
        setcookie("tpw", sha1(md5($_POST['pw'])), time() + 259200,'/');
        setcookie("tid", $_POST["name"], time() + 259200,'/');
        echo "<script language='javascript' type='text/javascript'>";
        echo "window.location.href='index.php'";
        echo "</script>";
    }

}
