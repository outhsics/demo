<?php
/*
 * userLogin用户登陆     
 */
require_once('./Config/Config.php');
error_reporting(E_ERROR);
try{
	$connect = Db::getInstance()->dbConnect();
}catch (Exception $e){
	return Response::show('400','数据库链接失败');
}


$tel =  post_check(@$_REQUEST['tel']);
$password =  md5(post_check(@$_REQUEST['password']));

		
if (empty($tel) || empty($password)) {
	return Response::show('407','用户名或密码不能为空');
}
$sql = "SELECT id,email,imsname FROM es_stu_user WHERE tel = '{$tel}' AND password = '{$password}'";

$query = mysqli_query($connect,$sql);
$result = mysqli_fetch_assoc($query);
$data= $result;
$time=time();

if($result){
//登录缓存  
	session_id("l{$tel}");
	session_start();
	$_SESSION['logincode']=rand(111111,999999);
	$data['logincode']=$_SESSION['logincode'];
	$id=$data['id'];
	$sql = "SELECT school,sex,stu_pic,stu_name FROM es_stu_info WHERE stu_id={$id}";
		    
		$query = mysqli_query($connect,$sql);
		    
		while($result = mysqli_fetch_assoc($query)){
			
		   $datas= $result;
		}
		foreach ($datas as $key => $value) {
			$data["{$key}"]=$value;
		}
	// $data['token']=	'Es'.$data['id'].'+'.$data['imsname'];
		if ($data["email"]==null) {
			$data["email"]='';
		}
		$data["tel"]=$tel;
	return Response::show('201','登陆成功',$data);
	}
return Response::show('408','登陆失败',$data);













