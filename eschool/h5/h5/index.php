<?php
header("content-type:text/html;charset=utf-8");
//使用thinkphp框架开发App商城项目

function show_bug($msg){
    echo "<pre style=\"color:red;\">";
    var_dump($msg);
    echo "</pre>";
}

//框架两种模式：[默认]生产(线上)、开发(调试)
define('APP_DEBUG',true);//开发(错误提示非常具体)
//define('APP_DEBUG',false);//生产(错误提示模糊)
define('SITE_URL','http://127.0.0.1/h5');
//给静态资源文件访问目录设置常量，方便后期维护
//Home分组
define('CSS_URL','/h5/App/Public/css/');
define('IMG_URL','/h5/App/Public/img/');
define('JS_URL','/h5/App/Public/js/');
//Admin分组
define('ADMIN_CSS_URL','/h5/App/Admin/Public/css/');
define('ADMIN_IMG_URL','/h5/App/Admin/Public/img/');

define('APP_PATH','./App/');
//引入框架的接口文件
include('./Core/ThinkPHP.php');