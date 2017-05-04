<?php
/*
* 查询子账号 QueryAccount
* 注册子账号 CreateAccount
*/
	require_once('./Config/Config.php');
	require("../Extra/Sdk/CCPRestSDK.php");
	require('./Class/RongYun.class.php');

	header("Content-type: text/html; charset=utf-8"); 
	error_reporting(E_ALL^E_WARNING^E_NOTICE);//显示除去E_WARNING E_NOTICE 之外的所有错误信息
	
	isset($_REQUEST['action'])? $action = post_check($_REQUEST['action']) : $action = "QueryAccount";

	if(isset($_REQUEST['tel'])) $tel = post_check($_REQUEST['tel']);
			
	if(!tel_check($tel)) 
		return Response::show('401','电话号码不合法');

	try{
		$connect = Db::getInstance()->dbConnect();
	}catch (Exception $e){
		return Response::show('402','数据库链接失败');
	}

	$sql = "select id,imsid,imsname from es_stu_user where tel=$tel";

	$query = mysqli_query($connect,$sql);

	if (empty($result=mysqli_fetch_assoc($query))) {
		return Response::show('403','IM信息为空');
	}

	$id = $result['id'];
	$imsid = $result['imsid'];
	$imsname = $result['imsname'];

	if(empty($imsname))
	{
		$imsname=md5($myTel.time());
		
		$sql = "UPDATE es_stu_user imsname=$imsname where tel=$tel and id=$id";

		$query = mysqli_query($connect,$sql);
	}
	
	$rongyun = new RongYun;

	$query_account = $rongyun->querySubAccount($imsname);
	switch ($action) {
			case 'QueryAccount':
				if($query_account)
				{
					$data['AccountID']=$query_account;
					return Response::show('200','查询成功',$data);
				}else
					return Response::show('400','查询失败');
				break;
			case 'CreateAccount':

				if(empty($query_account)) //没有在云通讯上进行过注册信息
				{
					$creat_account = $rongyun->createSubAccount($imsname);////createSubAccount("子帐号名称");
					
					if(!empty($creat_account) and empty($imsid))  //如果数据库中imsid为空
					{
						$sql = "UPDATE es_stu_user imsid='$creat_account' where tel=$tel and id=$id";

						$query = mysqli_query($connect,$sql);

					}
				}
				else     //已经在云通讯注册过信息      
				{
					if(empty($imsid))  //如果数据库中imsid为空
					{
						$sql = "UPDATE es_stu_user SET imsid='$query_account' WHERE tel=$tel and id=$id";
						echo $sql;
						$query = mysqli_query($connect,$sql);

					}
			
					$data['imsid']=$query_account;
					return Response::show('200','已经注册过信息',$data);
				}
				$data['AccountID']=$creat_account;
				return Response::show('200','注册成功',$data);
				break;
			default:
				return Response::show('400','没有该命令');
				break;
	}

?>