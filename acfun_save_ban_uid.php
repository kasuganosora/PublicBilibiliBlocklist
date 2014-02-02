<?php
// save acfun ban uid
require_once("init.php");

if(!isset($_GET['uid']) ||   trim($_GET['uid']) == ""){
	echo json_encode(array("success" =>false));
	exit();
}



$uid = trim($_GET['uid']);

$hasBan = $db->get_var("select count(*) > 0 from `filter` where `mode` = 'acufn_blocklist' and `type` = 'user' and `val` = '$uid' ") != '0';

if(!$hasBan){
	$mode = "acufn_blocklist";
	$sql = "REPLACE INTO `filter` (val,type,mode,uid) VALUES('$uid','user','$mode','0');";
	$db->query($sql);
}


$result = json_encode(array("success" =>true));

if(isset($_GET["callback"])){
	header('Content-Type: application/javascript');
	echo $_GET["callback"] . "(" . $result . ");";
}else{
	header('Content-Type: application/json');
	echo $result;
}