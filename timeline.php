<?php
include_once"config.php";
include_once "mysql_link.php";
include_once "login_check.php";
include_once "tools_of_seem.php";
$link=connect();
$member_state=is_login($link);
?>

<!DOCTYPE html>
<?php include 'header.php'?>
<div class="main_container">
    <div class="left_main">


            <h3>&nbsp;&nbsp;&nbsp;动态</h3>
            <?php
            $query="select * from tin order by id desc ";
            $result_timeline=mysqli_query($link,$query);
            while($datarow=mysqli_fetch_assoc($result_timeline)){

                $html=<<<A
    <article>
        <h3>{$datarow['name']}</h3>
        <p>uid：{$datarow['uid']}</p>
        <p style="font-family: 黑体">{$datarow['content']}</p>

    </article>
A;
                echo $html;
            }?>
    </div>

        <div>
    </div>
    <div class="right_main">
        <article>
        <form action="timeline_sub.php"    method="post">


            <textarea name="content" style="font-family: Verdana, sans-serif;resize:none;width: 97%" rows="5" ></textarea>
            <br/>
            <button  type="submit" wrap="physical" name="submit" value="发送" style="width: 100% ;color: white;background-color: black;
                             border-radius: 0; border-color: black;height: 45px;font-size:larger; ">发送</button>


        </form>
        </article>
        <article style="border-color: white;color: #666666">
            <p>使用留言榜功能需要登录</p>
        </article>
    </div>
</div>

<?php include 'footer.php'?>
