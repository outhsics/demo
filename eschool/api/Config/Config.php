<?php
require('./Class/Response.class.php');
require('./Class/Db.class.php');
require('./Class/Cache.class.php');
require('./Class/Library.class.php');
require('./Class/Log.class.php');
require('./function/function.php');

/*
 *  APP接口数据库配置文件
 *  
*/
define('DB_HOST','192.168.1.10');       //主机
define('DB_USER','eschool');         //数据库用户
define('DB_PWD','123qweasd');  		//数据库密码
define('DB_DATABASE','eschool');     //数据库名称

define('LOG_PATH','../Log/apiLog.txt');

//YongTongxun 定义的变量

$accountSid= '8a48b55150b36d920150b6a9c34b07c7';

$accountToken= '0f148944b77143bebe08f4e4b79fc4dc';

$appId='aaf98f8950b365a20150b6af9c0a02e4';  //亦校园使用
$appToken='4c48d47d2d8a7cd77f605892e7c4f5a5';

// $appId='8a48b55150e162370150ef81df6c5f93';	//易校园使用

//通知账号id
$reid='12802217321448934363';


//生产环境
$serverIP = 'app.cloopen.com';

//沙盒环境
//$serverIP='sandboxapp.cloopen.com';

$serverPort='8883';

$softVersion='2013-12-26';

$tempID = "48422";	//亦校园模板ID
// $tempID = "48433";	//易校园模板ID

?>