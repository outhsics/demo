<?php 
require_once('./Config/Config.php');

error_reporting(E_ERROR);

// $id = post_check(@$_REQUEST['id']);
$tel = post_check(@$_REQUEST['tel']);

$logincode = post_check(@$_REQUEST['logincode']);

session_id("l{$tel}");
session_start();

if ($_SESSION['logincode']!=$logincode) {
	return Response::show('409','登录超时');
}




session_unset();
session_destroy();

return Response::show('222','退出成功');



 ?>