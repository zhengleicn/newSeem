<?php
//有一个get参数，已处理
include_once"config.php";
include_once "mysql_link.php";
include_once "login_check.php";
include_once "tools_of_seem.php";
$link=connect();
$member_state=is_login($link);
if(!isset($_GET['id'])||!is_numeric($_GET['id'])){echo "<script>window.location.href='seemblog.php?id=1'</script>";}
$query="select * from artical where id='{$_GET["id"]}'";
$result=mysqli_query($link,$query);
$row=mysqli_fetch_assoc($result);
$row['content']=str_replace("<br/>",'',$row['content']);
//$row['content']=str_replace("&nbsp;",' ',$row['content']);
//row是原先文章的属性




?>

<!DOCTYPE html>
<?php include 'header.php';
if (!(isset($member_state )&&$member_state)){
    echo "<script>window.alert('你还没有登录');window.location.href='login.php';</script>";
}
else if($row['uid']!=$_COOKIE['tuid']){//是否为作者
    echo "<script>window.alert('非法操作');window.location.href='index.php';</script>";

    //此处应写惩罚措施


}
else{


?>
<!-- <form action="timeline_sub.php"    method="post">


     <textarea name="content" rows="5" cols="100"></textarea>
     <br/>
     <label><input  type="submit" name="submit" value="发送" /></label>


 </form> -->
<div>


    <div class="main_container">
        <form    action="jump/seem_edit_sub.php?id=<?php echo $_GET['id'];?>"    method="post">
            <div class="left_main">


               <textarea name="title" rows="1"  style="height: 30px;width: 95%; font-family: Verdana, sans-serif;text-align: center;
font-size: 20px;font-weight: 500;resize:none;"><?php echo $row['title'];?></textarea><br/>

                <textarea  name="content"       style="width: 90%; height: 1000px;font-family: Verdana, sans-serif;width:95%; font-size: 16px;"><?php echo $row['content'];?></textarea>



                <br/>


            </div>
            <div class="right_main">
                <article style="border: white;">
                    <button  type="submit" name="submit" value="发送" style="width: 100% ;color: white;background-color: black;
          border-radius: 0; border-color: black;height: 45px;font-size:larger; ">修改</button>

                </article>
                <article style="border: white;">
                    <select name="type" >
                    <?php

                    $query="select * from artical_type where id!=0";
                    $result_type=mysqli_query($link,$query);
                    while ($typerow=mysqli_fetch_assoc($result_type)){
                        $bool_type='';//判断文章类型

                        if ($typerow['id']==$row['type']){$bool_type='selected';}
                    $html=<<<A
                        
                       
                        
                            <option value='{$typerow["id"]}' {$bool_type}>{$typerow['name']}</option>
                       
                      
                    
A;
                    echo $html;
                    }
                    }//通过验证，可以加载的花括号
                    ?>
                    </select>
                </article>
            </div>



        </form>
    </div>


</div>




<?php include 'footer.php'?>
