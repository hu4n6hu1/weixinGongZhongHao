<?php
namespace Admin\Model;
class ButtonType{
	public static function viewClass($postData){
		$data=array();
		$data['name']=$postData['name'];
		$data['type']=$postData['name'];
		$data['name']=$postData['name'];
	}
	
	public static function selectClass($postData){
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