<?php
include_once"../config.php";
include_once "../mysql_link.php";
header('Content-type: application/json');
$link = connect();
$query="SELECT name, COUNT(*) as sum  FROM   search_list GROUP BY name order by sum desc limit 0,10";
$result=mysqli_query($link,$query);
$rows=array();
while ($row=mysqli_fetch_assoc($result)){
    array_push($rows,$row);
}
echo json_encode(['topSearch' => $rows]);
