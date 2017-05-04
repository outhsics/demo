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

$id = post_check(@$_REQUEST['id']);

$cmd = post_check(@$_REQUEST['cmd']);



switch ($cmd) {
	case 'save':
		$DIRS=array();
		foreach ($_FILES as $file) {

		  if ((($file["type"] == 'file/*')||($file["type"] == 'application/octet-stream'))&&($file["size"] < 10000000000000))
		    {
		    if ($file["error"] > 0)
		      {
		      
		      return Response::show('410','文件错误');
		      }
		    else
		      {
		      $dir="../Upload/pic/" .time(). $file["name"];

		      if (strpos($file["name"],'+')||strpos($file["name"],'\'')||strpos($file["name"],'/'))
		        {
		        
		        return Response::show('411','文件名不合法不能存在‘/+’');
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

		    return Response::show('412','文件过大或文件格式错误',$_FILES);
		    }

		}
		$content = post_check(@$_REQUEST['content']);
		if (strpos($content,'\'')) {
		  return Response::show('413','内容违法');
		} else {
		  # code...
		}

		$pic= implode("+",$DIRS);		

		$title = post_check(@$_REQUEST['title']);
		$content = post_check(@$_REQUEST['content']);
	
		$rem=post_check(@$_REQUEST['rem']);
		$school=post_check(@$_REQUEST['school']);
	
	
		$time=time();


		$sql = "INSERT INTO es_stu_news (content,pic,time,stu_id,school,title) VALUES ('{$content}','{$pic}','{$time}','{$id}','{$school}','{$title}')";


		$query = mysqli_query($connect,$sql);
		if ($query) {
			 // 提醒好友查看
		  $sql = "SELECT id FROM es_stu_news WHERE time={$time} and stu_id={$id}";
		  $query = mysqli_query($connect,$sql);
		    
		  while($result = mysqli_fetch_assoc($query)){
		      $dd= $result;
		  }
		  $imsnames = array();
		  foreach ($rem as $tel => $ids) {
		  

		    $sql = "SELECT imsname FROM es_stu_user WHERE time={$time} and stu_id={$ids}";
		    $query = mysqli_query($connect,$sql);

			while($result = mysqli_fetch_assoc($query)){
				$imsnames= $result['imsname'];
			}
		    
		    
		  }
		  
			return Response::show('200','发布成功');
		} else {
			return Response::show('414','发布失败');
		}


		


		break;
	


	case 'back':
		$content = post_check($_REQUEST['content']);
		$newsid = post_check($_REQUEST['newsid']);
		
		$bid = post_check($_REQUEST['bid']);
		if ($bid) {
			
		} else {
			$bid=0;
		}
		
		$time=time();
		if (strpos($content,'\'')||strpos($content,'+')) {
		  return Response::show('400','内容违法\\+');
		}
		$sql = "INSERT INTO es_news_back (id,stu_id,bstu_id,content,time) VALUES ('{$newsid}','{$id}','{$bid}','{$content}','{$time}')";


		$query = mysqli_query($connect,$sql);


		if ($query) {
			return Response::show('203','评论成功');
		} else {
			return Response::show('415','评论失败');
		}

		break;

	case 'out':

		$school=post_check($_REQUEST['school']);
		$pag=post_check($_REQUEST['pag']);
		if ($pag) {
			// $pag=30*$pad.','.30*($pad-1);
		} else {
			$pag=30;
		}
		if ($school) {
			// $pop="";
			$sql = "SELECT * FROM es_stu_news WHERE school='{$school}' order by time desc LIMIT {$pag}";
			
			$query = mysqli_query($connect,$sql);
			while ($result= mysqli_fetch_assoc($query)) {
			  $dds[]= $result;
			}



		} else {
			$sql = "select care_id from es_stu_care where id={$id}";



			$query = mysqli_query($connect,$sql);
			while($result = mysqli_fetch_assoc($query)){
						
					   $manids= $result['care_id'];
			}


			$manid=explode("|",$manids);
				
	

			foreach ($manid as $key => $mid) {
				if ($mid!=null) {
					$mid='stu_id='.$mid;

					$manid["{$key}"]=$mid;
				}else{

					unset($manid["{$key}"]);
				}

				
			}
		
			$pop=implode(' or ',$manid);
			
			$day=20;
			$day= time()-86400*$day;
			
			
			if ($pop!=null) {
				$pop=$pop.' or ';
			}
			
			$sql = "SELECT * FROM es_stu_news WHERE ({$pop}stu_id={$id}) and time > $day and school='' order by time desc LIMIT {$pag}";
		
			$query = mysqli_query($connect,$sql);
			while ($result= mysqli_fetch_assoc($query)) {
			  $dds[]= $result;
			}
		
		}
		
		
		
		foreach ($dds as $dd){
			$author=$dd['stu_id'];
			$sql = "SELECT stu_id,sex,stu_pic,stu_name FROM es_stu_info WHERE stu_id={$author}";
		
			$query = mysqli_query($connect,$sql);
			while ($result= mysqli_fetch_assoc($query)) {
			  $dd['stu_id']= $result;
			}
	

	
		 //对匿名处理
		  if ($dd['name']) {
		  	$dd['name']='匿名';
		  } else {
		  	$stuid=$dd['stu_id'];
		  	$sql = "SELECT stu_name FROM es_stu_user WHERE id={$stuid}";
		   
			$query = mysqli_query($connect,$sql);

			while($resultsss = mysqli_fetch_assoc($query)){

				$da= $resultsss;
				$dd['name']=$da['stu_name'];
			}
		  }
		//对图片处理
		  if ($dd['pic']=='') {
		  	$pics=array();
		  	
		  	
		  	
		  }else{
		  	$pics=explode('+',$dd['pic']);
		  }



		  $dd['pic']=$pics;
		  //对转发处理
		  if (strpos($dd['content'],'+')) {
		  	$dda=explode('+',$dd['content']); 
		  	$dd['content']=$dda;

		  }
		  
		  //对评论处理
		  $newsid=$dd['id'];
		  $sql = "SELECT * FROM es_news_back WHERE id={$newsid}";

		      
		  $query = mysqli_query($connect,$sql);
		  $da=array();
		  while($resultss = mysqli_fetch_assoc($query)){
		  	$da[]= $resultss;
		  	
		  }
		  $dam=array();
		  foreach ($da as $key) {
		  	  $stuid=$key['stu_id'];
		  	  
			  $sql = "SELECT stu_name FROM es_stu_info WHERE stu_id={$stuid}";
			      
			  $query = mysqli_query($connect,$sql);
			 
			  while($resultss = mysqli_fetch_assoc($query)){
			  	$name= $resultss;
			  	
			  }
			  $key['stu_name']=$name['stu_name'];

			   $bstuid=$key['bstu_id'];
			  $sql = "SELECT stu_name FROM es_stu_info WHERE stu_id={$bstuid}";
			      
			  $query = mysqli_query($connect,$sql);
			 
			  while($resultss = mysqli_fetch_assoc($query)){
			  	$sname= $resultss;
			  	
			  }
			  $key['bstu_name']=$sname['stu_name'];
			  if ($key['bstu_id']==null) {
			  	$key['bstu_id']='';
			  }
			  if ($key['bstu_name']==null) {
			  	$key['bstu_name']='';
			  }

			  $dam[]=$key;
		  }
		  


		  $dd['backnum']=count($dam);
		  if ($dd['backnum']) {
		  	
		  } else {
		  	$dd['backnum']=0;
		  }
		  
		  $dd['back']=$dam;

		  $sql = "SELECT count(*) FROM es_news_praise WHERE id={$newsid}";
		      
		  $query = mysqli_query($connect,$sql);
		  $das=null;
		  while($resultss = mysqli_fetch_assoc($query)){
		  	
		    $das= $resultss['count(*)'];
		    
		    
		    
		  }
			if ($das) {
					    	
			} else {
			    $das=0;
			}
		  $dd['parise']=$das;

		  $sql = "SELECT count(*) FROM es_news_praise WHERE stu_id={$id} and id={$newsid}";
		      
		  $query = mysqli_query($connect,$sql);
		  while($resultss = mysqli_fetch_assoc($query)){
		  	
		    $dd['parised']= $resultss['count(*)'];
		    
		    
		    
		  }




		  


		$data[]=$dd;
		  

		}

	
		return Response::show('204','返回数据',$data);


		break;


	case 'praise':

		
		$newsid = post_check($_REQUEST['newsid']);


		$sql="SELECT count(*) FROM es_news_praise WHERE id={$newsid} and stu_id={$id}";
		$query = mysqli_query($connect,$sql);
		while ($result = mysqli_fetch_assoc($query)) {
			$par=$result['count(*)'];
		}
		if ($par) {

			$sql="delete from es_news_praise where id={$newsid} and stu_id={$id}";
			$query = mysqli_query($connect,$sql);
			if ($query) {
				return Response::show('416','取消赞');
			}
			
		}
		$time=time();
		$sql = "INSERT INTO es_news_praise (id,stu_id,time) VALUES ('{$newsid}','{$id}','{$time}')";


		$query = mysqli_query($connect,$sql);


		if ($query) {
			return Response::show('205','赞成功');
		} else {
			return Response::show('417','赞失败');
		}



		break;



	case 'for':
		
		$newsid=post_check(@$_REQUEST['newsid']);

		$content = post_check(@$_REQUEST['content']);
		if (strpos($content,'\'')||strpos($content,'+')) {
		  return Response::show('400','内容违法\\+');
		} else {
		  # code...
		}
		
		// $sql = "SELECT id FROM es_stu_news WHERE id={$id} and content REGEXP '{$newsid}'";
		   
		//     $query = mysqli_query($connect,$sql);
		    
		//    if ($query) {
		//    	 return Response::show('418','已经转发过');
		//    }
		   
		
		$sql = "SELECT stu_id,stu_name FROM es_stu_info WHERE stu_id={$id}";
		    
		    $query = mysqli_query($connect,$sql);
		    
		    while($result = mysqli_fetch_assoc($query)){
		      $idd= $result;
		    }
		$name=$idd['stu_name'];
	

		
		$time=time();


		$sql = "INSERT INTO es_stu_news (content,time,stu_id,name,school) VALUES ('{$content}{$newsid}','{$time}','{$id}','{$name}','{$school}')";


		$query = mysqli_query($connect,$sql);
		if ($query) {
			return Response::show('206','转发成功');
		} else {
			return Response::show('419','转发失败',$sql);
		}


		break;







	default:
		
		break;
}















 ?>