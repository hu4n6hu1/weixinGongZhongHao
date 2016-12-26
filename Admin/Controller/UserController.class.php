<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
	public function userList(){
		$this->display('userList');
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
}