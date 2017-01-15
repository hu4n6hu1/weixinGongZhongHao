<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Hook;
use Addons;
class PluginsController extends Controller {
	protected $initHook=array('init'=>array());
	protected $executeHook=array('executePlugin'=>array());
	
	public function PluginsList(){
		$baseDir=self::getBaseDir();
		$baseDir=$baseDir.'..\\..\\Addons\\';
		$scanObj=D('ScanPlugins');
		$pluginsList=$scanObj->getPluginsList($baseDir);
		$pluginsParam=array();
		foreach($pluginsList as $plugin){
			$pluginPath="Addons\\$plugin\\$plugin"."Addon";
			Hook::add('getPluginInfo',$pluginPath);
			$this->executeHook['executePlugin'][]=$pluginPath;		
			$installLocks=$baseDir."$plugin\\install.locks";
			if(!file_exists($installLocks)){
			$this->initHook['init'][]=$pluginPath;				
			}
		}
		
		$this->addHook($this->initHook);
		$this->addHook($this->executeHook);
	
		$pluginsInfo=$this->getPluginsInfo();
		$this->assign('pluginsInfo',$pluginsInfo);
		$this->display('pluginsList');	
		
	}
	
	public function pluginInit(){
		Hook::listen('init');
		$this->PluginsList();
	}
	
	protected function addHook($hook){
		$FileConfigObj= new \Admin\Model\FileConfigModel('tags.php');
		$fileContents=$FileConfigObj->addConfig($hook);
		$fileContents=$FileConfigObj->saveConfig();

	}
	
	protected static function getBaseDir(){
		$baseDir=dirname(__FILE__);
		$baseDir=str_replace('\\','/',$baseDir);
		$baseDir=substr($baseDir,-1)=='/'?$baseDir:$baseDir.'/';
		return $baseDir;
	}
	
	
	
	protected function getPluginsInfo(){
		$pulginsList=Hook::get('getPluginInfo');
		$pluginsInfo=array();
		$i=0;
		$baseDir=self::getBaseDir();
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
			
			$path=$baseDir.'..\..\\'.dirname($plugin).'\install.locks';
			$status=file_exists($path);
			$pluginsInfo[$i]['status']=$status;
			$i++;
		}
		return $pluginsInfo;
		
	}
	

	
}