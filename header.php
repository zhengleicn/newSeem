
<html lang="zh-cn">

<head>
    <title>森木社区</title>
    <link rel="shortcut icon" href="icon/seemicon_b.svg" type="image/x-icon" >
    <link rel="stylesheet" type="text/css" href="./seemcss.css">
    <meta charset="utf-8">

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js">
    </script>
    <![endif]-->

    <style>

    </style>

</head>

<body >
<div class="container">
<header>
    <h1><img src="icon/seemicon_b.svg" height="40" style="position:relative; top:7px;">
        森木社区</h1>

</header>

<nav>
    <ul>
        <li><a href="index.php" id="topnav" class="navOld" >首页</a></li>
        <!--<li><a href="timeline.php" id="topnav" class="navOld" style="color: rgb(255,100,0)">想法</a></li>-->
        <li><a href="seemblog_list.php" id="topnav" class="navOld" >文章<b>[new]</b></a></li>
        <!--<li><a href="timeline.php" id="topnav" class="navOld" style="color: rgb(255,100,0)">观点</a></li>-->
        <!--<li><a href="timeline.php" id="topnav" class="navOld" style="color: rgb(255,100,0)">聊天室</a></li>-->
        <li><a href="timeline.php" id="topnav" class="navOld" >留言板</a></li>
        <li><a target=_blank href="tink\home.html" class="navOld"></a></li>
        <?php
        if (isset($member_state )&&$member_state)
        {
            $_COOKIE['tid']=htmlspecialchars($_COOKIE['tid']);
            $str=<<<A
                         <li><a href="logout.php"   style="float: right;" class="navOld">登出&nbsp;&nbsp;&nbsp;</a></li>
                         <li><a href="member.php?people={$_COOKIE['tuid']}" style="float: right;" class="navOld">{$_COOKIE['tid']}&nbsp;&nbsp;&nbsp;</a></li>                       
A;
        }
        else{
            $str=<<<A
                         <li><a href="sign.php" style="float: right;" class="navOld">注册&nbsp;&nbsp;&nbsp;</a></li>
                         <li><a href="login.php" style="float: right;" class="navOld">登录&nbsp;&nbsp;&nbsp;</a></li>
A;
        }
        echo $str;
        ?>

        <form style="float: right;position: relative;right: 5%" action="search_title.php" method="get"><div  type="submit"style="float: right;position: relative;right: 5%"></div><input placeholder="文章搜索" type="search"  name="search"   style="float: right;position: relative;right: 5%" class="navOld">&nbsp;&nbsp;</form>


    </ul>
</nav>
