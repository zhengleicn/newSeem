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
if (!(isset($member_state )&&$member_state)){
    echo "<script>window.alert('你还没有登录');window.location.href='login.php';</script>";
}
    ?>
    <!-- <form action="timeline_sub.php"    method="post">


         <textarea name="content" rows="5" cols="100"></textarea>
         <br/>
         <label><input  type="submit" name="submit" value="发送" /></label>


     </form> -->
    <div>


<div class="main_container">
    <form    action="seemblog_sub.php"    method="post">
<div class="left_main">


        标题：<textarea name="title" rows="1"  style="height: 30px;width: 95%; font-family: Verdana, sans-serif;text-align: center;
font-size: 20px;font-weight: 500;resize:none;"></textarea><br/>






正文：
        <textarea  name="content"     style="width: 90%; height: 1000px;font-family: Verdana, sans-serif;width:95%; font-size: 16px;"></textarea>



        <br/>


    </div>
<div class="right_main">
<article style="border: white;">
          <button  type="submit" name="submit" value="发送" style="width: 100% ;color: white;background-color: black;
          border-radius: 0; border-color: black;height: 45px;font-size:larger; ">发表</button>

    </article>
    <article style="border: white;">
        <select name="type">
            <?php
                 $query="select * from artical_type where id!=0";
                 $result_type=mysqli_query($link,$query);
            while ($typerow=mysqli_fetch_assoc($result_type)){
                $typerow['name']=htmlspecialchars($typerow['name']);
                echo "<option value='{$typerow['id']}'>{$typerow['name']}</option>";
            }
            ?>
        </select>
    </article>
</div>



    </form>
</div>


    </div>




<?php include 'footer.php'?>