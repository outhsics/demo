<?php 

require_once('./Config/Config.php');
error_reporting(E_ERROR);
try{
	$connect = Db::getInstance()->dbConnect();
}catch (Exception $e){
	return Response::show('400','数据库链接失败');
}
$code = post_check($_REQUEST['code']);
$password = md5(post_check($_REQUEST['password']));
$tel = post_check($_REQUEST['tel']);
//验证码
$p=session_id("l{$tel}");
session_start();


$time=$_SESSION["k{$code}"]; 

if ($time) {
	if (time()-$time>600) {
		return Response::show('485','验证超时');
	}
	
}else{
	return Response::show('487','验证错误');
}
//更新密码到数据库



$sql = "UPDATE es_stu_user SET password={$password} WHERE tel={$tel}";


$query = mysqli_query($connect,$sql);


if ($query) {
	return Response::show('277','修改成功');
} else {
	return Response::show('477','修改失败');
}


 ?>