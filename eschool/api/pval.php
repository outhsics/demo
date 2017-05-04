<?php 

require_once('./Config/Config.php');


try{
	$connect = Db::getInstance()->dbConnect();
}catch (Exception $e){
	return Response::show('400','数据库链接失败');
}



$tel = post_check($_REQUEST['tel']);
if(preg_match("/^1[3-5,8]{1}[0-9]{9}$/",$tel)){    
   
         
}else{    
    //手机号码格式不对    
     return Response::show('400','手机号码格式不对');    
}

$sql = "select tel from es_stu_user where tel={$tel}";


$query = mysqli_query($connect,$sql);



if ($result = mysqli_fetch_assoc($query)) {
	return Response::show('400','手机号码已经注册');
} else {
	return Response::show('200','手机号码可以注册');
}




















 ?>