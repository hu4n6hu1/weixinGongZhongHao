<?php
 namespace Admin\Model;
 use Think\Model;
 class MenuListModel extends Model{
	 protected $lastError;
	 protected $field=array('pid','name','type','url','key','media_id');
	 public function addMenu($postData){
		 $data=array();
		 foreach($this->field as $key){
			 $data[$key]=$postData[$key];
		 }
		$result=$this->field($this->field)->data($data)->add();
		if($result===false){
			 $this->lastError='数据库错误';
		 }
		 return $result;
	 }
	 
	 public function getTopMenu(){
		 $result=$this->where('pid=0 and type="topMenu"')->select();
		 if($result===false){
			 $this->lastError='数据库错误';
		 }
		 return $result;
	 }
	 
	 public function getChildMenuByPid($pid){
			$result=$this->where('pid=%d',$pid)->select();
			if($result===false){
			 $this->lastError='数据库错误';
		 }
		 return $result;
	 }
	 
	 public function getMenuArmountbyPid($pid){
		 $result=$this->where('pid=%d',$pid)->count();
		 if($result===false){
			 $this->lastError='数据库错误';
		 }
		 return $result;
	 }
	 
	 public function getMenuList(){
		 $result=$this->order('pid')->select();
		 if($result===false){
			 $this->lastError='数据库错误';
		 }
		 return $result;
	 }
	 
	 public function updateMenuById($id,$postData){
		 foreach($this->field as $key){
			 $data[$key]=$postData[$key];
		 }
		 $affectRow=$this->field($this->field)->where('menu_id=%d',$id)->data($data)->save();
		 if($affectRow===false){
			 $this->lastError='数据库错误';
		 }
		 return $affectRow;
	 }
	 
	 public function deleteMenuById($id){
		 $affectRow=$this->where('menu_id=%d',$id)->delete();
		 		 if($affectRow===false){
			 $this->lastError='数据库错误';
		 }
		 return $affectRow;
	 }
	 
	 public function getLastError(){
		 return $this->lastError;
	 }
	 
	 public function getSubNodeByPid($pid){
		 $data=array();
		 $subNode=$this->where('pid=%d',$pid)->select();
		 foreach($subNode as $value){
			 $data[]=$this->selectClass($value);
		 }
		 return $data;
		
	 }

	 
	 public static function  subNode($menu){
		 $data=array();
		 $data['type']=$menu['type'];
		 $data['name']=$menu['name'];
		 $data['key']=$menu['key'];
		 return $data;
	 }
	 public function getTopButton(){
		 $data=array();
		 $topButton=$this->where('pid=0 and type != "topMenu"')->select();
		 foreach($topButton as $value){
			 $data[]=$this->selectClass($value);
		 }
		 return $data;
	 }
	 
	 public  function selectClass($postData){
		$data=array();		
		$data['name']=$postData['name'];
		$data['type']=$postData['type'];
		switch ($postData['type'])
	   {
		case 'view':
		$data['url']=$postData['url'];
		break;  
		default:
		$data['key']=$postData['key'];
	  }
	  return $data;
	 }

	 
 }