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
$cmd=post_check(@$_REQUEST['cmd']);

switch ($cmd) {
	case 'tel':
		$tels = post_check($_REQUEST['tels']);
		
		if(preg_match("/^1[3-5,8]{1}[0-9]{9}$/",$tels)){    
		   
		         
		}else{    
		    //手机号码格式不对    
		     return Response::show('401','手机号码格式不对');    
		}

		$sql = "select tel from es_stu_user where tel={$tels}";


		$query = mysqli_query($connect,$sql);



		if ($result = mysqli_fetch_assoc($query)) {
			return Response::show('402','手机号码已经注册');
		} else {
			
		}


		$code =  post_check($_REQUEST['code']);
		// session_destroy();
		// session_unset();
		// session_id("{$tels}");
		// session_start(); 

		$time=$_SESSION["k{$code}"];

		if ($time) {
			if (time()-$time>300) {
				return Response::show('403','验证超时');
			}
			
		}else{
			return Response::show('404','验证码错误');
		}


		$sql = "UPDATE es_stu_user SET tel='{$tels}' where id={$id}";


		$query = mysqli_query($connect,$sql);
		if ($query) {
			return Response::show('266','修改成功');
		} else {
			return Response::show('466','修改失败');
		}
		



		break;


	case 'pwd':
		$password =  md5(post_check(@$_REQUEST['password']));
		$passwords =  md5(post_check(@$_REQUEST['passwords']));

		$sql = "select password from es_stu_user where id={$id}";


		$query = mysqli_query($connect,$sql);

		while($result = mysqli_fetch_assoc($query)){
			
		   $pwd= $result['password'];
		}
		if ($pwd!=$password) {
			return Response::show('486','密码错误');
		}



		$sql = "UPDATE es_stu_user SET password='{$passwords}' where id={$id}";


		$query = mysqli_query($connect,$sql);
		if ($query) {
			return Response::show('266','修改成功');
		} else {
			return Response::show('466','修改失败');
		}
		


		break;	
	default:
		# code...
		break;
}















 ?>