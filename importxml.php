<?php
require_once("init.php");
if(!isset($_FILES["file"]) || $_FILES["file"]["error"] > 0 || $_FILES["file"]["type"] != 'text/xml'){
	header("Location: index.php");
	exit();
}

$xml = simplexml_load_file($_FILES["file"]["tmp_name"]);

if(isset($xml->f)){
	bilibiliXMLFFormat($xml);
}else{
	bilibiliXMLFiltersFormat($xml);
}


function bilibiliXMLFFormat($xml){
	foreach($xml->f as $item){
		$type = (String)($item["t"]);
		$data = (String)$item;
		importDB($data,$type);
	}
}


function bilibiliXMLFiltersFormat($xml){
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
		importDB($data,$type);
	}
}

function importDB($data,$type){
	global $db;
	$uid = 1;
	$mode = "blocklist";
	$data = mysql_real_escape_string($data);
	$sql = "REPLACE INTO `filter` (val,type,mode,uid) VALUES('$data','$type','$mode','$uid');";
	$db->query($sql);
}


header("Location: index.php");
exit();
