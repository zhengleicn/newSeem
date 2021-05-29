<?php
include_once"config.php";
include_once "mysql_link.php";
include_once "login_check.php";
include_once "tools_of_seem.php";

$url_user_setting = "";
$link=connect();
$member_state=is_login($link);
$member_uid=is_login_uid($link);
$superid=is_super_id($link);
$delete_button='';
$edit_button='';
$user_setting_button='';
if(isset($member_state )&&$member_state&&isset($member_uid)&&$member_uid){


    if(isset($_GET['people'])&&$_GET['people']==$_COOKIE['tuid']){
        $delete_button='删除';
        $edit_button='编辑';
        $user_setting_button='账号设置';
    }
}


if(!isset($_GET['people']) || !is_numeric($_GET['people'])){
    echo '<script>window.alert("用户不存在")</script>';
}
else
{
$query = "select * from tinkusers where uid={$_GET['people']}";
$result = execute($link, $query);
$result_member_data = mysqli_fetch_assoc($result);
$url_user_setting="member_setting.php?id={$_GET['people']}";
if (mysqli_num_rows($result) != 1) {
    echo '<script>window.alert("用户不存在");window.history.back()</script>';exit;
}
?>

    <!DOCTYPE html>
    <?php include 'header.php' ?>
<div class="main_container">

    <div class="left_main">
        <h3>&nbsp;&nbsp;&nbsp;文章列表</h3>
        <?php


        $query = "select * from artical where uid={$_GET['people']} order by edit_time desc ";
        $result_blog = mysqli_query($link, $query);
        $artical_num = mysqli_num_rows($result_blog);

        //判断文章数量

        $url_delete = "";
        $url_edit = "";


        while ($datarow = mysqli_fetch_assoc($result_blog)) {
            //$datarow['title']=htmlspecialchars($datarow['title']);
            $url_delete = "delete_blog.php?blog={$datarow['id']}&home=1";
            $url_edit = "seemblog_edit.php?id={$datarow['id']}";

            $html = <<<A
<div id="artical">
    <article >
        <h3 style="margin: 0;"><a href="seemblog.php?id={$datarow['id']}" style="text-decoration:none;color: black">{$datarow['title']}</a></h3>
        <p style="font-size: small;padding: 0;">
        <a href="#" style="text-decoration:none;color: black"> {$datarow['edit_time']}</a>&nbsp;&nbsp;&nbsp;&nbsp;

        &nbsp;&nbsp;&nbsp;&nbsp;
        <a onclick="return areYouSure()"  href="{$url_edit}" style="text-decoration:none;color: black" > {$edit_button}</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a onclick="return areYouSure()" href="{$url_delete}" style="text-decoration:none;color: black" > {$delete_button}</a></p>
    </article>
</div>
A;
            echo $html;
        } ?>
    </div>
    <div class="right_main"><!--
        <article>
            <button   type="submit" name="submit" value="发送" style="width: 100% ;color: white;background-color: black;
          border-radius: 0; border-color: black;height: 45px;font-size:larger; "><a href="seemblog_push.php" style="color:white;
            text-decoration:none">发表文章</a> </button>
        </article>-->
        <?PHP


        $html_right = <<<A
        <article >
            <p><strong>{$result_member_data['name']}</strong> &nbsp;&nbsp;uid:{$result_member_data['uid']} &nbsp;&nbsp;<a>关注</a></p>
            <p style="color: #666666">{$result_member_data['introduce']}</p>
             <p>文章总数:{$artical_num}</p>
        </article>
A;
        echo $html_right;
?>
        <article ><p id="aside_href_normal">
<?php
        if (isset($superid)&&$superid==1&&$_GET['people']==$member_uid){
            $html_right = <<<A
       
            <a  href="super_id.php">网站管理</a> 
       
A;
          echo $html_right; //管理员入口
        }

            echo' <a onclick="return areYouSure()" href="'.$url_user_setting.'"  > '.$user_setting_button.'</a>';
        //用户设置入口
        }//判断是否执行页面的花括号

        ?></p>
        </article>
    </div>
</div>

<script>
    function areYouSure() {
        if (confirm("是否继续？")) {
        } else {
            return false;
        }
    }
</script>



<?php include 'footer.php'?>
