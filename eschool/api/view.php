<?php 

require_once('./Config/Config.php');
error_reporting(E_ERROR);
try{
	$connect = Db::getInstance()->dbConnect();
}catch (Exception $e){
	return Response::show('400','数据库链接失败');
}

$tel = post_check(@$_REQUEST['tel']);
$logincode = post_check(@$_REQUEST['logincode']);
session_id("l{$tel}");
session_start();

if ($_SESSION['logincode']!=$logincode||empty($logincode)) {
	return Response::show('409','登录超时');
}

$id=post_check(@$_REQUEST['id']);
$title=post_check(@$_REQUEST['title']);
$content=post_check(@$_REQUEST['content']);
$sql = "INSERT INTO es_view (title,content,stu_id) VALUES ('{$title}','{$content}','{$id}')";


$query = mysqli_query($connect,$sql);


if ($query ) {
		return Response::show('278','反馈成功');
}

return Response::show('478','反馈失败');




 ?>