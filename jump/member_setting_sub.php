<?php
include_once "../config.php";
include_once "../mysql_link.php";
header("Content-type: text/html; charset=utf-8");

$link=connect();
if(!isset($_GET['id'])||!is_numeric($_GET['id'])){echo "<script>window.location.href='../seemblog.php?id=1';</script>";exit();}
//判断Get传递的参数为数字
if($_POST['newpassword']!=$_POST['comfirm_newpassword']){echo "<script>window.alert('两次密码输入不一致'); window.history.back();</script>";exit();}
//判断两次密码是否输入一致
if ($_POST['name']==''){echo "<script>window.alert('名字或密码不得为空'); window.history.back();</script>";exit();}
//判断名字是否为空

if (isset($_COOKIE['tuid'])&&isset($_COOKIE['tid'])&&isset($_COOKIE['tpw'])){
    //$query=" select uid,name,password from tinkusers where uid='{$_COOKIE['tuid']}' and name='{$_COOKIE['tid']}' and sha1(password)='{$_COOKIE['tpw']}' ";
    //$query_check="SELECT uid , name , password from tinkusers where uid='{$_COOKIE['tuid']}' and sha1(password)='{$_COOKIE['tpw']}' ";
    $query_check="SELECT * from tinkusers where uid='{$_COOKIE['tuid']}' and sha1(password)='{$_COOKIE['tpw']}'";
    //通过判断cookie的两个信息能否从数据库搜索到一条数据，判断是否登录
    $result=mysqli_query($link,$query_check);
    $password_check=mysqli_fetch_assoc($result); //判断原先的密码是否输入正确
echo mysqli_num_rows($result);

    if($_POST['newpassword']==''){
        $_POST['newpassword']=$password_check['password'];
    }//空置密码将视为不修改密码
    else{
        $_POST['newpassword']=md5($_POST['newpassword']);//newpassword经过md5加密处理
    }

    if ($password_check['password']==md5($_POST['oldpassword'])) {
        if (mysqli_num_rows($result)==1) {
            $query_update = "update artical set name ='{$_POST['name']}'where uid='{$_COOKIE['tuid']}' ";
            $result = mysqli_query($link, $query_update);
            $query_update = "update tinkusers set name ='{$_POST['name']}',password='{$_POST['newpassword']}',introduce='{$_POST['introduce']}'where uid='{$_COOKIE['tuid']}'  and sha1(password)='{$_COOKIE['tpw']}'";
            $result = mysqli_query($link, $query_update);

            setcookie("tuid", $password_check['uid'], time() + 259200,'/');
            setcookie("tpw", sha1($_POST['newpassword']), time() + 259200,'/');
            setcookie("tid",$_POST['name'], time() + 259200,'/');
            echo '<script>window.alert("修改成功");window.history.back();</script>';

        }
        else {
            echo '<script>window.alert("非法操作1");window.history.back();</script>';
        }
    }
    else{
       echo "<script>window.alert('旧密码输入错误'); window.history.back();</script>";exit();
   }
}
else {
    echo '<script>window.alert("非法操作2");window.history.back();</script>';
}

?>