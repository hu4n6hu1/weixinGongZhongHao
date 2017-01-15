<?php
 namespace Addons\Home;
 use Addons\PluginInterface;
 use Think\Controller;
 use Think\Hook;
 class HomeAddon extends Controller  implements PluginInterface {
	
	public function  init(){
		$baseDir=dirname(__FILE__);
		$baseDir=str_replace('\\','/',$baseDir);
		$baseDir=substr($baseDir,-1)=='/'?$baseDir:$baseDir.'/';
		file_put_contents($baseDir.'/install.locks','');
	 }
	
	public function getPluginInfo(){
		$pulginInfo['name']='homePlugin';
		$pulginInfo['description']='这个插件用于测试home';
		return $pulginInfo;
			
	}

	public function executePlugin($arguments){
		echo 'Home插件执行成功'.$arguments."<br>";
		return $arguments;
		
	}
	
	
	
 }