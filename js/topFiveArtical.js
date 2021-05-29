 function chattingIndexShow()
{
    var xmlhttp;

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
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            var chattingobj,i,x='';

            //topobj={ "sites" : [
            //xmlhttp.responseText]
            //};
            chattingobj=eval('(' + xmlhttp.responseText + ')');
            chattingobj=eval('(' + xmlhttp.responseText + ')');
            for (i in chattingobj.chatting){
                x +="<a style='color: black;text-decoration: none;font-size: smaller '  href='member.php?people= "+chattingobj.chatting[i].uid+"'>"+chattingobj.chatting[i].name+ ":&nbsp;&nbsp;&nbsp;"+chattingobj.chatting[i].content+"&nbsp;&nbsp;&nbsp;"+chattingobj.chatting[i].time+"</a><br/>";
                document.getElementById("chatting_index").innerHTML=x;
            }


        }
    }
    xmlhttp.open("GET","api/chatting_index_show_api.php",true);
    xmlhttp.send();


};


    function showTheTop()
    {
        var xmlhttp;

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
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                var topobj,i,x='';

                //topobj={ "sites" : [
                //xmlhttp.responseText]
                //};
                topobj=eval('(' + xmlhttp.responseText + ')');
                for (i in topobj.topFive){
                    x +="<a style='color: black;text-decoration: none;font-size: smaller '  href='seemblog.php?id= "+topobj.topFive[i].id+"'>"+ topobj.topFive[i].title +"&nbsp;&nbsp;&nbsp;[浏览量]&nbsp;&nbsp;&nbsp;"+topobj.topFive[i].watch+"</a><br/>";
                    document.getElementById("showTheTopArtical").innerHTML=x;
                }


            }
        }
        xmlhttp.open("GET","api/top_index_artical.php",true);
        xmlhttp.send();


    };
function showTheTopSearch()
{
    var xmlhttp;

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
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            var topobj,i,x='';

            //topobj={ "sites" : [
            //xmlhttp.responseText]
            //};
            topobj=eval('(' + xmlhttp.responseText + ')');
            for (i in topobj.topSearch){
                x +="<a style='color: black;text-decoration: none;font-size: smaller '  href='search_title.php?search="+topobj.topSearch[i].name+"'>"+ topobj.topSearch[i].name +"&nbsp;&nbsp;&nbsp;[搜索量]&nbsp;&nbsp;&nbsp;"+topobj.topSearch[i].sum+"</a><br/>";
                document.getElementById("showTheTop_Search").innerHTML=x;
            }


        }
    }
    xmlhttp.open("GET","api/top_ten_search.php",true);

    xmlhttp.send();


};

    window.onload=function (){ showTheTop();showTheTopSearch();
};
 var t = setInterval(function(){chattingIndexShow();},1500);