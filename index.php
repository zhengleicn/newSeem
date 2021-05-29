<?php
include_once"config.php";
include_once "mysql_link.php";
include_once "login_check.php";
include_once "tools_of_seem.php";
$link=connect();
$member_state=is_login($link);

?>

<!DOCTYPE html>
<?php include 'header.php';
//if (!(isset($member_state )&&$member_state)){
    //echo "<script language='javascript' type='text/javascript'>";
    //echo "window.location.href='login.php'";
    //echo "</script>";
//}

?>
<div class="main_container">
<div class="left_main">
<?php
if (isset($member_state )&&$member_state) {
    $html = <<< A
        <article style="clear: both;height: 350px;">
        <div class="left_main" style="height: 100%;">
        <h3 style="clear: both">&nbsp;&nbsp;&nbsp;聊天（测试版）</h3>
        <div id="chat_container" style="height: 70%; width: 100%; overflow-y: scroll;overflow-x:hidden;"><p id="chatting_index">加载中</p>
        </div>
        <form action="" onkeydown="if(event.keyCode==13){document.getElementById('chattingIndexSubButton').click();
event.returnValue = false;}">
            <input  type="text" id="chatText" name="chatTest" placeholder="输入消息" autocomplete="off" style="width: 80%;position: absolute;bottom: 5px;"/>
            <button type="button" id="chattingIndexSubButton" onclick="chattingIndexSub()"style="width:10%;position: absolute;bottom: 5px;right: 10%; background-color: white;">发送</button>
        </form>
        </div>
        </article>
A;
    echo $html;
}
?>
        <h3 >&nbsp;&nbsp;&nbsp;更新公告</h3>

<div id="offical_news">
    <article style="float: left;display: inline;width: auto;">
        <h3 >1.0.0-1.0.12版本更新汇总</h3>
        <ul><li><a href="http://seem.ink/seemblog.php?id=186" style="
            text-decoration:none;">文章链接</a></li> </ul>
    </article>
    <article style="float: left;display: inline;width: auto;">
        <h2 >1.0.5</h2>
        <ul><li><a href="http://seem.ink/seemblog.php?id=126" style="
            text-decoration:none;">文章链接</a></li> </ul>
    </article>
    <article style="float: left;display: inline;width: auto;">
        <h2 >1.0.4</h2>
        <ul><li><a href="http://seem.ink/seemblog.php?id=125" style="
            text-decoration:none;">文章链接</a></li> </ul>
    </article>
    <article style="float: left;display: inline;width: auto;">
        <h2 >1.0.3</h2>
        <ul><li><a href="http://seem.ink/seemblog.php?id=124" style="
            text-decoration:none;">文章链接</a></li> </ul>
    </article>
    <article style="float: left;display: inline;width: auto;">
        <h2 >1.0.1&1.0.2</h2>
        <ul><li><a href="http://seem.ink/seemblog.php?id=123" style="
            text-decoration:none;">文章链接</a></li> </ul>
    </article>
    <article style="float: left;display: inline-block;width: auto;">
        <h2 >1.0漏洞说明</h2>
        <ul><li><a href="http://seem.ink/seemblog.php?id=122" style="
            text-decoration:none;">文章链接</a></li> </ul>
    </article>
</div>
    <h3 style="clear: both">&nbsp;&nbsp;&nbsp;友情链接</h3>
        <article style="clear: both; background-color:rgb(0,160,255);color: white  ">
            <h2 >TINK</h2>
            <p>内容创作者平台</p>
            <p>建设中，敬请期待<a href="http://Seem.ink/tink/home.html" style="color:white;
            text-decoration:none;">&nbsp;&nbsp;&nbsp;-> 测试链接</a></p>
        </article>



</div>

<div class="right_main">

        <article>
            <h2>关于本站</h2>
            <p>森木一个极简博客平台,推荐通过PC端访问本站以获得最佳体验，本站仍然处于测试阶段，重要文章数据请本地备份</p>
            <p><a href="mailto:664425895@qq.com"></a></p>
        </article>

        <div style="  white-space: nowrap;">
            <article style="position:relative; float: left; width: 35%;clear: none;">
        <h2 style="padding: 0;margin: 0;text-align: center;">公众号</h2>
        <img width="100%"  src="./icon/qrcode.jpg">
            </article>
            <article style="position: relative; float: left; width: 47%;clear: none;">
                <h2 style="padding: 0;margin: 0;text-align: center;">本站相关用户</h2>


                <p id="aside_href_normal_index" style="margin: 2px;"><a href="member.php?people=34">tink团队</a></p>
                <p id="aside_href_normal_index" style="margin: 2px;"><a href="member.php?people=47">郑磊</a></p>
                <p id="aside_href_normal_index" style="margin: 2px;"><a href="member.php?people=37">long</a></p>
            </article>
        </div>
    <article >
<h1>阅读最多的文章</h1>
        <p id="showTheTopArtical">加载中</p>
        <script src="js/topFiveArtical.js"></script>
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


<script>
    function chattingIndexSub()
    {

        var str=document.getElementById('chatText').value;

        var xmlhttp;
        if (str.length==0)
        {
            window.alert("请输入内容");
            return;
        }
        if (window.XMLHttpRequest)
        {
            // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            // IE6, IE5 浏览器执行代码
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.open("GET","jump/chatting_index_sub.php?uid=<?php echo $_COOKIE['tuid']; ?>&id=<?php echo $_COOKIE['tid']; ?>&t="+str,true);
        xmlhttp.send();
        document.getElementById('chatText').value="";
        var div = document.getElementById('chat_container');
        div.scrollTop = div.scrollHeight;
    }
</script>

<?php include 'footer.php'?>


