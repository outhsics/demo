<?php
/*
 * looks  找人     
 */
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
	return Response::show('409','logincode或者tel 没有');
}

$id=post_check(@$_REQUEST['id']);
$cmd=post_check(@$_REQUEST['cmd']);
$school=post_check(@$_REQUEST['school']);


switch($cmd){
	// 用户登陆
	case 'know':

		$tels=$_REQUEST['tels'];
		if (empty($tels)) {
			return Response::show('400','tel为空');
		}
		
		$tell=implode(",",$tels);

		$sql = "SELECT id FROM es_stu_user WHERE tel in ({$tell})";
		
		$query = mysqli_query($connect,$sql);
		$idss= array();
		while($result = mysqli_fetch_assoc($query)){
			$idss[] = $result['id'];
		}
		$datas= array();
		foreach ($idss as $key => $idf) {
			

			$sql = "SELECT stu_id,sex,stu_pic,stu_name FROM es_stu_info WHERE stu_id={$idf}";
			$query =mysqli_query($connect,$sql);
			
			while($result = mysqli_fetch_assoc($query)){
				$datas[] = $result;

			}
		}
		$data= array();
		foreach ($datas as $key => $man) {
			if ($man['stu_pic']==null) {
				$man['stu_pic']='';
			}
			$data[]=$man;
		}

		if(count($data)==0){
			return Response::show('400','没有认识的人',$datas);
		}
		return Response::show('200','找到认识的人',$data);
		break;

	case 'exact':
	
        $major =  post_check($_REQUEST['major']);
        //专业
        $sex =  post_check($_REQUEST['sex']);
        $schools =  post_check($_REQUEST['schools']);
        $stuname =  post_check($_REQUEST['stuname']);
        $sel=array();
        if (isset($major)&&!empty($major)) {
	        $sel[]='major=\''.$major.'\'';        	
        }
        if (isset($school)&&!empty($schools)) {
        	$sel[]='school=\''.$schools.'\'';
        }
        if (isset($sex)&&!empty($sex)) {        
        	$sel[]='sex=\''.$sex.'\'';
        }
        if (isset($stuname)&&!empty($stuname)) { 
        	$sel[]='stu_name like \''.$stuname.'\'';
        }        
       
        $sels= implode(' and ',$sel);

		$sql = "SELECT stu_pic,stu_id,sex,stu_name FROM es_stu_info WHERE {$sels}" ;
		$query = mysqli_query($connect,$sql);
		$data = array();
		while($result = mysqli_fetch_assoc($query)){
			$data[] = $result;
		}
		
		return Response::show('200','查询成功',$data);
		break;
	case 'nearby':
		$lat = trim($_REQUEST['lat']);//经度
		$lng = trim($_REQUEST['lng']);//纬度			
		$sql = "update es_stu_user set lat='{$lat}',lng='{$lng}' WHERE id={$id}";
		$query = mysqli_query($connect,$sql);
		$r=0.002248;
		$latd=$lat+$r;	
		$latx=$lat-$r;
		$lngd =$lng+$r;
		$lngx =$lng-$r;

		$sql = "SELECT id FROM es_stu_user WHERE id<>{$id} and lat<{$latd} and lat>{$latx} and lng<{$lngd} and lng>{$lngx}";
		$query = mysqli_query($connect,$sql);
		$ids = array();
		while($result = mysqli_fetch_assoc($query)){
			$ids[]= $result['id'];
		}
		
		$data = array();
		foreach ($ids as $key => $idi) {
			$sql = "SELECT stu_pic,stu_id,sex,stu_name FROM es_stu_info WHERE stu_id={$idi}";
			$query = mysqli_query($connect,$sql);
			
			while($result = mysqli_fetch_assoc($query)){
				$data[]= $result;
			}
		}
		$sql = "select care_id from es_stu_care where id={$id} ";



		$query = mysqli_query($connect,$sql);
		$caress=array();
		while($result = mysqli_fetch_assoc($query)){
					
			$caress= $result['care_id'];
		}	
		$caress=explode('|',$caress);
		$datas = array();
		foreach ($data as $key => $man) {
			if ($man['stu_name']==null) {
				$man['stu_name']='';
			}

			if (in_array($man['stu_id'],$caress)) {
				$man['care']=1;
			}else{
				$man['care']=0;
				}







			$datas[]=$man;
		}
		return Response::show('200','返回数据',$datas);
		break;

		
	default:
		return Response::show('4**','没有该方法');
}
