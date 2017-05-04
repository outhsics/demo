<?php
	/*
	*	get sms from yuntongxun.com
	*
	*/
	require("./Config/Config.php");
	require("../Extra/Sdk/CCPRestSDK.php");
	require('./Class/RongYun.class.php');

	header("Content-type: text/html; charset=utf-8"); 
	error_reporting(E_ALL^E_WARNING^E_NOTICE);//显示除去E_WARNING E_NOTICE 之外的所有错误信息

	$tel = post_check($_REQUEST['tel']);
	$log = new Log();		
	if(tel_check($tel))  $myTel = $tel;
	else {   
		$log->showlog('rySendSmsg,电话号码不合法');
		return Response::show('400','电话号码不合法');
	}
	$mycode = verifRand(1,5);
	$time = time();
	session_id("l{$myTel}");
	session_start(); 

	$_SESSION["k{$mycode}"]=$time;

	$rongyun = new RongYun;
	$smsflag = $rongyun->sendTemplateSMS($myTel,array($mycode,'5'),$tempID);//手机号码，替换内容数组，模板ID

	$data['tel']=$myTel;
	// $data['sms']=$mycode;
	//验证码暂时不传给客户端***安全考虑

	if($smsflag != 0)
		return Response::show('400','发送失败',$data);
	else
		return Response::show('200','发送成功',$data);
?>