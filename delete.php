<?php 
require_once("init.php");
$id = $_GET["id"];
if(!isset($id)){
	echo "err";
	exit();
}
$sql = "DELETE FROM `filter` WHERE id='$id'";
$db->query($sql);
echo "ok";