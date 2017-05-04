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
$id = post_check($_REQUEST['id']);

$cmd = post_check($_REQUEST['cmd']);

switch ($cmd) {
	case 'made':
		if ($pag) {
			// $pag=30*$pad.','.30*($pad-1);
		} else {
			$pag=30;
		}
		$sql = "SELECT * FROM es_stu_news WHERE stu_id={$id} order by time desc LIMIT {$pag}";
		
			$query = mysqli_query($connect,$sql);
			while ($result= mysqli_fetch_assoc($query)) {
			  $dds[]= $result;
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

		
		return Response::show('216','返回数据',$data);






		break;
	






	case 'house':



		if ($pag) {
			// $pag=30*$pad.','.30*($pad-1);
		} else {
			$pag=30;
		}
			$sql = "SELECT id FROM es_news_praise WHERE stu_id={$id} order by time desc LIMIT {$pag}";
		
			$query = mysqli_query($connect,$sql);
			$newid=array();
			while ($result= mysqli_fetch_assoc($query)) {
			  $newid[]= $result['id'];
			}
			$t='';
			foreach ($newid as $k => $v) {
				$newid["{$k}"]='id='.$v;
			}

			$newid=implode(' or ',$newid);
			$sql = "SELECT * FROM es_stu_news WHERE {$newid} ";
		
			$query = mysqli_query($connect,$sql);
			$dds=array();
			while ($result= mysqli_fetch_assoc($query)) {
			  $dds[]= $result;
			}
			
	
		
		
		
		foreach ( $dds as $dd){
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

	
		return Response::show('217','返回数据',$data);

		


		break;





	case 'chalk':
		
		$sql = "select care_id from es_stu_care where id={$id}";

	

		$query = mysqli_query($connect,$sql);
		while($result = mysqli_fetch_assoc($query)){
					
				   $manids= $result['care_id'];
		}


		$manid=explode("|",$manids); 
		 
		 $manids=array();

	    while ($x<=count($manid)){
	    	$mid=$manid["{$x}"];
	    	if ($mid) {
	    		$mid='stu_id='.$mid;
				$manids[]=$mid;
	    	}
			
	     $x=$x+1;
	    }

		
		
		$manid=implode(" or ",$manids);
		$manid=$manid.' or stu_id='.$id;





			$sql = "select stu_id,stu_name,stu_pic,chalk from es_stu_info where {$manid} order by chalk desc";

			$query = mysqli_query($connect,$sql);
			$p=0;

			while($result = mysqli_fetch_assoc($query)){
				$mans[]= $result;

				if ($mans["{$p}"]['stu_id']==$id) {
					$pais=$p+1;
					$chalks=$mans["{$p}"]['chalk'];
				}
				$p=$p+1;
					  
			}
		
		$pai=array();
		
		$pai['stu_id']=$id;
		$pai['chalks']=$chalks;
		$pai['paiming']=$pais;
		$data=$mans;
		
	

		
		return Response::shows('218','返回数据',$data,$pai);		
		break;















	default:
		# code...
		break;
}
























 ?>