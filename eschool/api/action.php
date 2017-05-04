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
// $ppo= array();
// $ppo[]=$tel;
// $ppo[]=$logincode;
if ($_SESSION['logincode']!=$logincode||empty($logincode)) {
	return Response::show('409','登录超时');
}

$id=post_check($_REQUEST['id']);
$cmd=post_check($_REQUEST['cmd']);
$school=post_check($_REQUEST['school']);

switch ($cmd) {


	case 'mejoin':
		

		$sql = "SELECT * FROM es_action_member WHERE stu_id={$id}";
		    
		$query = mysqli_query($connect,$sql);
		    
		while($result = mysqli_fetch_assoc($query)){
			$atds[]= $result['act_id'];

		}


		foreach ($atds as $key => $ids) {
			$sql = "SELECT * FROM es_stu_action WHERE id={$ids}";
			    
			$query = mysqli_query($connect,$sql);
			    
			while($result = mysqli_fetch_assoc($query)){
				$ads[]= $result;

			}
		}


		foreach ($ads as $dd) {
			$authorid=$dd['stu_id'];


			$sql = "SELECT stu_id,stu_name,sex,stu_pic FROM es_stu_info WHERE stu_id={$authorid}";
			    
			$query = mysqli_query($connect,$sql);
			while ($result = mysqli_fetch_assoc($query)) {
				$dd['author']=$result;
			}
			$actid=$dd['id'];

			$sql = "SELECT * FROM es_action_member WHERE act_id={$actid}";
			  
			$query = mysqli_query($connect,$sql);
			$ddm=array();
			while ($result = mysqli_fetch_assoc($query)) {
				$ddm[]=$result['stu_id'];
			}
			$mbr=array();
			foreach ($ddm as $key => $id) {
				$sql = "SELECT stu_id,stu_name FROM es_stu_info WHERE stu_id={$id}";
			    
				$query = mysqli_query($connect,$sql);
				
				while ($result = mysqli_fetch_assoc($query)) {
					$mbr[]=$result;
				
				}
			}

			
			$dd['mbr']=$mbr;
			$dd['mbrs']=count($mbr);


			$data[]=$dd;
		}
	
		return Response::show('209','返回',$data);
		
		break;
	
	case 'out':
		
		$pag=post_check($_REQUEST['pag']);
		if ($pag) {
			$pag=100*$pad;
		} else {
			$pag=100;
		}

		$sql = "SELECT * FROM es_stu_action WHERE school='{$school}' LIMIT {$pag}";
		    
		$query = mysqli_query($connect,$sql);
		    
		while($result = mysqli_fetch_assoc($query)){
			$ads[]= $result;

		}

		foreach ($ads as $dd) {
			$authorid=$dd['stu_id'];


			$sql = "SELECT stu_id,stu_name,sex,stu_pic FROM es_stu_info WHERE stu_id={$authorid}";
			    
			$query = mysqli_query($connect,$sql);
			while ($result = mysqli_fetch_assoc($query)) {
				$dd['author']=$result;
			}

			$actid=$dd['id'];

			$sql = "SELECT * FROM es_action_member WHERE act_id={$actid}";
			    
			$query = mysqli_query($connect,$sql);
			$mbrr=array();

			while ($result = mysqli_fetch_assoc($query)) {
				$mbrr[]=$result['stu_id'];
			}
			$mbr=array();
			foreach ($mbrr as $key => $stuid) {
			
			
				$sql = "SELECT stu_id,stu_name FROM es_stu_info WHERE stu_id={$stuid}";
				    
				$query = mysqli_query($connect,$sql);
				while ($result = mysqli_fetch_assoc($query)) {
					$mbr[]=$result;
				}
			}
			$dd['mbr']=$mbr;

			$dd['mbrs']=count($dd['mbr'])+1;
			$sql = "SELECT count(*) FROM es_action_member WHERE act_id={$actid}";
			    
			$query = mysqli_query($connect,$sql);
			while ($result = mysqli_fetch_assoc($query)) {
					$join=$result['count(*)'];
				}
			
			if ($join==1) {
				$dd['join']='1';
			}else{
				$dd['join']='0';
				$sql = "SELECT count(*) FROM es_action_member WHERE act_id={$actid} and stu_id={$id}";
			    
				$query = mysqli_query($connect,$sql);

				while ($result = mysqli_fetch_assoc($query)) {
					$join=$result['count(*)'];
				}
				if ($join==1) {
				$dd['join']='1';
				}


			}

			$data[]=$dd;
		}


		if (count($data)==0) {
			$data=array();
		}
		return Response::show('208','返回',$data);

				
		break;


	case 'save':

		$sql = "SELECT id,stu_name FROM es_stu_user WHERE id={$id}";
		    
	    $query = mysqli_query($connect,$sql);
	    
	    while($result = mysqli_fetch_assoc($query)){
	      $idd= $result;
	    }
		if (@$_REQUEST['name']) {
		  $name=post_check(@$_REQUEST['name']);
		} else {
		  $name=$idd['stu_name'];
		}


	
		$DIRS=array();
		foreach ($_FILES as $file) {

		  if ((($file["type"] == 'file/*')||($file["type"] == 'application/octet-stream'))
    		&& ($file["size"] <900000))
		    {
		    if ($file["error"] > 0)
		      {
		      $data[]=$file["error"];
		      return Response::show('420','文件错误',$data);
		      }
		    else
		      {
		      $dir="../Upload/pic/" .time(). $file["name"];

		      if (strpos($file["name"],'+')||strpos($file["name"],'\'')||strpos($file["name"],'/'))
		        {
		        
		        return Response::show('421','文件名不合法不能存在‘/’');
		        }
		      else
		        {
		        move_uploaded_file($file["tmp_name"],$dir);
		        
		        // return Response::show('200','保存成功');
		        $DIRS[]=$dir;
		        }

		      
		      }
		    }
		  else
		    {

		    return Response::show('422','文件过大或文件格式错误');
		    }

		}
		$content = post_check(@$_REQUEST['content']);
		if (strpos($content,'\'')) {
		  return Response::show('423','内容违法');
		} else {
		  # code...
		}

		$pic= $DIRS['0'];

		//写入数据库
		$title = post_check(@$_REQUEST['title']);
		$actplace = post_check(@$_REQUEST['actplace']);
		$acttime = post_check(@$_REQUEST['acttime']);
		$school = post_check(@$_REQUEST['school']);
		$time=time();
	
		
		$sql = "INSERT INTO es_stu_action (content,pic,time,stu_id,school,actplace,acttime,title) VALUES ('{$content}','{$pic}','{$time}','{$id}','{$school}','{$actplace}','{$acttime}','{$title}')";


		$query = mysqli_query($connect,$sql);


		if ($query) {
		 
		  return Response::show('207','创建活动成功');
		} else {
		  return Response::show('424','创建活动失败');
		}  
				

				
		break;


	case 'pay':

		$actid=post_check($_REQUEST['actid']);
		$sql="SELECT count(*) FROM es_action_member WHERE act_id={$actid} and stu_id={$id}";
		$query = mysqli_query($connect,$sql);
		while ($result = mysqli_fetch_assoc($query)) {
			$par=$result['count(*)'];
		}
		if ($par) {

			$sql="delete from es_action_member where act_id={$actid} and stu_id={$id}";
			$query = mysqli_query($connect,$sql);
			if ($query) {
				return Response::show('425','取消活动');
			}
			
		}

		$sql="SELECT count(*) FROM es_stu_action WHERE id={$actid} and stu_id={$id}";
		$query = mysqli_query($connect,$sql);
		while ($result = mysqli_fetch_assoc($query)) {
			$par=$result['count(*)'];
		}
		if ($par) {
			return Response::show('490','你是作者');
		}



		$sql = "INSERT INTO es_action_member (act_id,stu_id) VALUES ('{$actid}','{$id}')";
		    
		$query = mysqli_query($connect,$sql);
		    
		
		if ($query) {
			return Response::show('210','关注成功');
		} else {
			return Response::show('425','关注失败');
		}
		
		
		break;

	case 'meset':
		

	

		
		$sql = "SELECT * FROM es_stu_action WHERE stu_id={$id}";
			    
		$query = mysqli_query($connect,$sql);
			    
		while($result = mysqli_fetch_assoc($query)){
			$ads[]= $result;

		}
	


		foreach ($ads as $dd) {
			$authorid=$dd['stu_id'];


			$sql = "SELECT stu_id,stu_name,sex,stu_pic FROM es_stu_info WHERE stu_id={$authorid}";
			    
			$query = mysqli_query($connect,$sql);
			while ($result = mysqli_fetch_assoc($query)) {
				$dd['author']=$result;
			}
			$actid=$dd['id'];

			$sql = "SELECT * FROM es_action_member WHERE act_id={$actid}";
			  
			$query = mysqli_query($connect,$sql);
			$ddm=array();
			while ($result = mysqli_fetch_assoc($query)) {
				$ddm[]=$result['stu_id'];
			}
			$mbr=array();
			foreach ($ddm as $key => $id) {
				$sql = "SELECT stu_id,stu_name FROM es_stu_info WHERE stu_id={$id}";
			    
				$query = mysqli_query($connect,$sql);
				
				while ($result = mysqli_fetch_assoc($query)) {
					$mbr[]=$result;
				
				}
			}

			
			$dd['mbr']=$mbr;
			$dd['mbrs']=count($mbr)+1;


			$data[]=$dd;
		}

		return Response::show('200','返回',$data);
		
		break;

	case 'outjoin':
		$actid=post_check($_REQUEST['actid']);

		$sql="delete from es_action_member where act_id={$newsid} and stu_id={$id}";
			$query = mysqli_query($connect,$sql);
			if ($query) {
				return Response::show('275','取消活动');
			}



		break;



	default:
	
		break;
}





















 ?>
