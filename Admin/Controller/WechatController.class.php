<?php
namespace Admin\Controller;
use Think\Controller;
use Addons\Test;
class WechatController extends Controller {
	public function showBaseSet(){
		$configObj= D('config');
		$baseSetKey=array('num','token','appid','appsecret','encodingaeskey');
		$configArray=array();
		foreach($baseSetKey as $keyName){
			$result=$configObj->getConfig($keyName);
			$configArray[$keyName]=htmlentities($result['config_value']);
			}
		$menuListObj=D('menuList');
		$topList=$menuListObj->getTopMenu();
		$this->assign('topList',$topList);
		$this->assign('url',$_SERVER['HTTP_HOST']);
		$this->assign('config',$configArray);	

		$this->getMenuList();
		
		$this->display('baseSet');
		return false;
	}
	
	public function addMenu(){
		$menuListObj=D('menuList');
		//这里是更新menu
		if(!empty($_POST['menu_id'])){
			$affectRow=$menuListObj->updateMenuById($_POST['menu_id'],$_POST);
			if($affectRow===false){
			$this->assign('noteString',$menuListObj->getLastError());
			$this->display('Public/error');
			return false;
		}
		$this->assign('noteString','修改记录成功');
		$this->display('Public/success');		
		return true;
		}
		//这里是添加新的menu
		$insertId=$menuListObj->addMenu($_POST);
		if($insertId===false){
			$this->assign('noteString',$menuListObj->getLastError());
			$this->display('Public/error');
			return false;
		}
		$this->assign('noteString','添加新的列表成功');
		$this->display('Public/success');	

	}
	
	public function setBaseConfig(){
		$configObj= D('config');
		$baseSetKey=array('num','token','appid','appsecret','encodingaeskey');
		$configArray=array();
		foreach($baseSetKey as $keyName){
			if(empty($_POST[$keyName])){
			$this->assign('noteString','必须设置'.$keyName);
			$this->display('Public/error');
			return false;
			
			
			}
			$result=$configObj->setConfig($keyName,$_POST[$keyName]);
			if($result===false){
			$this->assign('noteString',$result->getLastError());
			$this->display('Public/error');
			return false;
			}
			
		}
		$this->assign('noteString','设置成功');
		$this->display('Public/success');	
	}
	
	public function getMenuList(){
		$menuListObj=D('menuList');
		$menuList=$menuListObj->getMenuList();
		if($menuList===false){
			$this->assign('noteString',$menuList->getLastError());
			$this->display('Public/error');
			return false;
			}
		$this->assign('menuList',$menuList);
	}
	
	public function delMenu($id){
		$menuListObj=D('menuList');
		$affectRow=$menuListObj->deleteMenuById($id);
		if($affectRow===false){
		$this->assign('noteString',$menuListObj->getLastError());
		$this->display('Public/error');
		return false;
		}
		$this->assign('noteString','删除记录成功');
		$this->display('Public/success');		
		return true;
	}
	
	public function test(){
		$menuListObj=D('menuList');
		$topMenuList=$menuListObj->getTopMenu();
		$subNodes=array();
		$i=0;
		foreach($topMenuList as $menu){
			$subNodes[$i]['name']=$menu['name'];
			$subNodes[$i]['sub_button']=$menuListObj->getSubNodeByPid($menu['menu_id']);
			$i++;
		}

		$topButton=$menuListObj->getTopButton();
		$data=array();
		 $data['button']=array_merge_recursive($subNodes,$topButton);
				
		
	}
	
	
}