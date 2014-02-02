<?php
// acfun block user id list
require_once("init.php");

$sql = 'SELECT val FROM `filter` WHERE `mode` = "acufn_blocklist" and `type` = "user"';
$blockList = $db->get_results($sql);
if(!$blockList ){
	$blockList = array();
}

$blockListArray = array();

foreach ($blockList  as $item) {
	$blockListArray[] = $item->val;
}

$blacklistText = gotoPage("http://static.acfun.tv/player/filter/blacklist.json");
$blacklist = array();

if($blacklistText) {
	// 去除 UTF-8的BOM
	if(substr($blacklistText, 0,3) == pack("CCC",0xef,0xbb,0xbf)) {
		$blacklistText = trim(substr($blacklistText, 3));
	}
	$blacklist = json_decode($blacklistText);
}

$blacklist = array_values(array_unique(array_merge($blacklist,$blockListArray)));

header("Content-type: text/json; charset=utf-8"); 
echo json_encode($blacklist,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);