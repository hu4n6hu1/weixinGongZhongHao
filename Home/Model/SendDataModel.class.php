<?php
  namespace	Home\Model;
  class SendDataModel {
	  protected $curlHandle;
	  public function __construct($url){
		  $this->curlHandle= curl_init($url);
		  curl_setopt($this->curlHandle,CURLOPT_RETURNTRANSFER,true);
		  curl_setopt($this->curlHandle, CURLOPT_SSL_VERIFYPEER, false); // ����֤֤����Դ�ļ��  
		  curl_setopt($this->curlHandle, CURLOPT_SSL_VERIFYHOST, false); // ��֤���м��SSL�����㷨�Ƿ����  
		  curl_setopt($this->curlHandle,CURLOPT_HEADER,false);
	  }
	  
	  public function setOption($optionList){
		  foreach($optionList as $option=>$value){
			  curl_setopt($this->curlHandle,$option,$value);
		  }
	  }
	  
	  public function getDataByGet(){
		  $data=curl_exec($this->curlHandle);
		  curl_close($this->curlHandle);
		  return $data;
	  }
	  
	  public function getDataByPost($data){
		  curl_setopt($this->curlHandle, CURLOPT_POST, 1);
		  curl_setopt($this->curlHandle, CURLOPT_CONNECTTIMEOUT, 60);
		  curl_setopt($this->curlHandle,CURLOPT_POSTFIELDS,http_build_query($data));
		  $data=curl_exec($this->curlHandle);
		  curl_close($this->curlHandle);
		  return $data;
	  }
	  
  }