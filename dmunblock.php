<?php
//bilibili player dmunblock interface
require_once("init.php");
$queryString = $_SERVER['QUERY_STRING'];
$type = $_GET['type'];
$data = $_GET['data'];
$aid = $_GET['aid'];
$ver = $_GET['ver'];
if(!isset($type)){
	exit();
}
$sql = "DELETE FROM `filter` WHERE val = '$data' AND type = '$type'";
$db->query($sql);

echo gotoPage("http://interface.bilibili.tv/dmunblock?".$queryString);
?>