<?php
 namespace Admin\Model;
 use Think\Model;
  class ConfigModel extends Model{
	  protected $lastError;
	  public function getConfig($key){
		  $result=$this->field('config_value')->where('key_name="%s"',$key)->find();
		  if($result===false){
			  $this->lasstError='数据库错误.';
		  }
		  
		  return $result;
	  }
	  
	  protected function addConfig($key,$value){
		  $data=array();
		  $data['key_name']=$key;
		  $data['config_value']=$value;
		  $id=$this->field('key_name,config_value')->data($data)->add();
		  if($id===false){
			  $this->lasstError='数据库错误.';
			  return false;  
		   }
		   return $id;
	  }
	  
	  protected function updateConfig($key,$value){

		  $data=array();
		  $data['config_value']=$value;
		  $affectRow=$this->field('key_name,config_value')->where('key_name="%s"',$key)->data($data)->save();
		  if($affectRow===false){
			  $this->lasstError='数据库错误.';
			  return false;  
		  }
		  return $affectRow;
	  }
	  
	  public function setConfig($key,$value){
		  $result=$this->getConfig($key);
		  if($result===null){
			  return $this->addConfig($key,$value);
	
		  }
		  if($result!=false){
			  return $this-> updateConfig($key,$value);
		  }
		  if($result===false){
			  $this->lasstError='数据库错误.';
			  return false;  
		  }
		  
		  
	  }
	  
	  public function getLastError(){
		  return $this->lastError;
	  }
	  
  }