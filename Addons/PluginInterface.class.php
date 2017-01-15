<?php
 namespace Addons;
 interface PluginInterface {
	 //该函数初始化插件，判断是本插件目录下是否存在install.locks文件，如果存在就不执行，不存在就执行出生并且生成install.locks文件。
	 public function init();
	 //该函数用于插件功能说明和插件名字
	 public function getPluginInfo();
	 //该函数用于实现钩子,在实现微信公众号功能
	 public function executePlugin($arguments);
	 
	 
 }