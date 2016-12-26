<?php
 namespace Home\Behavior;
 use Think\Behavior;
 class TestBehavior extends Behavior{
	 public function run(&$params){
		 echo "plugin run";
	 }
 }