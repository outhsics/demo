<?php 

require_once('./Config/Config.php');
error_reporting(E_ERROR);

try{
  $connect = Db::getInstance()->dbConnect();
}catch (Exception $e){
  return Response::show('400','数据库链接失败');
}

// $tel = post_check($_REQUEST['tel']);
// $logincode = post_check($_REQUEST['logincode']);
// session_id("l{$tel}");
// session_start();

// if ($_SESSION['logincode']!=$logincode||empty($logincode)) {
// 	return Response::show('409','登录超时');
// }
$imsname = post_check($_REQUEST['imsname']);

	$sql = "SELECT id FROM es_stu_user WHERE imsname={$imsname}";
		
			$query = mysqli_query($connect,$sql);
			while ($result= mysqli_fetch_assoc($query)) {
			  $dd= $result['id'];
			}


	$sql = "SELECT stu_id,stu_pic,stu_name FROM es_stu_info WHERE stu_id={$dd}";
		
			$query = mysqli_query($connect,$sql);
			while ($result= mysqli_fetch_assoc($query)) {
			  $dds= $result;
			}

	




return Response::show('216','返回数据',$dds);




















 ?>