<?php
return array(
	//'配置项'=>'配置值'
    'URL_HTML_SUFFIX'       =>  'xml', 
    'DEFAULT_CONTROLLER'=>'manager',
    'DEFAULT_ACTION'=>'login',
    //页面底部显示跟踪信息
    // 'SHOW_PAGE_TRACE'       => true,
    
    //默认分组设置
    'DEFAULT_MODULE'        =>  'Admin',  // 默认模块
    'MODULE_ALLOW_LIST'     => array('Admin','Home'), //定义可供访问的分组列表
    
    //Smarty模板引擎切换
    'TMPL_ENGINE_TYPE'      =>  'Smarty',     // 默认模板引擎
    
    //为Smarty做配置
    'TMPL_ENGINE_CONFIG'    => array(
        //'left_delimiter' => '<@@',
        //'right_delimiter' => '@@>',
    ),
    
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'db',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '',        // 端口 默认3306
    'DB_PREFIX'             =>  'sw_',    // 数据库表前缀
    'DB_PARAMS'          	=>  array(), // 数据库连接参数    
    'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
);
