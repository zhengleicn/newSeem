<?php
include_once "config.php";
include_once "mysql_link.php";
include_once "login_check.php";
include_once "tools_of_seem.php";
$link = connect();
$member_state = is_login($link);//有search一个get参数，目前做了非数字转化为1处理
if (!isset($_GET['search'])){
    $_GET['search']='';
}
$_GET['search']=htmlspecialchars($_GET['search']);
?>

<!DOCTYPE html>
<?php include 'header.php' ?>
<div class="main_container">

    <div class="left_main">
        <div style="width: 90%;">
            <h5 style="float: left">&nbsp;&nbsp;&nbsp;以下为文章标题含“<?php echo $_GET['search']?>”的搜索结果 </h5>
            <div id="page_button">
                <?php
                    $query = "select id from artical where title like '%{$_GET['search']}%' order by id desc ";


                $result_blog = mysqli_query($link, $query);
                $artical_num = mysqli_num_rows($result_blog);
                $total_page = ceil($artical_num / 7);






                //
                if (!isset($_GET['page']) || $_GET['page'] < 1||!is_numeric($_GET['page'])) {
                    $_GET['page'] = 1;
                } else if ($_GET['page'] > $total_page ) {
                    echo '<script>window.alert("该页面不存在");window.history.back();</script>';
                }


                $previous_page = $_GET['page'] - 1;
                $next_page = $_GET['page'] + 1;
                if ($next_page>$total_page){
                    $next_page=$total_page;//下一页超出总页数
                }


                $html = <<<A
        <a href="search_title.php?search={$_GET['search']}&page=1">首页 </a>
        <a href="search_title.php?search={$_GET['search']}&page={$previous_page}">上一页 </a>
        <form style="display: inline;" method="post" action="./jump/page_jump_search_title.php?search={$_GET['search']}">
            <input type="test" name="jump_page" value="{$_GET['page']}" style="width: 5%;"/>
            <a >/{$total_page}</a>
            <button type="submit"  name="submit" id="jump_button">跳转</button>
        </form>
        <a href="search_title.php?search={$_GET['search']}&page={$next_page}">下一页 </a>
        <a href="search_title.php?search={$_GET['search']}&page={$total_page}">尾页 </a>
A;
                echo $html;
                //分页
                ?>
            </div>
        </div>
        <?php


        $limit_start = $_GET['page'] * 7 - 7;

            $query = "select * from artical where title like '%{$_GET['search']}%' order by id desc  limit {$limit_start},7";

        //文章分类

        $result_blog = mysqli_query($link, $query);
        if (mysqli_num_rows($result_blog) == 0) {
            echo "<article style='padding-bottom:0px;'>没有内容</artical>";
        }
        while ($datarow = mysqli_fetch_assoc($result_blog)) {
            //$datarow['title']=htmlspecialchars($datarow['title']);
            $datarow['name']=htmlspecialchars($datarow['name']);
            $time_Y_M_D=substr($datarow['edit_time'],0,10);



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
       
        </p>
        <p style="padding: 0;"></p>
    </article>
</div>
A;
            echo $html;
        } ?>

    </div>

<?php
//搜索记录记入数据库模块
if ($_GET['search']!='') {
    $query_search = "insert into search_list(name,create_time) values ('{$_GET['search']}',CURDATE())";
    $result_search=mysqli_query($link,$query_search);
    if (isset($_COOKIE['tuid'])) {
        $query_search = "DELETE FROM search_list WHERE datediff(CURDATE(),create_time)>=3";
        $result_search = mysqli_query($link, $query_search);
    }
}

?>


    <div class="right_main">
        <form style="width: 97%;position: relative;left: 1%;">
            <input type="search" name="search" value="" placeholder="搜索" style="width: 100% ;color: black;background-color: white;
          border-radius: 0; border-color: black;height: 45px;font-size:larger; "><div  type="submit"style="float: right;position: relative;right: 5%"></div>
            </form>

        <article onload="showTheTopSearch()">
            <h1>热搜榜</h1>
            <p id="showTheTop_Search">加载中</p>
            <script src="js/topFiveArtical.js"></script>
        </article>


        <p>
            管理员邮箱：zhengleicn@outlook.com
        </p>
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


<?php include 'footer.php' ?>
