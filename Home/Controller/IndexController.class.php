<?php
namespace Home\Controller;
use Think\Controller;
use Think\Hook;
class IndexController extends Controller {
    public function index(){
		define("TOKEN", "l3n641");
		$curlObj= D('SendData');
		$wechatObj = D('Wechat');
		$wechatObj->getNormalMsg();
		if($wechatObj->msgType=='text' ){
		  switch($wechatObj->content=='1'){
			case 1:
			        $ExchangeRateObj= new \Home\Model\ExchangeRateModel($curlObj);
					$rate=$ExchangeRateObj->getRate();
					$wechatObj->responseMsg($rate);
					break;
			default:
			  $msg="
			  输入1查询汇率\n 
			  输入2查询电话\n
			  ";
			  $wechatObj->responseMsg($msg);
		}
		}
	}
    
	public function plugins(){
		
		Hook::add('executePlugin','Addons\Test\TestAddon');
		Hook::add('executePlugin','Addons\Admin\AdminAddon');
		
		$a='axxxx';
		$b=Hook::listen('executePlugin',$a);
		var_dump($b);


	}
	
}