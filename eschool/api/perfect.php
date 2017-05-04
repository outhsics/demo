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


$id =  post_check(@$_REQUEST['id']);
$cmd=post_check(@$_REQUEST['cmd']);
$seeid=post_check(@$_REQUEST['seeid']);
switch ($cmd) {
  case 'fill':

        foreach ($_FILES as $file) {
          
          if ((($file["type"] == 'file/*')||($file["type"] == 'application/octet-stream'))
            && ($file["size"] <300000000))
          {
            if ($file["error"] > 0)
            {
              $data[]=$file["error"];
              return Response::show('410','文件错误',$data);
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

            return Response::show('412','文件过大或文件格式错误');
            }


        }

        $pic= $DIRS['0'];
        //默认头像
         if ($pic=='') {
         	$pic='../Upload/pic/1447125001oklpklo.jpg';
         }





        $instructor=  post_check(@$_REQUEST['instructor']);
        $enrol =  post_check(@$_REQUEST['enrol']);
        //入学时间
        $major =  post_check(@$_REQUEST['major']);
        //专业
        $sex =  post_check(@$_REQUEST['sex']);
        $school =  post_check(@$_REQUEST['school']);
        $stuname =  post_check(@$_REQUEST['stuname']);
        $home =  post_check(@$_REQUEST['home']);
        $sql = "INSERT INTO es_stu_info (stu_id,school,major,enrol_date,sex,stu_name,stu_pic,home) VALUES ('{$id}','{$school}','{$major}','{$enrol}','{$sex}','{$stuname}','{$pic}','{$home}')";


        $query = mysqli_query($connect,$sql);


       
        if ($query) {
          return Response::show('213','保存成功');
        } else {
          return Response::show('426','保存失败');
        }




    break;
  case 'revise':



        foreach ($_FILES as $file) {
          
          if (($file["type"] == 'application/octet-stream')
            && ($file["size"] <30000))
          {
            if ($file["error"] > 0)
            {
              $data[]=$file["error"];
              return Response::show('410','文件错误',$data);
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

            return Response::show('412','文件过大或文件格式错误');
            }


        }

        $pic= $DIRS['0'];

        if ($pic=='') {
          $pic='';
        } else {
          $pics=",stu_pic='{$pic}'";
        }
        





       
        $enrol =  post_check(@$_REQUEST['enrol']);
        $major =  post_check(@$_REQUEST['major']);
        //专业
        $sex =  post_check(@$_REQUEST['sex']);
        $school =  post_check(@$_REQUEST['school']);
        $stuname =  post_check(@$_REQUEST['stuname']);

        $sql = "update  es_stu_info set school='{$school}',major='{$major}',enrol_date='{$enrol}',sex='{$sex}',stu_name='{$stuname}'{$pics}
        where stu_id={$id}";


        $query = mysqli_query($connect,$sql);
     
        if ($query) {
          return Response::show('214','修改成功',$pic);
        } else {
          return Response::show('412','修改失败');
        }






    break;

  case 'see':
    
		$sql = "SELECT stu_id,school,major,enrol_date,sex,stu_name,stu_pic FROM es_stu_info WHERE stu_id={$seeid}";



		$query = mysqli_query($connect,$sql);
		while($result = mysqli_fetch_assoc($query)){
					
			$data= $result;
		}

    $sql = "select care_id from es_stu_care where id={$seeid} ";



    $query = mysqli_query($connect,$sql);
    $caress=array();
    while($result = mysqli_fetch_assoc($query)){
          
      $caress= $result['care_id'];
    } 
  
    $cs=explode('|',$caress);
    $data['cares']=count($cs)-1;


    $sql = "select count(*) from es_stu_care where care_id  REGEXP '[[:<:]]{$seeid}[[:>:]]' ";



    $query = mysqli_query($connect,$sql);
    while($result = mysqli_fetch_assoc($query)){
           $data['fans_num']=$result['count(*)'];
     
    }

    if (in_array($data['stu_id'],$caress)) {
        $data['care']=1;
      }else{
        $data['care']=0;
        }

    $sql = "select pic from es_stu_news where stu_id={$seeid} and school='' ORDER BY time desc limit 100";



    $query = mysqli_query($connect,$sql);
    $picsss=array();
    while($result = mysqli_fetch_assoc($query)){
           $picsss[]=$result;
     
    }
    
    $pic=array();
    $x=0; 
    while ($x<=count($picsss)){

      $pics=$picsss["{$x}"]['pic'];

      $picss=explode('+',$pics);

      $pic=array_merge($pic,$picss);
      $x=$x+1 ; 
    }
    foreach ($pic as $key => $v) {
      if ($v==null) {
        unset($pic["{$key}"]);
      }
    }
    $pic=array_slice($pic,0,3);
    $data['pic']=$pic;

		return Response::show('200','返回数据',$data);


    break;


  default:
    # code...
    break;
}














 ?>