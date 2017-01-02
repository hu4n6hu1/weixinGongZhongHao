<?php
 namespace Addons\Test;
 use Addons\PluginInterface;
 use Think\Controller;
  use Think\Hook;
 class TestAddon extends Controller  implements PluginInterface {
	 protected $trueTableName = 'top_categories';
	public function  init(&$arguments){
		 echo "init ok<br>";
		 $arguments['test']='test';
		 return 'init';
	 }
	
	public function getPluginInfo(){
		Hook::add('getPluginName','Admin\Controller\PluginsController');
			$pulginInfo['name']='testPlugin';
			$pulginInfo['description']='这个插件用于测试test';
			return $pulginInfo;
	}
	

	public function executePlugin($arguments){
		echo '插件执行成功'.$arguments;
		return $arguments;
		/* $obj= new \Addons\Test\Model\TestModel();
		$obj->test(); */
	}
	
	
	
 }