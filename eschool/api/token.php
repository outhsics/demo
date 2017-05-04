<?php 

require_once('./Config/Config.php');
error_reporting(E_ERROR);

try{
	$connect = Db::getInstance()->dbConnect();
}catch (Exception $e){
	return Response::show('400','数据库链接失败');
}

$token =  post_check($_REQUEST['token']);
$token=substr($token,2);
$token=base64_decode($token);


$token=explode('+',$token); 

$id=$token['0'];


$sql = "SELECT tel FROM es_stu_user WHERE id={$id}";
		    
		$query = mysqli_query($connect,$sql);
		    
		while($result = mysqli_fetch_assoc($query)){
			
		   $tel= $result['tel'];
}


session_id("l{$tel}");
session_start(); 





$_SESSION['logincode']=rand(111111,999999);



$data['logincode']=$_SESSION['logincode'];

return Response::show('299','返回logincode',$data);



 ?>