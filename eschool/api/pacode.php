<?php 
require('./Class/Response.class.php');
error_reporting(E_ERROR);
$code = trim($_REQUEST['code']);
$tel = trim($_REQUEST['tel']);

session_id("l{$tel}");
session_start();
$time=$_SESSION["k{$code}"]; 

if ($time) {
	if (time()-$time>600) {
		return Response::show('463','验证超时');
	}
	return Response::show('263','验证通过');
	
}else{
	return Response::show('496','验证错误');
}















 ?>