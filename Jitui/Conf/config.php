<?php
return array(
	// 数据库
	'DB_HOST'	=> 	'localhost',	// 数据库地址
	'DB_NAME'	=>	'jitui', 		// 数据库名称
	'DB_USER'	=>	'root',			// 数据库用户名
	'DB_PWD'	=>	'123',			// 数据库密码
	'DB_PORT'	=>	'3306',			// 数据库端口
	'DB_PREFIX' => 	'jt_',			// 数据库前缀
	
	// 模版
	'TMPL_L_DELIM'	=>	'<{',		// 模版变量前缀
	'TMPL_R_DELIM'	=>	'}>',		// 模版变量后缀
	
	// 模板常量
	'TMPL_PARSE_STRING'	=>	array(
		'__ROOT__'			=>		'http://test.jtui.cn',		// 网站地址
		'__NAME__'			=>		'即推',						// 网站名字
		'__PHONE__'			=>		'4000-558-500',				// 网站电话
	),
	
	// 其他
	'URL_MODEL'				=>	'2',		// 路由模式
	'SHOW_PAGE_TRACE'		=>	false,		// 显示调试信息
	'URL_CASE_INSENSITIVE'	=>	true,		// 路由统一小写
	'URL_HTML_SUFFIX'	 	=>  '',			// URL后缀
);
