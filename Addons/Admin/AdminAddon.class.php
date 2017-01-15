<?php
 namespace Addons\Admin;
 use Addons\PluginInterface;
 use Think\Controller;
  use Think\Hook;
 class AdminAddon extends Controller  implements PluginInterface {
	 protected $trueTableName = 'top_categories';
	public function  init(){
		 echo "admin plugin <br>";
		$arguments['admin']='admin';
	 }
	
	public function getPluginInfo(){
		
			$pulginInfo['name']='adminPlugin';
			$pulginInfo['description']='这个插件用于测试admin';
			return $pulginInfo;
		
	}
	

	public function executePlugin($arguments){
		echo 'Admin插件执行成功'.$arguments;
		return $arguments;
		/* $obj= new \Addons\Test\Model\TestModel();
		$obj->test(); */
	}
	
	
	
 }