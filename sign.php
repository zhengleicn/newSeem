


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
<div class="main_container" >
    <div class="left_main">
        <h3 >&nbsp;欢迎加入森木博客</h3>

        <p>森木博客是一个纯文字社区，在这里，你可以：</p>
        <p>发布动态，记录自己的心情，</p>
        <p>发布文章，分享自己的想法，</p>
        <p>以及，探索文字的一切可能。</p>



    </div>

    <div class="right_main">

        <article>
            <form action="sign_check.php"    method="post">


                <label><input  type="text" name="name" placeholder="昵称（仅显示，登录时请通过uid登录）" style="border: 1px solid rgb(0, 0, 0); width: 97%;height: 30px;" /></label>
                <br/><br/>
                <label><input  type="password" name="pw" placeholder="密码" style="border: 1px solid rgb(0, 0, 0); width: 97%;height: 30px;" /></label>
                <br/><br/>
                <button  type="submit" wrap="physical" name="submit" value="注册" style="width: 100% ;color: white;background-color: black;
                             border-radius: 0; border-color: black;height: 45px;font-size:larger; ">加入森木</button>


            </form>
        </article>
        <article>
            <h2>特别提醒</h2>
            <p>登录时使用的是uid，uid为系统自动分配，注册后请点击右上角自己的昵称进入个人中心查看uid以便下次登录</p>
            <p><a href="mailto:664425895@qq.com"></a></p>
        </article>
        <!--<h2>
              &nbsp;开发者列表
        </h2>

            <article>
                <p><strong>Lei</strong> </p>
                <p>email：<a href="mailto:zhengleicn@outlook.com">zhengleicn@outlook.com</a></p>

            </article>-->

    </div>
</div>
<?php include 'footer.php'?>
