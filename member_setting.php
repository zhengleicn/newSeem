<?php
//有一个get参数，已处理
include_once"config.php";
include_once "mysql_link.php";
include_once "login_check.php";
include_once "tools_of_seem.php";
$link=connect();
$member_state=is_login($link);
if(!isset($_GET['id'])||!is_numeric($_GET['id'])){echo "<script>window.location.href='seemblog.php?id=1'</script>";}
$query="select * from tinkusers where uid='{$_GET["id"]}'";
$result=mysqli_query($link,$query);
$row=mysqli_fetch_assoc($result);
//$row['content']=str_replace("<br/>",'',$row['content']);
//$row['content']=str_replace("&nbsp;",' ',$row['content']);
//row是原先文章的属性




?>

<!DOCTYPE html>
<?php include 'header.php';
if (!(isset($member_state )&&$member_state)){
    echo "<script>window.alert('非法操作');window.location.href='login.php';</script>";

    //此处应写惩罚措施
}
else if($row['uid']!=$_COOKIE['tuid']){//是否为本人
    echo "<script>window.alert('非法操作！');window.location.href='index.php';</script>";

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
        <form    action="jump/member_setting_sub.php?id=<?php echo $_GET['id'];?>"    method="post" style="text-align: center">


                <br/><br/>新昵称<br/>
                <input type="text" name="name"  value="<?php echo $row['name'];?>"  style="height: 30px;width: 50%; font-family: Verdana, sans-serif;
font-size: 20px;font-weight: 500;resize:none;"><br/><br/>
                旧密码<br/>
                <input type="password" name="oldpassword" placeholder="必填项" style="height: 30px;width: 50%; font-family: Verdana, sans-serif;
font-size: 20px;font-weight: 500;resize:none;"><br/><br/>
                新密码<br/>
                <input type="password" name="newpassword" placeholder="如不修改密码无需填此项" style="height: 30px;width: 50%; font-family: Verdana, sans-serif;
font-size: 20px;font-weight: 500;resize:none;"><br/><br/>
                再次确认<br/>
                <input type="password" name="comfirm_newpassword" placeholder="如不修改密码无需填此项"  style="height: 30px;width: 50%; font-family: Verdana, sans-serif;
font-size: 20px;font-weight: 500;resize:none;"><br/><br/>
                 个人介绍<br/>
            <input type="text" name="introduce" value="<?php echo $row['introduce'];?>"  style="height: 30px;width: 50%; font-family: Verdana, sans-serif;
font-size: 20px;font-weight: 500;resize:none;"><br/><br/>
                <button  type="submit" name="submit" value="发送" style="width: 51% ;color: white;background-color: black;
          border-radius: 0; border-color: black;height: 45px;font-size:larger; ">修改</button>



                <br/>





        </form>


</div>




<?php include 'footer.php';}  ?>

