<?php 

require_once('./Config/Config.php');
error_reporting(E_ERROR);
try{
  $connect = Db::getInstance()->dbConnect();
}catch (Exception $e){
  return Response::show('400','数据库链接失败');
}



$cmd =  post_check($_REQUEST['cmd']);
	



switch ($cmd) {
	case 'school':
		$schooled =  post_check($_REQUEST['schooled']);		
		$schoolId =  post_check($_REQUEST['schoolId']);	
		if (!empty($schooled)) {
			$sql = "select id,name from es_univs where name  REGEXP '^{$schooled}'";



			$query = mysqli_query($connect,$sql);
			$schools= array();
			while($result = mysqli_fetch_assoc($query)){
						
				$schools[]= $result;
			}


			return Response::show('293','返回',$schools);

		}
		$majored =  post_check($_REQUEST['majored']);		




		if (!empty($majored)) {
			$sql = "select id,name from es_faculty where uid='{$schoolId}' and name  REGEXP '^{$majored}' ";
		}
		$sql = "select id,name from es_faculty where uid='{$schoolId}' ";



		$query = mysqli_query($connect,$sql);
		$majors= array();
		while($result = mysqli_fetch_assoc($query)){
					
			$majors[]= $result;
		}


		return Response::show('292','返回',$majors);



		break;


	// case 'major':

		// 	$schoolid =  post_check($_REQUEST['schoolid']);	

		// 	$majored =  post_check($_REQUEST['majored']);		


		// 	$sql = "select id,name from es_faculty where uid='{$schoolid}' and name  REGEXP '^{$majored}' ";



		// 	$query = mysqli_query($connect,$sql);
		// 	$majors= array();
		// 	while($result = mysqli_fetch_assoc($query)){
						
		// 		$majors[]= $result;
		// 	}


		// 	return Response::show('292','返回',$majors);







		// 	break;





	case 'instructor':

		$majorId =  post_check($_REQUEST['majorId']);		

		$schoolId = post_check($_REQUEST['schoolId']);
		$sql = "select id,name from es_tutor_info where school={$schoolId} and major={$majorId} ";



		$query = mysqli_query($connect,$sql);
		$majors= array();
		while($result = mysqli_fetch_assoc($query)){
					
			$majors[]= $result;
		}


		return Response::show('291','返回',$majors);

	case 'home':

		$homeed =  post_check($_REQUEST['homeed']);		
		$homeid =  post_check($_REQUEST['homeid']);	
		if (!empty($homeed)) {

			$sql = "select provinceID,pname from es_province where pname  REGEXP '^{$homeed}' ";



			$query = mysqli_query($connect,$sql);
			$home= array();
			while($result = mysqli_fetch_assoc($query)){
						
				$home[]= $result;
			}


			return Response::show('290','返回',$home);
			
		}
		$homeeds =  post_check($_REQUEST['homeeds']);	

		$sql = "select cityID as areaID,city as area from es_city where provinceID='{$homeid}' ";

		if (!empty($homeeds)) {
			$sql = "select cityID as areaID,city as area from es_city where provinceID='{$homeid}' city  REGEXP '^{$homeeds}'";
		}

		$query = mysqli_query($connect,$sql);
		$homes= array();
		while($result = mysqli_fetch_assoc($query)){
					
			$homes[]= $result;
		}
	
		if (count($homes)==1) {
			$city=$homes['0']['areaID'];
			$sql = "select areaID,area from es_area where cityID='{$city}' ";



			$query = mysqli_query($connect,$sql);
			$homes= array();
			while($result = mysqli_fetch_assoc($query)){
						
				$homes[]= $result;
			}	


		}


		return Response::show('289','返回',$homes);



		break;












	
	default:
		# code...
		break;
}
















 ?>