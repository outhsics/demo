<?php
return array(
	//'配置项'=>'配置值'
		'DEFAULT_CONTROLLER'  => 'Login',       //后台默认访问的控制器
	//权限认证
		'AUTH_CONFIG' => array(
		'AUTH_ON' => true, //认证开关
		'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
		'AUTH_GROUP' => 'es_admin_group', //用户组数据表名
		'AUTH_GROUP_ACCESS' => 'es_admin_group_access', //用户组明细表
		'AUTH_RULE' => 'es_admin_rule', //权限规则表
		'AUTH_USER' => 'es_admin_user'  //用户信息表
		),
	//分页配置
		'VAR_PAGE' => 'page',
		'DEFAULT_NUMS' => '10',

);