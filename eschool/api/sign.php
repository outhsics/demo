<?php 

require_once('./Config/Config.php');
error_reporting(E_ERROR);

try{
	$connect = Db::getInstance()->dbConnect();
}catch (Exception $e){
	return Response::show('400','数据库链接失败');
}
//手机号码****验证
$tel =  post_check(@$_REQUEST['tel']);
if(preg_match("/^1[3-5,8]{1}[0-9]{9}$/",$tel)){    
   
         
}else{    
    //手机号码格式不对    
     return Response::show('401','手机号码格式不对');    
}

$sql = "select tel from es_stu_user where tel={$tel}";


$query = mysqli_query($connect,$sql);



if ($result = mysqli_fetch_assoc($query)) {
	return Response::show('402','手机号码已经注册');
} else {
	
}

//短信验证码***


$code =  post_check(@$_REQUEST['code']);

session_id("l{$tel}");
session_start(); 

$time=$_SESSION["k{$code}"];

if ($time) {
	if (time()-$time>300) {
		return Response::show('403','验证超时');
	}
	
}else{
	return Response::show('404','验证码错误');
}
//密码  **格式验证
$password = md5(post_check(@$_REQUEST['password']));
if (empty($password)) {
	return Response::show('405','密码不能为空');
}



//注册   **写入数据库

$imsname=rand(1111111111,9999999999).time();
$sql = "INSERT INTO es_stu_user (password,tel,imsname) VALUES ('{$password}','{$tel}','{$imsname}')";


$query = mysqli_query($connect,$sql);


if ($query) {

	//登录缓存  
	// session_id("l{$tel}");
	// session_start();
	$_SESSION['logincode']=rand(111111,999999);

	$sql = "SELECT id,tel,imsname FROM es_stu_user WHERE tel={$tel}";
		    
		$query = mysqli_query($connect,$sql);
		    
		while($result = mysqli_fetch_assoc($query)){
			
		   $data= $result;
		}
		$id=$data['id'];
		$sql =	"INSERT INTO es_stu_care (id) VALUES ('{$id}')";
		$query = mysqli_query($connect,$sql);
	$data['token']=	'Es'.$data['id'].'+'.$data['imsname'];
	$data['logincode']=$_SESSION['logincode'];
	return Response::show('200','注册成功',$data);
} else {
	return Response::show('406','写入数据库失败');
}




















 ?>