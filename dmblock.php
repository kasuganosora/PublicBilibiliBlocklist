<?php
	//bilibili player dmblock interface

	require_once("init.php");
	//GET METHOD
	$queryString = $_SERVER['QUERY_STRING'];
	$type = $_GET['type'];
	$data = $_GET['data'];
	$aid = $_GET['aid'];
	
	if(!isset($type)){
		exit();
	}
	
	$uid = isset($_COOKIE['DedeUserID']) ? $_COOKIE['DedeUserID'] : 0;
	$mode = "blocklist";
	$sql = "REPLACE INTO `filter` (val,type,mode,uid) VALUES('$data','$type','$mode','$uid');";
	$db->query($sql);
	
	echo gotoPage("http://interface.bilibili.tv/dmblock?".$queryString);
?>