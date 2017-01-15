<?php
 namespace Addons\Test;
 use Addons\PluginInterface;
 use Think\Controller;
  use Think\Hook;
 class TestAddon extends Controller  implements PluginInterface {
	public function  init(){
		$baseDir=dirname(__FILE__);
		$baseDir=str_replace('\\','/',$baseDir);
		$baseDir=substr($baseDir,-1)=='/'?$baseDir:$baseDir.'/';
		file_put_contents($baseDir.'/install.locks','');
	 }
	
	public function getPluginInfo(){
		Hook::add('getPluginName','Admin\Controller\PluginsController');
			$pulginInfo['name']='testPlugin';
			$pulginInfo['description']='这个插件用于测试test';
			return $pulginInfo;
	}
	
	
	public function executePlugin($arguments){
		echo '插件执行成功'.$arguments."<br>";
		return $arguments;
	}
	
	
	
 }