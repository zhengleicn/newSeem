<?php
include_once"config.php";
include_once "mysql_link.php";
include_once "login_check.php";
include_once "tools_of_seem.php";
$link=connect();
$member_state=is_login($link);
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    echo '<script>window.alert("文章不存在");window.location.href="seemblog.php?id=1";</script>';
}
else
{
$query = "select * from artical where id={$_GET['id']}";
$result_artical = execute($link, $query);
if (mysqli_num_rows($result_artical) != 1) {
    echo '<script>window.alert("文章不存在")</script>';
}
$data_artical = mysqli_fetch_assoc($result_artical);

?>

    <!DOCTYPE html>
    <?php include 'header.php' ?>
    <!-- <form action="timeline_sub.php"    method="post">


         <textarea name="content" rows="5" cols="100"></textarea>
         <br/>
         <label><input  type="submit" name="submit" value="发送" /></label>


     </form> -->
<div>

    <?php

    //阅读量
    if (!isset($_GET['g5c5gv'])) {
        $query = "update artical set watch=watch+1 where id={$_GET['id']}";
        execute($link, $query);
    }

    $query = "select * from artical where id={$_GET['id']} ";
    $result_seemblog = mysqli_query($link, $query);
    $datarow = mysqli_fetch_assoc($result_seemblog);


    //防止xxs攻击
    //$datarow['title']=htmlspecialchars($datarow['title']); 这段重复了
    $datarow['name']=htmlspecialchars($datarow['name']);


    $html = <<<A
<div class="main_container">
<div class="left_main">
     <h3 style="text-align: center;">{$datarow['title']}</h3>
     <p style="font-size: small">&nbsp; 作者:<a href="member.php?people={$datarow['uid']}" style="text-decoration:none;color: black"> {$datarow['name']}</a>&nbsp;&nbsp;&nbsp;&nbsp;发表时间:
        <a href="#" style="text-decoration:none;color: black"> {$datarow['time']}</a>&nbsp;&nbsp;&nbsp;&nbsp;
      阅读量:{$datarow['watch']}&nbsp;&nbsp;&nbsp;&nbsp;最后一次修改:{$datarow['edit_time']}</p>
    <article style="white-space:normal; word-break:break-all;">
        
        <p >{$datarow['content']}</p>

    </article>
    </div>

A;
    echo $html;
    ?>
    <div class="right_main">
        <article style="white-space:normal; word-break:break-all;overflow:hidden;margin: 0;">
            <p style="text-align: center">评论区</p>
            <?php
            //评论区
            $query = "select * from comment where blog_id={$_GET['id']} order by id desc ";
            $result = mysqli_query($link, $query);
            if (mysqli_num_rows($result) == 0) {
                echo "<p>没有评论</p>";
            }
            while ($comment_row = mysqli_fetch_assoc($result)) {
                $html = <<<A
            <p><a href="member.php?people={$comment_row['uid']}">{$comment_row['name']}:</a>{$comment_row['content']}</p>
            <p style="color: #666666;font-size: small;">{$comment_row['time']}</p>
A;
                echo $html;

            }
            }//这个括号是第一个else，判断是否继续执行界面
?>
            <form method="post" action="./jump/comment_sub.php?<?php echo "id={$_GET['id']}";?>  ">
            <textarea name="comment" rows="2" style="resize:none;width: 70%"></textarea>
                <button name="submit" type="submit" style=" width: 25%;position:relative; top:-12px;height: 35px;background-color: white;border-color: black">发送</button>
            </form>
        </article>
    </div>
</div>
    </div>




<?php include 'footer.php'?>


