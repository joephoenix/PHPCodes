<?php

  //关掉浏览器，PHP脚本也可以继续执行.
  ignore_user_abort();
  // 通过set_time_limit(0)可以让程序无限制的执行下去
  set_time_limit(0);
  
  // 每隔指定时间运行
  $interval = 15;
  $temp_key = 0;
  do{
     $time = time();
	 require 'config.php';
	 $mem = new Memchache();
	 $men->connect($Memchache_server, $Memchache_port);
	 if($is_send){
	    $get_time = $mem->get('time_data');
	 }else{
	    $get_time = $time + 86400;
	 }
	 
	 if($get_time == $time){
	   $mem->close();
	 }else if ($temp_key == 0) {
        $temp_key = 1;
        @file_get_contents('http://******/*****.php');
        $mem->set('tem_data', $time, MEMCACHE_COMPRESSED, $Memcache_date);
        $mem->close();
        sleep(mt_rand(1, 3));
        $temp_key = 0;
    }else{
        $mem->close();
        exit();
    }
    //这里是你要执行的代码, 并等待*秒钟
    sleep($interval);
} while (true);
?>
  