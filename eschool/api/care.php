<?php 

require_once('./Config/Config.php');
error_reporting(E_ERROR);
try{
  $connect = Db::getInstance()->dbConnect();
}catch (Exception $e){
  return Response::show('400','数据库链接失败');
}

$tel = post_check($_REQUEST['tel']);
$logincode = post_check($_REQUEST['logincode']);
session_id("l{$tel}");
session_start();

if ($_SESSION['logincode']!=$logincode||empty($logincode)) {
	return Response::show('409','登录超时');
}

$id =  post_check($_REQUEST['id']);

$cmd =  post_check($_REQUEST['cmd']);
switch ($cmd) {
	case 'fans':
		
		$sql = "select id from es_stu_care where care_id  REGEXP '[[:<:]]{$id}[[:>:]]' ";



		$query = mysqli_query($connect,$sql);
		while($result = mysqli_fetch_assoc($query)){
					
			$manid[]= $result['id'];
		}
		$sql = "select care_id from es_stu_care where id={$id} ";



		$query = mysqli_query($connect,$sql);
	
		while($result = mysqli_fetch_assoc($query)){
					
			$caress= $result['care_id'];
		}		
		foreach ($manid as $key => $stuid) {

			$sql = "select id,imsname from es_stu_user where id={$stuid}";

			$query = mysqli_query($connect,$sql);
			while($result = mysqli_fetch_assoc($query)){
						
					   $man= $result;
			}
			$sql = "select stu_name,stu_pic from es_stu_info where stu_id={$stuid}";

			$query = mysqli_query($connect,$sql);
			while($result = mysqli_fetch_assoc($query)){
						
					   $man['stuname']= $result['stu_name'];
					   $man['stupic']= $result['stu_pic'];
			}
			if ($man['stuname']==null) {
				$man['stuname']='';
			}
			if ($man['stupic']==null) {
				$man['stupic']='';
			} 
			$caresss=explode('|',$caress);
			if (in_array($stuid,$caresss )) {
				$man['care']=1;
			}else{
				$man['care']=0;
				}
			
			
			$mans[]=$man;

		}
		$data=$mans;
		return Response::show('209','返回',$data);

		break;


	case 'cares':

		$sql = "select care_id from es_stu_care where id={$id}";



		$query = mysqli_query($connect,$sql);
		while($result = mysqli_fetch_assoc($query)){
					
				   $manids= $result['care_id'];
		}


		$manid=explode("|",$manids); 



		foreach ($manid as $key => $stuid) {
			if ($stuid!=null) {
				
			
				$sql = "select id,imsname from es_stu_user where id={$stuid}";

				$query = mysqli_query($connect,$sql);
				while($result = mysqli_fetch_assoc($query)){
							
						   $man= $result;
				}

				$sql = "select stu_name,stu_pic from es_stu_info where stu_id={$stuid}";

				$query = mysqli_query($connect,$sql);
				while($result = mysqli_fetch_assoc($query)){
							$man['stupic']= $result['stu_pic'];
						   $man['stuname']= $result['stu_name'];
				}
				if ($man['stuname']==null) {
					$man['stuname']='';
				}
				if ($man['stupic']==null) {
					$man['stupic']='';
				} 
				
				$mans[]=$man;
			}
		}
		$data=$mans;
		return Response::show('209','返回数据',$data);

		break;

	case 'care':
		$careid =  post_check(@$_REQUEST['careid']);
		$sql = "select care_id from es_stu_care where id={$id}";



		$query = mysqli_query($connect,$sql);
		while($result = mysqli_fetch_assoc($query)){
					
				   $manids= $result['care_id'];
		}


		$manid=explode("|",$manids); 

		
			if (in_array($careid,$manid)) {
				$care=1;
			}
			
		
		if ($care==1) {
			return Response::show('209','已关注');
		} else {
			
			$manid[]=$careid;
		}
	
		$manids=implode("|",$manid);
		$sql="UPDATE es_stu_care SET care_id='{$manids}' where id={$id}";
		$query = mysqli_query($connect,$sql);
		if ($query) {
			return Response::show('209','关注成功');
		} else {
			return Response::show('409','关注失败');
		}
		


		break;

	
	default:
		
		break;
}







 ?>