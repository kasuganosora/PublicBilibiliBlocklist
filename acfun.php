<?php
// ACFunc keyword ban list
require_once("init.php");

$sql = 'SELECT val FROM `filter` WHERE `type` = "keyword"';
$blockList = $db->get_results($sql);
if(!$blockList ){
	$blockList = array();
}

$blockListArray = array();

foreach ($blockList  as $item) {
	$blockListArray[] = $item->val;
}



// ACfunc 原来的屏蔽列表
$acfunRawBlocKWListText = gotoPage("http://static.acfun.tv/player/filter/ban.json");

$acfuncRawBlocKWList = array();
if($acfunRawBlocKWListText){
	// 去除 UTF-8的BOM
	if(substr($acfunRawBlocKWListText, 0,3) == pack("CCC",0xef,0xbb,0xbf)) {
		$acfunRawBlocKWListText = trim(substr($acfunRawBlocKWListText, 3));
	}
	$acfuncRawBlocKWList = json_decode($acfunRawBlocKWListText);

}

// 合并2个列表
$blockListArray = array_values(array_unique(array_merge($acfuncRawBlocKWList,$blockListArray)));

header("Content-type: text/json; charset=utf-8"); 
echo json_encode($blockListArray,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);