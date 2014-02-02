<?php
require_once("init.php");

$sql = "select * from `filter` where `mode` = 'blocklist' order by `id` desc";
$blockList = $db->get_results($sql);
if(!$blockList ){
	$blockList = array();
}

$xmlstr = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<filter>
</filter>
XML;

$xml = simplexml_load_string($xmlstr);
foreach($blockList as $item){
	$filter = $xml->addChild("f",$item->val);
	$filter->addAttribute('t',$item->type);
}
header('Content-Type: text/xml'); 
echo $xml->asXML();