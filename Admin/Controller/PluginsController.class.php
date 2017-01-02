<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Hook;
use Addons;
class PluginsController extends Controller {
	public function PluginsList(){
		$baseDir=dirname(__FILE__);
		$baseDir=str_replace('\\','/',$baseDir);
		$baseDir=substr($baseDir,-1)=='/'?$baseDir:$baseDir.'/';
		$baseDir=$baseDir.'..\\..\\Addons\\';
		$scanObj=D('ScanPlugins');
		$pluginsList=$scanObj->getPluginsList($baseDir);
		$pluginsParam=array();
		foreach($pluginsList as $plugin){

			Hook::add('getPluginInfo',"Addons\\$plugin\\$plugin"."Addon");
		}
		
		$pulginsList=Hook::get('getPluginInfo');
		$pluginsInfo=array();
		$i=0;
		foreach($pulginsList as $plugin){
			/* $obj=new $plugin();
			$pluginsInfo[]=$obj->getPluginInfo(); 
			利用反射实现执行 插件。
			*/
			$path=dirname($plugin);
			$class = new \ReflectionClass($plugin);
			$method = $class->getMethod('getPluginInfo');
			$pluginsInfo[$i]=$method->invoke($class->newInstance());
			$pluginsInfo[$i]['address']=$plugin.'class.php';
			$baseDir=dirname(__FILE__);
			$baseDir=str_replace('\\','/',$baseDir);
			$baseDir=substr($baseDir,-1)=='/'?$baseDir:$baseDir.'/';
			$path=$baseDir.'..\..\\'.dirname($plugin).'\install.locks';
			$status=file_exists($path);
			$pluginsInfo[$i]['status']=$status;
			$i++;
		}
		$this->assign('pluginsInfo',$pluginsInfo);
		$this->display('pluginsList');
		
		
	}
	
	public function test(){

		$tokenObj= D('Token');
		$accessToken=$tokenObj->getAccessToken();
		if(empty($accessToken)){
			echo $tokenObj->lassError;
			return false;
		}
		var_dump($accessToken);

		
	}
		public function test2(){
			$a=array(
			'exec'=>array('111'),
			'test2'=>'zhihu',
			'test'=>array('test'=>'eee','fff')
			);
			
		 $FileConfigObj= new \Admin\Model\FileConfigModel('tags.php');
		 $fileContents=$FileConfigObj->addConfigRecursive($a);
		 $fileContents=$FileConfigObj->saveConfig();
		 var_dump($fileContents);
	}
	
}