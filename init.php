<?php
require_once("config.php");
require_once("lib/ezsql/ez_sql_core.php");
require_once("lib/ezsql/mysql/ez_sql_mysql.php");

$_POST = sql_injection($_POST);
$_GET = sql_injection($_GET);
 
function sql_injection($content)
{
	if (!get_magic_quotes_gpc()) {
		if (is_array($content)) {
			foreach ($content as $key=>$value) {
				$content[$key] = addslashes($value);
			}
		} else {
			addslashes($content);
		}
	} 
	return $content;
}  

$db = new ezSQL_mysql(DBUSERNAME,DBUSERPASSWORD,DBNAME,DBHOST);
$db->query("set names utf8");

function gotoPage($url){
	$userAgent = $_SERVER["HTTP_USER_AGENT"];
	$cookie = $_SERVER['HTTP_COOKIE'];
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_PROXY, $proxy);
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_USERAGENT, $userAgent);
	curl_setopt ($ch, CURLOPT_COOKIE, $cookie);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt ($ch, CURLOPT_TIMEOUT, 120);
	$result = curl_exec ($ch);
	curl_close($ch);
	return $result;
 
}
?>