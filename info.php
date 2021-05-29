<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My WebSocket</title>
</head>
<body>
<h2 οnclick="openTanTan()" style="color:dodgerblue;text-align: center">WeTanTan</h2>
<div id="tantanbox" style="width:800px;height:498px;margin:0 auto;">
    <div id="box-left" style="float:left;width:600px;height:500px;">
        <div id="content" style="height:350px;border:1px solid dodgerblue;"></div>
        <div id="input-content" style="height:145px;border:1px solid dodgerblue;"><textarea id="input-message" style="width:99%;height:96%"></textarea></div>
        <button id="btn1" οnclick="sendMessage()" style="width:38px;height:18px;line-height:18px;border:0;margin:4px 0 0 10px;">send</button>
        <button id="btn2" οnclick="ClosedWebSocket()" style="width:38px;height:18px;line-height:18px;border:0;margin:4px 0 0 10px;">close</button>
    </div>
    <div id="box-right" style="float:left;width:195px;height:497px;border:1px solid dodgerblue">
        <span style="font-size:10px;color:dodgerblue;font-weight:bold;">在线人数:</span>
        <hr/>
        <div id="count-users" style="font-size:10px;color:dodgerblue;font-weight:bold"></div>
    </div>

</div>
</body>
<script>
    var usernames=[];
    var username="";
    window.onload = function(){
        document.getElementById("tantanbox").style.display='none';
    };
    function openTanTan(){
        alert("open your WeTanTan chat!");
        username = window.prompt("输入你的名字:");
        //document.write("welcome to wetantan!<p id='username'>"+username+"</p>");
        usernames.push(username);
        document.getElementById("tantanbox").style.display='block';

        /*--------------------开始websocket部分----------- ---------*/

        var ws = null;//申请一个websocket对象
        //判断当前浏览器是不是支持websocket
        if('window' in window){
            startWebSocket();
        }else{
            alert("NO SUPPORT!");
            return;
        }
    };

    function  startWebSocket() {
        ws = new WebSocket("ws://119.3.166.97:8080/websocket");
        document.getElementById("count-users").innerHTML="";
        ws.onclose = function () {
            sendInnerHtml("<span style='font-size: 20px;color:greenyellow;font-weight: bold'>"+"Bye~~"+"</span>");
        };
        ws.onerror = function () {
            sendInnerHtml("websocket error");
        };
        ws.onopen = function (event) {
            sendInnerHtml("Welcome to WeTanTan Light social web!  "+"<span style='font-size: 30px;font-weight: bold;color:orange'>"+username+"</span>");
        };
        ws.onmessage = function (e) {
            console.log(e)
            document.getElementById("count-users").innerHTML=e.data+"人";
            sendInnerHtml('<br/>'+"服务器"+":"+e.data);
        };
        //监听方法，监听websocket关闭
        window.onbeforeunload = function(){
            ws.close();
        };
    }
    function sendInnerHtml(innerHtml){
        document.getElementById("content").innerHTML+=innerHtml+'<br/>';
    };
    function ClosedWebSocket(){
        ws.close();
        setTimeout(function(){
            document.getElementById("tantanbox").style.display='none';
        },1000);
    };
    function sendMessage() {
        var message = document.getElementById("input-message").value;
        ws.send(message);
        document.getElementById("content").innerHTML='<br/>'+username+":"+message;
        document.getElementById("input-message").value="";
    };
</script>
</html>

