<?php
function is_login($link){
    if(isset($_COOKIE["tuid"]) && isset($_COOKIE["tpw"])){
        $query="select * from tinkusers where uid='{$_COOKIE['tuid']}' and sha1(password)='{$_COOKIE['tpw']}'";
        $result=mysqli_query($link,$query);
        if(mysqli_num_rows($result)==1){
            $data=mysqli_fetch_assoc($result);
            return $data['name'];
        }else{
            return false;
        }
    }else{
        return false;
    }
}//返回用户名
function is_super_id($link){
    if(isset($_COOKIE["tuid"]) && isset($_COOKIE["tpw"])){
        $query="select * from tinkusers where uid='{$_COOKIE['tuid']}' and sha1(password)='{$_COOKIE['tpw']}'";
        $result=mysqli_query($link,$query);
        if(mysqli_num_rows($result)==1){
            $data=mysqli_fetch_assoc($result);
            return $data['user_mode'];
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function is_login_uid($link){
    if(isset($_COOKIE["tuid"]) && isset($_COOKIE["tpw"])){
        $query="select * from tinkusers where uid='{$_COOKIE['tuid']}' and sha1(password)='{$_COOKIE['tpw']}'";
        $result=mysqli_query($link,$query);
        if(mysqli_num_rows($result)==1){
            $data=mysqli_fetch_assoc($result);
            return $data['uid'];
        }else{
            return false;
        }
    }else{
        return false;
    }
}//返回用户id
?>

