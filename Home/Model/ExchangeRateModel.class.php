<?php
  namespace Home\Model;
  use Think\Model;
  class ExchangeRateModel {
	  protected $curlObj;
	  public function __construct(SendDataModel $curlObj){
		  if($curlObj instanceof SendDataModel ){
			  $this->curlObj=$curlObj;
		  }
		  
	  }
	  
	  public function getRate(){
		  $rn=time()*1000;
		  $optionList=array(
				CURLOPT_URL=>'http://hq.sinajs.cn/rn=$rmlist=fx_susdcny,fx_susdbrl,fx_susdars'
			  );
		  $this->curlObj->setOption($optionList);
		  $data=$this->curlObj->getDataByGet();
		  $data =iconv('GB2312', 'UTF-8',$data );
		  $data=rtrim($data);
		  $data=rtrim($data,';');
		  $tmp=array();
		  $tmp2=array();
		  $text='';
		  $data=explode(';',$data);
		  foreach($data as $rate){
			$tmp[]=explode('=',$rate);
		  }
		  foreach ($tmp as $data){
			  $tmp2[]=explode(',',trim($data[1],'"'));
		  }
		  foreach ($tmp2 as $data){
		  $text.= "{$data[17]} {$data[9]} :{$data[1]} \n ";
		  }
		   return $text;
		
	  }
  }