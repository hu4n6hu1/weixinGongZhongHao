<?php
 namespace Addons\Home;
 use Addons\PluginInterface;
 use Think\Controller;
 use Think\Hook;
 class HomeAddon extends Controller  implements PluginInterface {
	
	public function  init(&$arguments){
			
	 }
	
	public function getPluginInfo(){
		$pulginInfo['name']='homePlugin';
		$pulginInfo['description']='这个插件用于测试home';
		return $pulginInfo;
			
	}

	public function executePlugin($arguments){
		echo 'Admin插件执行成功'.$arguments;
		return $arguments;
		
	}
	
	
	
 }