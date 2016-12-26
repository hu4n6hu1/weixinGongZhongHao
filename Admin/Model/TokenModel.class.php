<?php
	namespace	Admin\Model;
	use Think\Model;
	class TokenModel extends Model{
		/*
			type_id=1 ��accesso_token;
		*/
		public $lassError;
		public function getAccessToken(){
			$accessToken=$this->field('token,expires')->where('type_id=1')->find();
			$data=$this->checkdata($accessToken);
			return $data;
		}
		
		protected function checkdata($accessToken){
						
			if($accessToken=== null){
				//$this->lassError='û�ҵ�����';	
				$data=$this->addAccessToken();
				return $data;
			}
			if($accessToken=== false){
				$this->lassError='mysql ����';
				return false;;
			}
			if(time()>$accessToken['expires']){
				$data=$this->UpdateAccessToken();
				return $data;
			}
			
			return $accessToken;
			
		}
		
		protected function updateAccessToken(){
				$appid=C('APPID');
				$secret=C('SECRET');
				$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
				$curlObj= new \Admin\Model\SendDataModel($url);
				$accessToken=$curlObj->getDataByGet();
				$accessToken=json_decode($accessToken,true);
				$data['token']=$accessToken['access_token'];
				$data['expires']=time()+$accessToken['expires_in']-200;//��ǰ200�����
				$affectRow=$this->where('type_id=1')->data($data)->save();
				if($affectRow ===false){
					$this->lassError='mysql���´���';
					return false;
				}
				return $data;
		}
		
				protected function addAccessToken(){
				$appid=C('APPID');
				$secret=C('SECRET');
				$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
				$curlObj= new \Admin\Model\SendDataModel($url);
				$accessToken=$curlObj->getDataByGet();
				$accessToken=json_decode($accessToken,true);
				$data['token']=$accessToken['access_token'];
				$data['expires']=time()+$accessToken['expires_in']-200;//��ǰ200�����
				$data['type_id']=1;
				$status=$this->data($data)->add();
				if($status ===false){
					$this->lassError='mysql���´���';
					return false;
				}
				return $data;
		}
		
		
	}