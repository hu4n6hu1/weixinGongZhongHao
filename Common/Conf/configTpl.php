<?php
	return array(
	//'配置项'=>'配置值'
	//开启页面追踪
	"SHOW_PAGE_TRACE" =>'true',
	//开启smarty模板
	//'TMPL_ENGINE_TYPE' =>'Smarty' ,
		//数据库配置信息
	'DB_TYPE' => 'mysql',
	// 数据库类型
	'DB_HOST' => '$dbHost',
	// 服务器地址 
	'DB_NAME' => '$dbName', 
	// 数据库名 
	'DB_USER' => '$dbUser', 
	// 用户名
	 'DB_PWD' => '$dbPwd', 
	// 密码 
	'DB_PORT' => $port, 
	// 端口
	 'DB_PREFIX' => '$dbPrefix', 
	// 数据库表前缀 
	 'DB_CHARSET'=> 'utf8', 
	// 字符集
	 'DB_DEBUG' => TRUE, 
	// 数据库调试模式 开启后可以记录SQL日志数据库的类型由DB_TYPE参数设置。 
	  'WX_BASE_CONFIG'=>'$wxBaseConfig'
	//微信基础设置
    
	);
	