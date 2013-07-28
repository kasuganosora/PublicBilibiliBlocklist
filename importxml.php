<?php
require_once("init.php");
if(!isset($_FILES["file"]) || $_FILES["file"]["error"] > 0 || $_FILES["file"]["type"] != 'text/xml'){
	header("Location: index.php");
	exit();
}

$xml = simplexml_load_file($_FILES["file"]["tmp_name"]);


foreach($xml->item as $item){
	$str = (String)$item;
	$kv = split("=",$str);
	$type;
	$data = $kv[1];
	
	switch($kv[0]){
		case 'u':
			$type = 'user';
		break;
		case 't':
			$type = 'keyword';
		break;
		case 'c':
			$type = 'color';
		break;
		default:
		$type = 'keyword';
	}
	
	$uid = 1;
	$mode = "blocklist";
	$sql = "REPLACE INTO `filter` (val,type,mode,uid) VALUES('$data','$type','$mode','$uid');";
	$db->query($sql);
}
header("Location: index.php");
exit();
