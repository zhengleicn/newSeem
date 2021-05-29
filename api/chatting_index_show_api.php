<?php
include_once"../config.php";
include_once "../mysql_link.php";
header('Content-type: application/json');
$link = connect();
$query="select uid,name,content,time from chatting_index order by id desc limit 200";
$result=mysqli_query($link,$query);
$rows=array();
while ($row=mysqli_fetch_assoc($result)){
    array_push($rows,$row);
}
$rows=array_reverse($rows);
echo json_encode(['chatting' => $rows]);
