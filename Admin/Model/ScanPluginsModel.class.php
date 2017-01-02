<?php
namespace Admin\Model;
class ScanPluginsModel {
	public function getPluginsList($path){
		$pluginList=array();
		$dirList=scandir($path);
		
		foreach($dirList as $dir){
			if(is_dir($path.$dir)&&$dir!='.'&&$dir!='..'){
				$pluginList[]=$dir;
			}
		}
		return $pluginList;
	}
}