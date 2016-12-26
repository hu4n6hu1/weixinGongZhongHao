<?php
  namespace Home\Model;
  class WechatModel{
	protected $client,$owner,$msgId,$createTime;
	public $content,$msgType;
	
	public function valid(){
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg($content){
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				
              		$msgType = "text";
                	$contentStr = "Welcome to wechat world!";
                	$resultStr = sprintf($textTpl, $this->client, $this->owner, $time, $msgType, $content);
                	echo $resultStr;
                
    }
	
	public function getNormalMsg(){
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if (!empty($postStr)){
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $this->client = $postObj->FromUserName;
                $this->owner = $postObj->ToUserName;
                $this->content = trim($postObj->Content);
				$this->msgId=$postObj->MsgId;
				$this->msgType=$postObj->MsgType;
				$this->createTime=$postObj->CreateTime;
		}
	}
		
	private function checkSignature(){
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
  }