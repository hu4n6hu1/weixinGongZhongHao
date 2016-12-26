<?php
 namespace Admin\Model;
 class FileConfigModel{
	 protected $path;
	 protected $fileContents;
	 public function __construct($name,$path=''){

		$baseDir=dirname(__FILE__);
        $baseDir=str_replace('\\','/',$baseDir);
        $baseDir=substr($baseDir,-1)=='/'?$baseDir:$baseDir.'/';
		if(empty($path)){
			$this->path=$baseDir.'../../Common/Conf/'.$name;
			echo $this->path;
			return true;
		}
		$this->path=$path.$name;
	 } 
	
	 public function readArrayConfigFile(){
		  echo $path;
		 if(!file_exists($this->path) && !function_exists('file_get_contents')){
			 return false;
		 }
		
		 $fileContents=file_get_contents($this->path);
		 if($fileContents===false){
			 return false;
		 }
		 $this->fileContents=$fileContents;
		 return $fileContents;
	 }
	 
	 
 }