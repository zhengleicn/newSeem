<?php
include_once"../config.php";
include_once "../mysql_link.php";

$link=connect();

//有一个get参数（id），已进行基本处理
if(!isset($_GET['id'])||!is_numeric($_GET['id'])){echo "<script>window.location.href='../seemblog.php?id=1'</script>";}


//防止xxs注入模块



$_POST['content']=htmlspecialchars($_POST['content']);
$_POST['title']=htmlspecialchars($_POST['title']);

//$_POST['content']=str_replace("\n",'<br/>',$_POST['content']);
$_POST['content']=str_replace("\r",'<br/>',$_POST['content']);
//nl2br($_POST['content']);
$_POST['content']=str_replace(" ",'&nbsp;',$_POST['content']);

//防止sql注入,还没写


if(isset($_COOKIE['tid'])&&isset($_COOKIE['tuid'])&&isset($_COOKIE['tpw'])){//cookie是否设置
    if(isset($_POST['content'])&&isset($_POST['title'])&&$_POST['title']!=''){//是否设置标题和文本
        $query="SELECT * from tinkusers where uid='{$_COOKIE['tuid']}' and sha1(password)='{$_COOKIE['tpw']}' ";
        $result=mysqli_query($link,$query);
        $row_user=mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)==1) {//cookie信息是否可以对应
            $query="select * from artical where uid={$row_user['uid']} and id={$_GET['id']}";
            $result= execute($link,$query);
//是否为作者
            if(mysqli_num_rows($result)==1) {
                $title_update=$_POST["title"];
                $content_update=$_POST['content'];
                $query_update = "update artical set title='{$title_update}', content='{$content_update}',type={$_POST["type"]},edit_time=now() where id='{$_GET["id"]}'";
                $result_update=mysqli_query($link,$query_update);
                if($result_update) {
                    echo "<script language='javascript' type='text/javascript'>";
                    echo "window.alert('修改成功');window.location.href='../seemblog_list.php';";
                    echo "</script>";
                }
                else{
                    echo "<script language='javascript' type='text/javascript'>";
                    echo "window.alert('修改失败');window.location.href='../seemblog_list.php';";
                    echo "</script>";
                }
            }
            else{
                echo "<script>window.alert('非法操作');window.location.href='../index.php';</script>";
            }

        }
        else {
            echo "<script>window.alert('你还没有登录');window.location.href='../login.php';</script>";
            //此处为非法操作，应记录用户信息，但是还没写
        }
    }
    else{
        echo '<script>window.alert("标题和内容不能为空");window.history.back();window.location.href="../seemblog_list.php";</script>';
    }

}
else {
    echo "<script>window.alert('你还没有登录');window.location.href='../login.php';</script>";
}


?>
