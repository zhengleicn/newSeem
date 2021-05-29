<?php
include_once "config.php";
include_once "mysql_link.php";
include_once "login_check.php";
include_once "tools_of_seem.php";
$link = connect();
$member_state = is_login($link);
$super_id=is_super_id($link);
?>

<!DOCTYPE html>
<?php include 'header.php' ?>
<div class="main_container">

    <div class="left_main">
        <div style="width: 90%;">
            <h4 style="float: left">&nbsp;&nbsp;&nbsp;管理员界面 </h4>
            <div id="page_button">
                <?php
                if (isset($super_id )&&$super_id==1&&isset($member_state )&&$member_state){

                if (!isset($_GET['type']) || $_GET['type'] == 0) {
                    $query = "select id from artical  order by id desc ";
                    $_GET['type'] = 0;
                } else {
                    $query = "select id from artical where type='{$_GET['type']}' order by id desc ";
                }
                //文章分类

                $result_blog = mysqli_query($link, $query);
                $artical_num = mysqli_num_rows($result_blog);
                $total_page = ceil($artical_num / 7);


                //查询文章分类
                $query = "select * from artical_type ";
                $result_type = mysqli_query($link, $query);
                $total_type = mysqli_num_rows($result_type);


                //
                if (!isset($_GET['page']) || $_GET['page'] < 1) {
                    $_GET['page'] = 1;
                } else if ($_GET['page'] > $total_page || $_GET['type'] > $total_type) {
                    echo '<script>window.alert("该页面不存在");window.history.back();</script>';
                }


                $previous_page = $_GET['page'] - 1;
                $next_page = $_GET['page'] + 1;


                $html = <<<A
        <a href="seemblog_list.php?type={$_GET['type']}&page=1">首页 </a>
        <a href="seemblog_list.php?type={$_GET['type']}&page={$previous_page}">上一页 </a>
        <form style="display: inline;" method="post" action="./jump/page_jump.php?type={$_GET['type']}">
            <input type="test" name="jump_page" value="{$_GET['page']}" style="width: 5%;"/>
            <a >/{$total_page}</a>
            <button type="submit"  name="submit" id="jump_button">跳转</button>
        </form>
        <a href="seemblog_list.php?type={$_GET['type']}&page={$next_page}">下一页 </a>
        <a href="seemblog_list.php?type={$_GET['type']}&page={$total_page}">尾页 </a>
A;
                echo $html;
                //分页
                ?>
            </div>
        </div>
        <?php
        $url_delete = '';

        $limit_start = $_GET['page'] * 7 - 7;
        if (!isset($_GET['type']) || $_GET['type'] == 0) {
            $query = "select * from artical order by id desc limit {$limit_start},7";
        } else {
            $query = "select * from artical where type='{$_GET['type']}' order by id desc limit {$limit_start},7";
        }
        //文章分类

        $result_blog = mysqli_query($link, $query);
        if (mysqli_num_rows($result_blog) == 0) {
            echo "<article style='padding-bottom:0px;'>没有内容</artical>";
        }
        while ($datarow = mysqli_fetch_assoc($result_blog)) {
            $datarow['title']=htmlspecialchars($datarow['title']);
            $datarow['name']=htmlspecialchars($datarow['name']);
            $time_Y_M_D=substr($datarow['time'],0,10);
                    $url_delete = "delete_blog.php?blog={$datarow['id']}&home=0";
                    $delete_button = '删除';




            $html = <<<A
<div id="artical1">
    <article style="padding-bottom: 0px;">
        <h3 style="margin: 0;"><a href="seemblog.php?id={$datarow['id']}" style="text-decoration:none;color: black">{$datarow['title']}</a></h3>
        <p style="font-size: small;"><embed src="./icon/writer.svg" width="15" height="15" style="position:relative; top:2px;"
"
type="image/svg+xml"
pluginspage="http://www.adobe.com/svg/viewer/install/" />
        
        <a href="member.php?people={$datarow['uid']}" style="text-decoration:none;color:darkgreen;font-weight: 600;"> {$datarow['name']}</a>&nbsp;&nbsp;&nbsp;&nbsp;
        
        
        <embed src="./icon/time.svg" width="15" height="15" style="position:relative; top:2px;"
"
type="image/svg+xml"
pluginspage="http://www.adobe.com/svg/viewer/install/" />
        
        
        
        <a href="#" style="text-decoration:none;color: black"> {$time_Y_M_D}</a>&nbsp;&nbsp;&nbsp;&nbsp;
        
        
        <embed src="./icon/watch.svg" width="15" height="15" style="position:relative; top:2px;"
"
type="image/svg+xml"
pluginspage="http://www.adobe.com/svg/viewer/install/" />



{$datarow['watch']}&nbsp;&nbsp;&nbsp;&nbsp;
        <a onclick="return areYouSure()"  href="{$url_delete}" style="text-decoration:none;color: black" > {$delete_button}</a></p>
        <p style="padding: 0;"></p>
    </article>
</div>
A;
            echo $html;
        } ?>

    </div>




    <div class="right_main">
        <article>
            <button type="submit" name="submit" value="发送" style="width: 100% ;color: white;background-color: black;
          border-radius: 0; border-color: black;height: 45px;font-size:larger; "><a href="seemblog_push.php" style="color:white;
            text-decoration:none">发表文章</a></button>
        </article>

        <article style="margin-bottom: 0px;">
            <div>
                <div id="aside_href_normal">
                    <a  >话题列表</a>
                </div>
            </div>
        </article>
        <?php
        while ($typerow = mysqli_fetch_assoc($result_type)) {

            if($_GET['type']==$typerow['id']){
                $aside_what_id='id="aside_href_unnormal"';
            }
            else{
                $aside_what_id='id="aside_href_normal"';
            }
            $html = <<<A
<article style="margin-top: 0px;margin-bottom: 0px; border-top: 0px;" {$aside_what_id}>
                <div >
                    <a href="seemblog_list.php?type={$typerow['id']}">{$typerow['name']}</a>
                </div>
 </article>
A;
            echo $html;
        }
        //文章分类

        }//管理员判定
        else{
            echo "<script>window.location.href='superid.php'</script>";
        }
        ?>


        <p>
            文章删除功能已上线，有疑问请联系管理员，管理员邮箱：zhengleicn@outlook.com
        </p>
    </div>
</div>

<script>
    function areYouSure() {
        if (confirm("是否删除？目前本站未设置回收站，数据不可逆！")) {
        } else {
            return false;
        }
    }
</script>


<?php include 'footer.php' ?>
