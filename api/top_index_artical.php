<?php
include_once"../config.php";
include_once "../mysql_link.php";
header('Content-type: application/json');
$link = connect();
$query="select id,title,watch from artical order by watch desc limit 0,5";
$result=mysqli_query($link,$query);
$rows=array();
while ($row=mysqli_fetch_assoc($result)){
    array_push($rows,$row);
}
echo json_encode(['topFive' => $rows]);

